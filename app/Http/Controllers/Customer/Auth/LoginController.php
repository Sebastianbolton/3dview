<?php

namespace App\Http\Controllers\Customer\Auth;

use App\CPU\CartManager;
use App\CPU\Helpers;
use App\Http\Controllers\Controller;
use App\Model\BusinessSetting;
use App\Model\ProductCompare;
use App\Model\Wishlist;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Gregwar\Captcha\CaptchaBuilder;
use Illuminate\Support\Facades\Session;
use Gregwar\Captcha\PhraseBuilder;

class LoginController extends Controller
{
    public $company_name;

    public function __construct()
    {
        $this->middleware('guest:customer', ['except' => ['logout']]);
    }

    public function captcha(Request $request, $tmp)
    {

        $phrase = new PhraseBuilder;
        $code = $phrase->build(4);
        $builder = new CaptchaBuilder($code, $phrase);
        $builder->setBackgroundColor(220, 210, 230);
        $builder->setMaxAngle(25);
        $builder->setMaxBehindLines(0);
        $builder->setMaxFrontLines(0);
        $builder->build($width = 100, $height = 40, $font = null);
        $phrase = $builder->getPhrase();

        if(Session::has($request->captcha_session_id)) {
            Session::forget($request->captcha_session_id);
        }
        Session::put($request->captcha_session_id, $phrase);
        header("Cache-Control: no-cache, must-revalidate");
        header("Content-Type:image/jpeg");
        $builder->output();
    }

    public function login()
    {
        session()->put('keep_return_url', url()->previous());
        return view('customer-view.auth.login');
    }

    public function submit(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'password' => 'required'
        ]);

        //recaptcha validation start
        $recaptcha = Helpers::get_business_settings('recaptcha');
        if (isset($recaptcha) && $recaptcha['status'] == 1) {
            try {
                $request->validate([
                    'g-recaptcha-response' => [
                        function ($attribute, $value, $fail) {
                            $secret_key = Helpers::get_business_settings('recaptcha')['secret_key'];
                            $response = $value;
                            $url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . $secret_key . '&response=' . $response;
                            $response = \file_get_contents($url);
                            $response = json_decode($response);
                            if (!$response->success) {
                                $fail(\App\CPU\translate('ReCAPTCHA Failed'));
                            }
                        },
                    ],
                ]);
            } catch (\Exception $exception) {}
        } else {
            if (strtolower($request->default_recaptcha_id_customer_login) != strtolower(Session('default_recaptcha_id_customer_login'))) {
                if($request->ajax()) {
                    return response()->json([
                        'status'=>'error',
                        'message'=>translate('Captcha_Failed.'),
                        'redirect_url'=>''
                    ]);
                }else {
                    Session::forget('default_recaptcha_id_customer_login');
                    Toastr::error('Captcha Failed.');
                    return back();
                }
            }
        }
        //recaptcha validation end

        $user = User::where(['phone' => $request->user_id])->orWhere(['email' => $request->user_id])->first();
        $remember = ($request['remember']) ? true : false;

        //login attempt check start
        $max_login_hit = Helpers::get_business_settings('maximum_login_hit') ?? 5;
        $temp_block_time = Helpers::get_business_settings('temporary_login_block_time') ?? 5; //seconds
        if (isset($user) == false) {
            if($request->ajax()) {
                return response()->json([
                    'status'=>'error',
                    'message'=>translate('credentials_do_not_match_or_account_has_been_suspended'),
                    'redirect_url'=>''
                ]);
            }else{
                Toastr::error(translate('credentials_do_not_match_or_account_has_been_suspended'));
                return back()->withInput();
            }
        }
        //login attempt check end

        //phone or email verification check start
        $phone_verification = Helpers::get_business_settings('phone_verification');
        $email_verification = Helpers::get_business_settings('email_verification');
        if ($phone_verification && !$user->is_phone_verified) {
            if($request->ajax()) {
                return response()->json([
                    'status'=>'error',
                    'message'=>translate('account_phone_not_verified'),
                    'redirect_url'=>route('customer.auth.check', [$user->id]),
                ]);
            }else{
                return redirect(route('customer.auth.check', [$user->id]));
            }
        }
        if ($email_verification && !$user->is_email_verified) {
            if($request->ajax()) {
                return response()->json([
                    'status'=>'error',
                    'message'=>translate('account_email_not_verified'),
                    'redirect_url'=>route('customer.auth.check', [$user->id]),
                ]);
            }else{
                return redirect(route('customer.auth.check', [$user->id]));
            }
        }
        //phone or email verification check end

        if(isset($user->temp_block_time ) && Carbon::parse($user->temp_block_time)->DiffInSeconds() <= $temp_block_time){
            $time = $temp_block_time - Carbon::parse($user->temp_block_time)->DiffInSeconds();

            if($request->ajax()) {
                return response()->json([
                    'status'=>'error',
                    'message'=>translate('please_try_again_after_') . CarbonInterval::seconds($time)->cascade()->forHumans(),
                    'redirect_url'=>''
                ]);
            }else{
                Toastr::error(translate('please_try_again_after_') . CarbonInterval::seconds($time)->cascade()->forHumans());
                return back()->withInput();
            }
        }

        if (isset($user) && $user->is_active && auth('customer')->attempt(['email' => $user->email, 'password' => $request->password], $remember)) {
            $wish_list = Wishlist::whereHas('wishlistProduct',function($q){
                return $q;
            })->where('customer_id', auth('customer')->user()->id)->pluck('product_id')->toArray();

            $compare_list = ProductCompare::where('user_id', auth('customer')->id())->pluck('product_id')->toArray();

            session()->put('wish_list', $wish_list);
            session()->put('compare_list', $compare_list);
            Toastr::info('Welcome to ' . Helpers::get_business_settings('company_name') . '!');
            CartManager::cart_to_db();

            $user->login_hit_count = 0;
            $user->is_temp_blocked = 0;
            $user->temp_block_time = null;
            $user->updated_at = now();
            $user->save();

            if($request->ajax()) {
                return response()->json([
                    'status'=>'success',
                    'message'=>translate('login_successful'),
                    'redirect_url'=>'samepage',
                ]);
            }else{
                return redirect(session('keep_return_url'));
            }

        }else{

            //login attempt check start
            if(isset($user->temp_block_time ) && Carbon::parse($user->temp_block_time)->diffInSeconds() <= $temp_block_time){
                $time= $temp_block_time - Carbon::parse($user->temp_block_time)->diffInSeconds();

                $ajax_message = [
                    'status'=>'error',
                    'message'=> translate('please_try_again_after_') . CarbonInterval::seconds($time)->cascade()->forHumans(),
                    'redirect_url'=>''
                ];
                Toastr::error(translate('please_try_again_after_') . CarbonInterval::seconds($time)->cascade()->forHumans());

            }elseif($user->is_temp_blocked == 1 && Carbon::parse($user->temp_block_time)->diffInSeconds() >= $temp_block_time){

                $user->login_hit_count = 0;
                $user->is_temp_blocked = 0;
                $user->temp_block_time = null;
                $user->updated_at = now();
                $user->save();

                $ajax_message = [
                    'status'=>'error',
                    'message'=> translate('credentials_do_not_match_or_account_has_been_suspended'),
                    'redirect_url'=>''
                ];
                Toastr::error(translate('credentials_do_not_match_or_account_has_been_suspended'));

            }elseif($user->login_hit_count >= $max_login_hit &&  $user->is_temp_blocked == 0){
                $user->is_temp_blocked = 1;
                $user->temp_block_time = now();
                $user->updated_at = now();
                $user->save();

                $time= $temp_block_time - Carbon::parse($user->temp_block_time)->diffInSeconds();

                $ajax_message = [
                    'status'=>'error',
                    'message'=> translate('too_many_attempts. please_try_again_after_'). CarbonInterval::seconds($time)->cascade()->forHumans(),
                    'redirect_url'=>''
                ];
                Toastr::error(translate('too_many_attempts. please_try_again_after_'). CarbonInterval::seconds($time)->cascade()->forHumans());
            }else{
                $ajax_message = [
                    'status'=>'error',
                    'message'=> translate('credentials_do_not_match_or_account_has_been_suspended'),
                    'redirect_url'=>''
                ];
                Toastr::error(translate('credentials_do_not_match_or_account_has_been_suspended'));

                $user->login_hit_count += 1;
                $user->save();
            }
            //login attempt check end

            if($request->ajax()) {
                return response()->json($ajax_message);
            }else{
                return back()->withInput();
            }
        }
    }

    public function logout(Request $request)
    {
        auth()->guard('customer')->logout();
        session()->forget('wish_list');
        Toastr::info('Come back soon, ' . '!');
        return redirect()->route('home');
    }
}
