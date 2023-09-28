@extends('layouts.front-end.app')

@section('title', $web_config['name']->value.' '.\App\CPU\translate('Online Shopping').' | '.$web_config['name']->value.' '.\App\CPU\translate(' Ecommerce'))

@push('css_or_js')
    <meta property="og:image" content="{{asset('storage/app/public/company')}}/{{$web_config['web_logo']->value}}"/>
    <meta property="og:title" content="Welcome To {{$web_config['name']->value}} Home"/>
    <meta property="og:url" content="{{env('APP_URL')}}">
    <meta property="og:description" content="{!! substr($web_config['about']->value,0,100) !!}">

    <meta property="twitter:card" content="{{asset('storage/app/public/company')}}/{{$web_config['web_logo']->value}}"/>
    <meta property="twitter:title" content="Welcome To {{$web_config['name']->value}} Home"/>
    <meta property="twitter:url" content="{{env('APP_URL')}}">
    <meta property="twitter:description" content="{!! substr($web_config['about']->value,0,100) !!}">

    <link rel="stylesheet" href="{{asset('assets/front-end')}}/css/home.css"/>
    <style>
        .cz-countdown-days {
            border: .5px solid{{$web_config['primary_color']}};
        }

        .btn-scroll-top {
            background: {{$web_config['primary_color']}};
        }

        .__best-selling:hover .ptr,
        .flash_deal_product:hover .flash-product-title {
            color: {{$web_config['primary_color']}};
        }

        .cz-countdown-hours {
            border: .5px solid{{$web_config['primary_color']}};
        }

        .cz-countdown-minutes {
            border: .5px solid{{$web_config['primary_color']}};
        }

        .cz-countdown-seconds {
            border: .5px solid{{$web_config['primary_color']}};
        }

        .flash_deal_product_details .flash-product-price {
            color: {{$web_config['primary_color']}};
        }

        .featured_deal_left {
            background: {{$web_config['primary_color']}} 0% 0% no-repeat padding-box;
        }

        .category_div:hover {
            color: {{$web_config['secondary_color']}};
        }

        .deal_of_the_day {
            background: {{$web_config['secondary_color']}};
        }

        .best-selleing-image {
            background: {{$web_config['primary_color']}}10;
        }

        .top-rated-image {
            background: {{$web_config['primary_color']}}10;
        }

        @media (max-width: 800px) {
            .categories-view-all {
            {{session('direction') === "rtl" ? 'margin-left: 10px;' : 'margin-right: 6px;'}}

            }

            .categories-title {
            {{Session::get('direction') === "rtl" ? 'margin-right: 0px;' : 'margin-left: 6px;'}}

            }

            .seller-list-title {
            {{Session::get('direction') === "rtl" ? 'margin-right: 0px;' : 'margin-left: 10px;'}}

            }

            .seller-list-view-all {
            {{Session::get('direction') === "rtl" ? 'margin-left: 20px;' : 'margin-right: 10px;'}}

            }

            .category-product-view-title {
            {{Session::get('direction') === "rtl" ? 'margin-right: 16px;' : 'margin-left: -8px;'}}

            }

            .category-product-view-all {
            {{Session::get('direction') === "rtl" ? 'margin-left: -7px;' : 'margin-right: 5px;'}}

            }
        }

        @media (min-width: 801px) {
            .categories-view-all {
            {{session('direction') === "rtl" ? 'margin-left: 30px;' : 'margin-right: 27px;'}}

            }

            .categories-title {
            {{Session::get('direction') === "rtl" ? 'margin-right: 25px;' : 'margin-left: 25px;'}}

            }

            .seller-list-title {
            {{Session::get('direction') === "rtl" ? 'margin-right: 6px;' : 'margin-left: 10px;'}}

            }

            .seller-list-view-all {
            {{Session::get('direction') === "rtl" ? 'margin-left: 12px;' : 'margin-right: 10px;'}}

            }

            .seller-card {
            {{Session::get('direction') === "rtl" ? 'padding-left:0px !important;' : 'padding-right:0px !important;'}}

            }

            .category-product-view-title {
            {{Session::get('direction') === "rtl" ? 'margin-right: 10px;' : 'margin-left: -12px;'}}

            }

            .category-product-view-all {
            {{Session::get('direction') === "rtl" ? 'margin-left: -20px;' : 'margin-right: 0px;'}}

            }
        }

        .countdown-card {
            background: {{$web_config['primary_color']}}10;

        }

        .flash-deal-text {
            color: {{$web_config['primary_color']}};
        }

        .countdown-background {
            background: {{$web_config['primary_color']}};
        }

        }
        .czi-arrow-left {
            color: {{$web_config['primary_color']}};
            background: {{$web_config['primary_color']}}10;
        }

        .czi-arrow-right {
            color: {{$web_config['primary_color']}};
            background: {{$web_config['primary_color']}}10;
        }

        .flash-deals-background-image {
            background: {{$web_config['primary_color']}}10;
        }

        .view-all-text {
            color: {{$web_config['secondary_color']}}  !important;
        }

        .feature-product .czi-arrow-left {
            color: {{$web_config['primary_color']}};
            background: {{$web_config['primary_color']}}10
        }

        .feature-product .czi-arrow-right {
            color: {{$web_config['primary_color']}};
            background: {{$web_config['primary_color']}}10;
            font-size: 12px;
        }

        /*  */
    </style>

    <link rel="stylesheet" href="{{asset('assets/front-end')}}/css/owl.carousel.min.css"/>
    <link rel="stylesheet" href="{{asset('assets/front-end')}}/css/owl.theme.default.min.css"/>
@endpush

@section('content')
    @php($categories = \App\Model\Category::with('childes.childes')->where(['position' => 0])->priority()->take(11)->get())
    @php($brands = \App\Model\Brand::active()->take(15)->get())
    <div class="__inline-61">
        @php($decimal_point_settings = !empty(\App\CPU\Helpers::get_business_settings('decimal_point_settings')) ? \App\CPU\Helpers::get_business_settings('decimal_point_settings') : 0)
        <!-- Hero (Banners + Slider)-->
        <section class="bg-transparent mb-3">
            <div class="container">
                <div class="row ">
                    <div class="col-12">
                        @include('web-views.partials._home-top-slider',['main_banner'=>$main_banner])
                    </div>
                </div>
            </div>
        </section>

        {{--flash deal--}}
        @if ($web_config['flash_deals'])
            <section class="overflow-hidden">
                <div class="container">
                    <div
                        class="flash-deal-view-all-web row d-none d-lg-flex justify-content-{{Session::get('direction') === 'rtl' ? 'start' : 'end'}}"
                        style="{{Session::get('direction') === 'rtl' ? 'margin-left: 2px;' : 'margin-right:2px;'}}">
                        @if (count($web_config['flash_deals']->products)>0)
                            <a class="text-capitalize view-all-text"
                               href="{{route('flash-deals',[$web_config['flash_deals']?$web_config['flash_deals']['id']:0])}}">
                                {{ \App\CPU\translate('view_all')}}
                                <i class="czi-arrow-{{Session::get('direction') === 'rtl' ? 'left mr-1 ml-n1 mt-1 float-left' : 'right ml-1 mr-n1'}}"></i>
                            </a>
                        @endif
                    </div>
                    <div class="row d-flex {{Session::get('direction') === 'rtl' ? 'flex-row-reverse' : 'flex-row'}}">


                        <div class="col-xl-3 col-lg-4 mt-2 countdown-card">
                            <div class="m-2">
                                <div class="flash-deal-text">
                                    <span>{{ \App\CPU\translate('flash deal')}}</span>
                                </div>
                                <div class="text-center text-white">
                                    <div class="countdown-background">
                                <span class="cz-countdown d-flex justify-content-center align-items-center"
                                      data-countdown="{{$web_config['flash_deals']?date('m/d/Y',strtotime($web_config['flash_deals']['end_date'])):''}} 11:59:00 PM">
                                    <span class="cz-countdown-days">
                                        <span class="cz-countdown-value"></span>
                                        <span>{{ \App\CPU\translate('day')}}</span>
                                    </span>
                                    <span class="cz-countdown-value p-1">:</span>
                                    <span class="cz-countdown-hours">
                                        <span class="cz-countdown-value"></span>
                                        <span>{{ \App\CPU\translate('hrs')}}</span>
                                    </span>
                                    <span class="cz-countdown-value p-1">:</span>
                                    <span class="cz-countdown-minutes">
                                        <span class="cz-countdown-value"></span>
                                        <span>{{ \App\CPU\translate('min')}}</span>
                                    </span>
                                    <span class="cz-countdown-value p-1">:</span>
                                    <span class="cz-countdown-seconds">
                                        <span class="cz-countdown-value"></span>
                                        <span>{{ \App\CPU\translate('sec')}}</span>
                                    </span>
                                </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="flash-deal-view-all-mobile col-lg-12 d-block d-xl-none"
                             style="{{Session::get('direction') === 'rtl' ? 'margin-left: 2px;' : 'margin-right:2px;'}}">
                        </div>
                        <div class="col-xl-9 col-lg-8 {{Session::get('direction') === 'rtl' ? 'pr-md-4' : 'pl-md-4'}}">
                            <div class="d-lg-none {{Session::get('direction') === 'rtl' ? 'text-left' : 'text-right'}}">
                                <a class="mt-2 text-capitalize view-all-text"
                                   href="{{route('flash-deals',[$web_config['flash_deals']?$web_config['flash_deals']['id']:0])}}">
                                    {{ \App\CPU\translate('view_all')}}
                                    <i class="czi-arrow-{{Session::get('direction') === 'rtl' ? 'left mr-1 ml-n1 mt-1 float-left' : 'right ml-1 mr-n1'}}"></i>
                                </a>
                            </div>
                            <div class="carousel-wrap">
                                <div class="owl-carousel owl-theme mt-2" id="flash-deal-slider">
                                    @foreach($web_config['flash_deals']->products as $key=>$deal)
                                        @if( $deal->product)
                                            @include('web-views.partials._product-card-1',['product'=>$deal->product,'decimal_point_settings'=>$decimal_point_settings])
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endif

        {{--brands--}}
        @if($web_config['brand_setting'])
            <section class="container rtl mt-3">
                <!-- Heading-->
                <div class="section-header">
                    <div class="text-black font-bold __text-22px">
                        <span> {{\App\CPU\translate('brands')}}</span>
                    </div>
                    <div class="__mr-2px">
                        <a class="text-capitalize view-all-text" href="{{route('brands')}}">
                            {{ \App\CPU\translate('view_all')}}
                            <i class="czi-arrow-{{Session::get('direction') === 'rtl' ? 'left mr-1 ml-n1 mt-1 float-left' : 'right ml-1 mr-n1'}}"></i>
                        </a>
                    </div>
                </div>
                <!-- Grid-->

                <div class="mt-sm-3 mb-3 brand-slider">
                    <div class="owl-carousel owl-theme p-2" id="brands-slider">
                        @foreach($brands as $brand)
                            <div class="text-center">
                                <a href="{{route('products',['id'=> $brand['id'],'data_from'=>'brand','page'=>1])}}"
                                   class="__brand-item">
                                    <img
                                        onerror="this.src='{{asset('public/assets/front-end/img/image-place-holder.png')}}'"
                                        src="{{asset('storage/app/public/brand/'.$brand->image)}}"
                                        alt="{{$brand->name}}">
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif

        <!-- Products grid (featured products)-->
        @if ($featured_products->count() > 0 )
            <div class="container mb-4">
                <div class="row __inline-62">
                    <div class="col-md-12">
                        <div class="feature-product-title">
                            {{ \App\CPU\translate('featured_products')}}
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="feature-product">
                            <div class="carousel-wrap p-1">
                                <div class="owl-carousel owl-theme " id="featured_products_list">
                                    @foreach($featured_products as $product)
                                        <div>
                                            @include('web-views.partials._feature-product',['product'=>$product, 'decimal_point_settings'=>$decimal_point_settings])
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        {{--featured deal--}}

        @if($web_config['featured_deals'])
            <section class="featured_deal rtl">
                <div class="container">
                    <div class="row __featured-deal-wrap" style="background: {{$web_config['primary_color']}};">
                        <div class="col-12 pb-2">
                            @if (count($web_config['featured_deals'])>0)
                                <div
                                    class="{{Session::get('direction') === 'rtl' ? 'text-left ml-lg-3' : 'text-right mr-lg-3'}}">
                                    <a class="text-capitalize text-white"
                                       href="{{route('products',['data_from'=>'featured_deal'])}}">
                                        {{ \App\CPU\translate('view_all')}}
                                        <i class="czi-arrow-{{Session::get('direction') === 'rtl' ? 'left mr-1 ml-n1 mt-1' : 'right ml-1'}} text-white"></i>
                                    </a>
                                </div>
                            @endif
                        </div>
                        <div class="col-xl-3 col-lg-4">
                            <div class="m-lg-4 mb-4">
                                <span
                                    class="featured_deal_title __pt-12">{{ \App\CPU\translate('featured_deal')}}</span>
                                <br>

                                <span class="text-white text-left">{{ \App\CPU\translate('See the latest deals and exciting new offers')}}!</span>

                            </div>

                        </div>

                        <div
                            class="col-xl-9 col-lg-8 d-flex align-items-center justify-content-center {{Session::get('direction') === 'rtl' ? 'pl-md-4' : 'pr-md-4'}}">
                            <div class="owl-carousel owl-theme" id="web-feature-deal-slider">
                                @foreach($web_config['featured_deals'] as $key=>$product)
                                    @include('web-views.partials._feature-deal-product',['product'=>$product, 'decimal_point_settings'=>$decimal_point_settings])
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endif


        <style>
            .featured-deal-images-list {
                margin: 30px 0;
            }
            .feature-deal-images-list a {
                height: 100%;
                columns: rgb(72, 72, 72);
            }
            .feature-deal-images-list img {
                object-fit: contain;
                min-height: 100%;
                left: 0;
                top: 0;
                padding: 0;
            }
            .featured-deal-images-grid {
                display: grid;
                grid-template-columns: repeat(3, minmax(0, 0.8fr));
                grid-template-rows: auto;
                text-align: center;
                grid-gap: 4%;
            }
            .featured-deal-images-item {
                width: 100%;
                height: 100%;
                display: block;
                position: relative;
            }
            .featured-deal-images-aspect-constraint>* {
                pointer-events: initial;
            }
            .featured-deal-images-ratio-box {
                width: 100%;
                position: relative;
                height: 100%;
                display: block;
                padding-bottom: 75%;
                border-radius: 5%;
            }
            .featured-deal-images-aspect-constraint {
                position: absolute;
                top: 0;
                pointer-events: none;
                background: none;
            }
            .featured-deal-images__products-list {
                list-style-type: none;
            }
            .featured-deal-images__area {
                position: absolute;
            }
            .featured-deal-images__dot {
                transition: border-color 250ms ease-in-out, opacity 250ms ease-in-out, visibility 250ms ease-in-out;
                transform: translateY(3rem) scale(0.999);
                padding: 0;
                width: 2rem;
                height: 2rem;
                border: 2px solid transparent;
                position: absolute;
                background: rgba(17, 17, 17, 0.2);
                opacity: 0;
                visibility: hidden;
                border-radius: 64px;
                line-height: .5;
                display: flex;
                align-items: center;
                justify-content: center;
            }
            .featured-deal-images__dot::before {
                content: "";
                position: absolute;
                top: -0.5rem;
                left: -0.5rem;
                right: -0.5rem;
                bottom: -0.5rem;
                display: block;
            }
            .featured-deal-images__dot::after {
                content: "";
                transition: transform 250ms ease-in-out;
                position: relative;
                display: block;
                background: rgb(255, 255, 255);
                box-shadow: 0 1px 4px rgba(17, 17, 17, 0.55);
                width: 0.75rem;
                height: 0.75rem;
                border-radius: 64px;
            }
            .featured-deal-images__dot:hover {
                border-color: rgba(255, 255, 255, 0.5);
                background: rgba(17, 17, 17, 0.4);
            }
            .featured-deal-images__area a:hover {
                color: rgb(17, 17, 17);
            }

            .featured-deal-image__tag {
                z-index: 1;
                transition: opacity 250ms ease-in-out, visibility 250ms ease-in-out;
                transform: translateX(20%) translateY(-55%);
                min-width: 7rem;
                position: absolute;
                opacity: 0;
                visibility: hidden;
                box-shadow: 0 1px 4px rgba(17, 17, 17, 0.4);
            }
            .featured-deal-image__tag2-sofa {
                transform: translateX(30%) translateY(55%);
            }
            .featured-deal-image__tag:hover {
                visibility: visible!important;
                opacity: 1!important;
                text-decoration: none!important;
            }
            .featured-deal-images__tag-inner {
                transition: transform 250ms ease-in-out;
                width: 100%;
                text-align: initial;
                display: flex;
                flex-direction: column;
                text-decoration: none;
                color: rgb(17, 17, 17);
                background-color: rgb(255, 255, 255);
            }
            .featured-deal-images-ratio-box:hover .featured-deal-images__dot{
                visibility: visible;
            }
            .featured-deal-image-price-package {
                display: inline-block;
                background-color: rgb(255, 255, 255);
            }
            .featured-deal-images-price-package__link, 
            .featured-deal-images-price-package__link:hover {
                display: flex;
                justify-content: space-between;
                width: 100%;
            }
            .featured-deal-images-price-module__information {
                margin-bottom: 0.5rem;
                padding: 0.5rem 1.25rem;
            }
            .featured-deal-images-commercial-message {
                font-size: 0.8rem;
                font-weight: 600;
                line-height: 1.2;
            }
            .featured-deal-images-commercial-message-title {
                color: rgb(202, 80, 8);
            }
            .featured-deal-images-price-module-name {
                text-transform: uppercase;
                color: rgb(17, 17, 17);
            }
            .featured-deal-images-secion__title {
                font-size: 0.75rem;
                font-weight: 700;
            }
            .featured-deal-images-sction__description {
                font-size: 0.7rem;
            }
            .featured-deal-images-price-module__price {
                color: rgb(17, 17, 17);
            }
            .featured-deal-images-price-module__price-temp-mark {
                font-size: 0.6rem;
            }
            .featured-deal-images-price-module__price-temp-value {
                font-size: 0.8rem;
            }
            /* .featured-deal-images-package__chevron {
                display: flex;
                align-items: center;
                justify-content: center;
                border-left: 1px solid rgb(233, 233, 233);
            } */
        </style>

        <div class="featured-deal-images-list">
            <div class="container">
                <div class="featured-deal-images-grid">
                    <div class="featured-deal-images-item">
                        <a href="#">
                            <img src="/public/assets/front-end/img/furniture-table.png" alt="Bedside Table" onmouseover="dotFeatured1Display()" onmouseout="dotFeatured1Hidden()">
                        </a>
                        <div class="featured-deal-images-ratio-box featured-deal-images-ratio-box1 featured-deal-images-aspect-constraint">
                            <ul class="featured-deal-images__products-list">
                                <li class="featured-deal-images__area" aria-hidden="true" style="top:45%; left:10%;">
                                    <a href="/product/shale-bedside-table-JYPOU9" class="featured-deal-images__dot featured-deal-images__dot1 featured-deal-images__dot1-shale" aria-labelledby="featured-deal-images-art, 0101" onmouseenter="detailFeatured1ShaleDisply()" onmouseleave="detailFeatured1ShaleHidden()"></a>
                                    <div class="featured-deal-image__tag featured-deal-image__tag1 featured-deal-image__tag1-shale" aria-hidden="true" role="tooltip" id="featured-deal-images-art, 0101">
                                        <div class="featured-deal-images__tag-inner">
                                            <div class="featured-deal-image-price-package">
                                                <a href="#" class="featured-deal-images-price-package__link">
                                                    <div class="featured-deal-images-price-module__information">
                                                        <div class="featured-deal-images-commercial-message">
                                                            <span class="featured-deal-images-commercial-message-title">New</span>
                                                        </div>
                                                        <div class="featured-deal-images-price-module-name">
                                                            <span class="featured-deal-images-secion__title">Nightstand</span><br>
                                                            <span class="featured-deal-images-sction__description">Shale</span>
                                                        </div>
                                                        <div class="featured-deal-images-price-module__price">
                                                            <span class="featured-deal-images-price-module__price-temp-mark"> $ </span>
                                                            <span class="featured-deal-images-price-module__price-temp-value"> 693.00 </span>
                                                        </div>
                                                    </div>
                                                    <!-- <div class="featured-deal-images-package__chevron">
                                                        <svg focusable="false" viewBox="0 0 24 24" width="24" height="24" class="pip-svg-icon" aria-hidden="true"><path fill-rule="evenodd" clip-rule="evenodd" d="m16.415 12.0011-8.0012 8.0007-1.4141-1.4143 6.587-6.5866-6.586-6.5868L8.415 4l8 8.0011z"></path></svg>
                                                    </div> -->
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="featured-deal-images__area" aria-hidden="true" style="top: 40%; left: 45%;">
                                    <a href="/product/full-bed-BcXbdS" class="featured-deal-images__dot featured-deal-images__dot1 featured-deal-images__dot1-fullbed" aria-labelledby="featured-deal-images-art, 0102" onmouseenter="detailFeatured1FullbedDisply()" onmouseleave="detailFeatured1FullbedHidden()"></a>
                                    <div class="featured-deal-image__tag featured-deal-image__tag1 featured-deal-image__tag1-fullbed" aria-hidden="true" role="tooltip" id="featured-deal-images-art, 0102">
                                        <div class="featured-deal-images__tag-inner">
                                            <div class="featured-deal-image-price-package">
                                                <a href="/product/full-bed-BcXbdS" class="featured-deal-images-price-package__link">
                                                    <div class="featured-deal-images-price-module__information">
                                                        <div class="featured-deal-images-commercial-message">
                                                            <span class="featured-deal-images-commercial-message-title">New</span>
                                                        </div>
                                                        <div class="featured-deal-images-price-module-name">
                                                            <span class="featured-deal-images-secion__title">Bed</span><br>
                                                            <span class="featured-deal-images-sction__description">Ikea Bed</span>
                                                        </div>
                                                        <div class="featured-deal-images-price-module__price">
                                                            <span class="featured-deal-images-price-module__price-temp-mark"> $ </span>
                                                            <span class="featured-deal-images-price-module__price-temp-value"> 2400.00 </span>
                                                        </div>
                                                    </div>
                                                    <!-- <div class="featured-deal-images-package__chevron">
                                                        <svg focusable="false" viewBox="0 0 24 24" width="24" height="24" class="pip-svg-icon" aria-hidden="true"><path fill-rule="evenodd" clip-rule="evenodd" d="m16.415 12.0011-8.0012 8.0007-1.4141-1.4143 6.587-6.5866-6.586-6.5868L8.415 4l8 8.0011z"></path></svg>
                                                    </div> -->
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="featured-deal-images-item">
                        <a href="#">
                            <img src="/public/assets/front-end/img/Moravian-End-Table.png" alt="Moravian End Table" onmouseover="dotFeatured2Display()" onmouseout="dotFeatured2Hidden()">
                        </a>
                        <div class="featured-deal-images-ratio-box featured-deal-images-ratio-box2 featured-deal-images-aspect-constraint">
                            <ul class="featured-deal-images__products-list">
                                <li class="featured-deal-images__area" aria-hidden="true" style="top:10%; left: 10%">
                                    <a href="/product/sofa-grey-OBwypQ" class="featured-deal-images__dot featured-deal-images__dot2 featured-deal-images__dot2-sofa" aria-labelledby="featured-deal-images-art, 0201" onmouseenter="detailFeatured2SofaDisply()" onmouseleave="detailFeatured2SofaHidden()"></a>
                                    <div class="featured-deal-image__tag featured-deal-image__tag2 featured-deal-image__tag2-sofa" aria-hidden="true" role="tooltip" id="featured-deal-images-art, 0201">
                                        <div class="featured-deal-images__tag-inner">
                                            <div class="featured-deal-image-price-package">
                                                <a href="/product/sofa-grey-OBwypQ" class="featured-deal-images-price-package__link">
                                                    <div class="featured-deal-images-price-module__information">
                                                        <div class="featured-deal-images-commercial-message">
                                                            <span class="featured-deal-images-commercial-message-title">New</span>
                                                        </div>
                                                        <div class="featured-deal-images-price-module-name">
                                                            <span class="featured-deal-images-secion__title">Sofa</span><br>
                                                            <span class="featured-deal-images-sction__description">Sofa(gray)</span>
                                                        </div>
                                                        <div class="featured-deal-images-price-module__price">
                                                            <span class="featured-deal-images-price-module__price-temp-mark"> $ </span>
                                                            <span class="featured-deal-images-price-module__price-temp-value"> 1076.00 </span>
                                                        </div>
                                                    </div>
                                                    <!-- <div class="featured-deal-images-package__chevron">
                                                        <svg focusable="false" viewBox="0 0 24 24" width="24" height="24" class="pip-svg-icon" aria-hidden="true"><path fill-rule="evenodd" clip-rule="evenodd" d="m16.415 12.0011-8.0012 8.0007-1.4141-1.4143 6.587-6.5866-6.586-6.5868L8.415 4l8 8.0011z"></path></svg>
                                                    </div> -->
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="featured-deal-images__area" aria-hidden="true" style="top:40%; left: 40%">
                                    <a href="/product/bedside-table-white-LAM0is" class="featured-deal-images__dot featured-deal-images__dot2 featured-deal-images__dot2-bedsidetable" aria-labelledby="featured-deal-images-art, 0202" onmouseenter="detailFeatured2BedsidetableDisply()" onmouseleave="detailFeatured2BedsidetableHidden()"></a>
                                    <div class="featured-deal-image__tag featured-deal-image__tag2 featured-deal-image__tag2-bedsidetable" aria-hidden="true" role="tooltip" id="featured-deal-images-art, 0202">
                                        <div class="featured-deal-images__tag-inner">
                                            <div class="featured-deal-image-price-package">
                                                <a href="/product/bedside-table-white-LAM0is" class="featured-deal-images-price-package__link">
                                                    <div class="featured-deal-images-price-module__information">
                                                        <div class="featured-deal-images-commercial-message">
                                                            <span class="featured-deal-images-commercial-message-title">New</span>
                                                        </div>
                                                        <div class="featured-deal-images-price-module-name">
                                                            <span class="featured-deal-images-secion__title">Bed</span><br>
                                                            <span class="featured-deal-images-sction__description">Ikea Bed</span>
                                                        </div>
                                                        <div class="featured-deal-images-price-module__price">
                                                            <span class="featured-deal-images-price-module__price-temp-mark"> $ </span>
                                                            <span class="featured-deal-images-price-module__price-temp-value"> 142.50 </span>
                                                        </div>
                                                    </div>
                                                    <!-- <div class="featured-deal-images-package__chevron">
                                                        <svg focusable="false" viewBox="0 0 24 24" width="24" height="24" class="pip-svg-icon" aria-hidden="true"><path fill-rule="evenodd" clip-rule="evenodd" d="m16.415 12.0011-8.0012 8.0007-1.4141-1.4143 6.587-6.5866-6.586-6.5868L8.415 4l8 8.0011z"></path></svg>
                                                    </div> -->
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="featured-deal-images-item">
                        <a href="#">
                            <img src="/public/assets/front-end/img/full-bed.png" alt="Fill Bed" onmouseover="dotFeatured3Display()" onmouseout="dotFeatured3Hidden()">
                        </a>
                        <div class="featured-deal-images-ratio-box featured-deal-images-ratio-box3 featured-deal-images-aspect-constraint">
                            <ul class="featured-deal-images__products-list">
                                <li class="featured-deal-images__area" aria-hidden="true" style="top:40%; left:40%;">
                                    <a href="/product/full-bed-BcXbdS" class="featured-deal-images__dot featured-deal-images__dot3" aria-labelledby="featured-deal-images-art, 03" onmouseenter="detailFeatured3Disply()" onmouseleave="detailFeatured3Hidden()"></a>
                                    <div class="featured-deal-image__tag featured-deal-image__tag3" aria-hidden="true" role="tooltip" id="featured-deal-images-art, 03">
                                        <div class="featured-deal-images__tag-inner">
                                            <div class="featured-deal-image-price-package">
                                                <a href="/product/full-bed-BcXbdS" class="featured-deal-images-price-package__link">
                                                    <div class="featured-deal-images-price-module__information">
                                                        <div class="featured-deal-images-commercial-message">
                                                            <span class="featured-deal-images-commercial-message-title">New</span>
                                                        </div>
                                                        <div class="featured-deal-images-price-module-name">
                                                            <span class="featured-deal-images-secion__title">MICROSOFT</span><br>
                                                            <span class="featured-deal-images-sction__description">EARPHONE</span>
                                                        </div>
                                                        <div class="featured-deal-images-price-module__price">
                                                            <span class="featured-deal-images-price-module__price-temp-mark"> $ </span>
                                                            <span class="featured-deal-images-price-module__price-temp-value"> 2400.00 </span>
                                                        </div>
                                                    </div>
                                                    <!-- <div class="featured-deal-images-package__chevron">
                                                        <svg focusable="false" viewBox="0 0 24 24" width="24" height="24" class="pip-svg-icon" aria-hidden="true"><path fill-rule="evenodd" clip-rule="evenodd" d="m16.415 12.0011-8.0012 8.0007-1.4141-1.4143 6.587-6.5866-6.586-6.5868L8.415 4l8 8.0011z"></path></svg>
                                                    </div> -->
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            // In Item1
            function dotFeatured1Display() {
                let dot_item1_image_shale = document.querySelector(".featured-deal-images__dot1-shale")
                let dot_item1_image_fullbed = document.querySelector(".featured-deal-images__dot1-fullbed")
                dot_item1_image_shale.style.visibility = "visible";
                dot_item1_image_shale.style.opacity = 1;
                dot_item1_image_fullbed.style.visibility = "visible";
                dot_item1_image_fullbed.style.opacity = 1;
            }
            function dotFeatured1Hidden() {
                let dot_item1_image_shale = document.querySelector(".featured-deal-images__dot1-shale")
                let dot_item1_image_fullbed = document.querySelector(".featured-deal-images__dot1-fullbed")
                dot_item1_image_shale.style.visibility = "hidden";
                dot_item1_image_shale.style.opacity = 0;
                dot_item1_image_fullbed.style.visibility = "hidden";
                dot_item1_image_fullbed.style.opacity = 0;
            }
            function detailFeatured1ShaleDisply() {
                const dot_item1_image_shale = document.querySelector(".featured-deal-images__dot1-shale");
                const dot_item1_image_fullbed = document.querySelector(".featured-deal-images__dot1-fullbed");
                const detail_item1_image = document.querySelector(".featured-deal-image__tag1-shale");
                dot_item1_image_shale.style.visibility = "visible";
                dot_item1_image_shale.style.opacity = 1;
                dot_item1_image_fullbed.style.visibility = "visible";
                dot_item1_image_fullbed.style.opacity = 1;
                detail_item1_image.style.visibility = "visible";
                detail_item1_image.style.opacity = 1;
            }
            function detailFeatured1ShaleHidden() {
                const dot_item1_image_shale = document.querySelector(".featured-deal-images__dot1-shale");
                const dot_item1_image_fullbed = document.querySelector(".featured-deal-images__dot1-fullbed");
                const detail_item1_image = document.querySelector(".featured-deal-image__tag1-shale");
                dot_item1_image_shale.style.visibility = "visible";
                dot_item1_image_shale.style.opacity = 1;
                dot_item1_image_fullbed.style.visibility = "visible";
                dot_item1_image_fullbed.style.opacity = 1;
                detail_item1_image.style.visibility = "hidden";
                detail_item1_image.style.opacity = 0;
            }
            function detailFeatured1FullbedDisply() {
                const dot_item1_image_shale = document.querySelector(".featured-deal-images__dot1-shale");
                const dot_item1_image_fullbed = document.querySelector(".featured-deal-images__dot1-fullbed");
                const detail_item1_image = document.querySelector(".featured-deal-image__tag1-fullbed");
                dot_item1_image_shale.style.visibility = "visible";
                dot_item1_image_shale.style.opacity = 1;
                dot_item1_image_fullbed.style.visibility = "visible";
                dot_item1_image_fullbed.style.opacity = 1;
                detail_item1_image.style.visibility = "visible";
                detail_item1_image.style.opacity = 1;
            }
            function detailFeatured1FullbedHidden() {
                const dot_item1_image_shale = document.querySelector(".featured-deal-images__dot1-shale");
                const dot_item1_image_fullbed = document.querySelector(".featured-deal-images__dot1-fullbed");
                const detail_item1_image = document.querySelector(".featured-deal-image__tag1-fullbed");
                dot_item1_image_shale.style.visibility = "visible";
                dot_item1_image_shale.style.opacity = 1;
                dot_item1_image_fullbed.style.visibility = "visible";
                dot_item1_image_fullbed.style.opacity = 1;
                detail_item1_image.style.visibility = "hidden";
                detail_item1_image.style.opacity = 0;
            }
            // In Item2
            function dotFeatured2Display() {
                const dot_item2_image_sofa = document.querySelector(".featured-deal-images__dot2-sofa");
                const dot_item2_image_bedsidetable = document.querySelector(".featured-deal-images__dot2-bedsidetable");
                dot_item2_image_sofa.style.visibility = "visible";
                dot_item2_image_sofa.style.opacity = 1;
                dot_item2_image_bedsidetable.style.visibility = "visible";
                dot_item2_image_bedsidetable.style.opacity = 1;
            }
            function dotFeatured2Hidden() {
                const dot_item2_image_sofa = document.querySelector(".featured-deal-images__dot2-sofa");
                const dot_item2_image_bedsidetable = document.querySelector(".featured-deal-images__dot2-bedsidetable");
                dot_item2_image_sofa.style.visibility = "hidden";
                dot_item2_image_sofa.style.opacity = 0;
                dot_item2_image_bedsidetable.style.visibility = "hidden";
                dot_item2_image_bedsidetable.style.opacity = 0;
            }
            function detailFeatured2SofaDisply() {
                const dot_item2_image_sofa = document.querySelector(".featured-deal-images__dot2-sofa");
                const dot_item2_image_bedsidetable = document.querySelector(".featured-deal-images__dot2-bedsidetable");
                const detail_item2_image_sofa = document.querySelector(".featured-deal-image__tag2-sofa");
                dot_item2_image_sofa.style.visibility = "visible";
                dot_item2_image_sofa.style.opacity = 1;
                dot_item2_image_bedsidetable.style.visibility = "visible";
                dot_item2_image_bedsidetable.style.opacity = 1;
                detail_item2_image_sofa.style.visibility = "visible";
                detail_item2_image_sofa.style.opacity = 1;
            }
            function detailFeatured2SofaHidden() {
                const dot_item2_image_sofa = document.querySelector(".featured-deal-images__dot2-sofa");
                const dot_item2_image_bedsidetable = document.querySelector(".featured-deal-images__dot2-bedsidetable");
                const detail_item2_image_sofa = document.querySelector(".featured-deal-image__tag2-sofa");
                dot_item2_image_sofa.style.visibility = "visible";
                dot_item2_image_sofa.style.opacity = 1;
                dot_item2_image_bedsidetable.style.visibility = "visible";
                dot_item2_image_bedsidetable.style.opacity = 1;
                detail_item2_image_sofa.style.visibility = "hidden";
                detail_item2_image_sofa.style.opacity = 0;
            }
            function detailFeatured2BedsidetableDisply() {
                const dot_item2_image_sofa = document.querySelector(".featured-deal-images__dot2-sofa");
                const dot_item2_image_bedsidetable = document.querySelector(".featured-deal-images__dot2-bedsidetable");
                const detail_item2_image_bedsidetable = document.querySelector(".featured-deal-image__tag2-bedsidetable");
                dot_item2_image_sofa.style.visibility = "visible";
                dot_item2_image_sofa.style.opacity = 1;
                dot_item2_image_bedsidetable.style.visibility = "visible";
                dot_item2_image_bedsidetable.style.opacity = 1;
                detail_item2_image_bedsidetable.style.visibility = "visible";
                detail_item2_image_bedsidetable.style.opacity = 1;
            }
            function detailFeatured2BedsidetableHidden() {
                const dot_item2_image_sofa = document.querySelector(".featured-deal-images__dot2-sofa");
                const dot_item2_image_bedsidetable = document.querySelector(".featured-deal-images__dot2-bedsidetable");
                const detail_item2_image_bedsidetable = document.querySelector(".featured-deal-image__tag2-bedsidetable");
                dot_item2_image_sofa.style.visibility = "visible";
                dot_item2_image_sofa.style.opacity = 1;
                dot_item2_image_bedsidetable.style.visibility = "visible";
                dot_item2_image_bedsidetable.style.opacity = 1;
                detail_item2_image_bedsidetable.style.visibility = "hidden";
                detail_item2_image_bedsidetable.style.opacity = 0;
            }
            // In Item3
            function dotFeatured3Display() {
                const dot_item3_image = document.querySelector(".featured-deal-images__dot3");
                dot_item3_image.style.visibility = "visible";
                dot_item3_image.style.opacity = 1;
            }
            function dotFeatured3Hidden() {
                const dot_item3_image = document.querySelector(".featured-deal-images__dot3");
                dot_item3_image.style.visibility = "hidden";
                dot_item3_image.style.opacity = 0;
            }
            function detailFeatured3Disply() {
                const dot_item3_image = document.querySelector(".featured-deal-images__dot3");
                const detail_item3_image = document.querySelector(".featured-deal-image__tag3");
                dot_item3_image.style.visibility = "visible";
                dot_item3_image.style.opacity = 1;
                detail_item3_image.style.visibility = "visible";
                detail_item3_image.style.opacity = 1;
            }
            function detailFeatured3Hidden() {
                const dot_item3_image = document.querySelector(".featured-deal-images__dot3");
                const detail_item3_image = document.querySelector(".featured-deal-image__tag3");
                dot_item3_image.style.visibility = "visible";
                dot_item3_image.style.opacity = 1;
                detail_item3_image.style.visibility = "hidden";
                detail_item3_image.style.opacity = 0;
            }
        </script>

        {{--deal of the day--}}
        <div class="container rtl">
            <div class="row g-4 pt-2 mt-0 mb-4 pb-2 __deal-of">
                {{-- Deal of the day/Recommended Product --}}
                <div class="col-xl-3 col-md-4">
                    <div class="deal_of_the_day h-100" style="background: {{$web_config['primary_color']}}">
                        @if(isset($deal_of_the_day) && isset($deal_of_the_day->product))
                            <div class="d-flex justify-content-center align-items-center __w-70p mx-auto">
                                <h1 class="align-items-center text-white"> {{ \App\CPU\translate('deal_of_the_day') }}</h1>
                            </div>
                            <div class="recomanded-product-card">

                                <div class="d-flex justify-content-center align-items-center __pt-20 __m-20-r">
                                    <img class="__rounded-top"
                                         src="{{\App\CPU\ProductManager::product_image_path('thumbnail').'/'.$deal_of_the_day->product['thumbnail']}}"
                                         onerror="this.src='{{asset('public/assets/front-end/img/image-place-holder.png')}}'"
                                         alt="">
                                </div>
                                <div class="__i-1">
                                    <div class="text-left __p-20px">

                                        @php($overallRating = \App\CPU\ProductManager::get_overall_rating($deal_of_the_day->product['reviews']))
                                        <div class="rating-show">
                                            <h5 class="font-semibold" style="color: {{$web_config['primary_color']}}">
                                                {{\Illuminate\Support\Str::limit($deal_of_the_day->product['name'],30)}}
                                            </h5>
                                            <span class="d-inline-block font-size-sm text-body">
                                            @for($inc=0;$inc<5;$inc++)
                                                    @if($inc<$overallRating[0])
                                                        <i class="p-0 sr-star czi-star-filled active"></i>
                                                    @else
                                                        <i class="p-0 sr-star czi-star __color-fea569"></i>
                                                    @endif
                                                @endfor
                                            <label
                                                class="badge-style">( {{$deal_of_the_day->product->reviews_count}} )</label>
                                        </span>
                                        </div>
                                        <div class="">

                                            @if($deal_of_the_day->product->discount > 0)
                                                <strike class="__text-12px __color-E96A6A __pl-2">
                                                    {{\App\CPU\Helpers::currency_converter($deal_of_the_day->product->unit_price)}}
                                                </strike>
                                            @endif
                                            <span class="text-accent __text-22px __m-10px">
                                            {{\App\CPU\Helpers::currency_converter(
                                                $deal_of_the_day->product->unit_price-(\App\CPU\Helpers::get_product_discount($deal_of_the_day->product,$deal_of_the_day->product->unit_price))
                                            )}}
                                        </span>

                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="recomanded-buy-button">
                                <button class="buy_btn" style="color:{{$web_config['primary_color']}}"
                                        onclick="location.href='{{route('product',$deal_of_the_day->product->slug)}}'">{{\App\CPU\translate('buy_now')}}
                                </button>
                            </div>
                        @else
                            @php($product=\App\Model\Product::active()->inRandomOrder()->first())
                            @if(isset($product))
                                <div class="d-flex justify-content-center align-items-center">
                                    <h1 class="text-white"> {{ \App\CPU\translate('recommended_product') }}</h1>
                                </div>
                                <div class="recomanded-product-card">

                                    <div class="d-flex justify-content-center align-items-center  __pt-20 __m-20-r">
                                        <img
                                            src="{{\App\CPU\ProductManager::product_image_path('thumbnail').'/'.$product['thumbnail']}}"
                                            onerror="this.src='{{asset('public/assets/front-end/img/image-place-holder.png')}}'"
                                            alt="">
                                    </div>
                                    <div class="__i-1">
                                        <div class="text-left __p-20px">

                                            @php($overallRating = \App\CPU\ProductManager::get_overall_rating($product['reviews']))
                                            <div class="rating-show">
                                                <h5 class="font-semibold"
                                                    style="color: {{$web_config['primary_color']}}">
                                                    {{\Illuminate\Support\Str::limit($product['name'],40)}}
                                                </h5>
                                                <span class="d-inline-block font-size-sm text-body">
                                                @for($inc=0;$inc<5;$inc++)
                                                        @if($inc<$overallRating[0])
                                                            <i class="p-0 sr-star czi-star-filled active"></i>
                                                        @else
                                                            <i class="p-0 sr-star czi-star __color-fea569"></i>
                                                        @endif
                                                    @endfor
                                                <label class="badge-style">( {{$product->reviews_count}} )</label>
                                            </span>
                                            </div>
                                            <div class="float-right">

                                                @if($product->discount > 0)
                                                    <strike class="__text-12px __color-E96A6A">
                                                        {{\App\CPU\Helpers::currency_converter($product->unit_price)}}
                                                    </strike>
                                                @endif
                                                <span class="text-accent __text-22px __m-10px">
                                                {{\App\CPU\Helpers::currency_converter(
                                                    $product->unit_price-(\App\CPU\Helpers::get_product_discount($product,$product->unit_price))
                                                )}}
                                            </span>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="recomanded-buy-button">
                                    <button class="buy_btn" style="color:{{$web_config['primary_color']}}"
                                            onclick="location.href='{{route('product',$product->slug)}}'">{{\App\CPU\translate('buy_now')}}
                                    </button>
                                </div>

                            @endif
                        @endif
                    </div>

                </div>
                {{-- Latest products --}}
                <div class="col-xl-9 col-md-8 mt-2">
                    <div class="latest-product-margin">
                        <div class="d-flex justify-content-between">
                            <div class="text-center">
                                <span
                                    class="for-feature-title __text-22px font-bold text-center">{{ \App\CPU\translate('latest_products')}}</span>
                            </div>
                            <div class="mr-1">
                                <a class="text-capitalize view-all-text"
                                   href="{{route('products',['data_from'=>'latest'])}}">
                                    {{ \App\CPU\translate('view_all')}}
                                    <i class="czi-arrow-{{Session::get('direction') === 'rtl' ? 'left mr-1 ml-n1 mt-1 float-left' : 'right ml-1 mr-n1'}}"></i>
                                </a>
                            </div>
                        </div>

                        <div class="row mt-0 g-3">
                            @php($latest_products = $latest_products->take(8))
                            @foreach($latest_products as $product)
                                <div class="col-xl-3 col-sm-4 col-md-6 col-lg-4 col-6">
                                    <div>
                                        @include('web-views.partials._single-product',['product'=>$product,'decimal_point_settings'=>$decimal_point_settings])
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if (isset($main_section_banner))
            <div class="container rtl mb-3">
                <div class="row">
                    <div class="col-12 pl-0 pr-0">
                        <a href="{{$main_section_banner->url}}"
                           class="cursor-pointer" style="width: 100%">
                            <img class="d-block footer_banner_img __inline-63" style="min-width: 100%;"
                                 onerror="this.src='{{asset('public/assets/front-end/img/image-place-holder.png')}}'"
                                 src="{{asset('storage/app/public/banner/'.$main_section_banner['photo'])}}">
                        </a>
                    </div>
                </div>
            </div>
        @endif

        @php($business_mode=\App\CPU\Helpers::get_business_settings('business_mode'))
        {{--categries--}}
        <div class="container rtl">
            <div class="row">
                @if ($business_mode == 'multi')
                    <div class="col-md-6">
                        <div class="card __shadow h-100">
                            <div class="card-body">
                                <div class="row d-flex justify-content-between">
                                    <div class="categories-title">
                                        <span class="font-semibold">{{ \App\CPU\translate('categories')}}</span>
                                    </div>
                                    <div class="categories-view-all">
                                        <a class="text-capitalize view-all-text"
                                           href="{{route('categories')}}">{{ \App\CPU\translate('view_all')}}
                                            <i class="czi-arrow-{{Session::get('direction') === 'rtl' ? 'left mr-1 ml-n1 mt-1 float-left' : 'right ml-1 mr-n1'}}"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    @foreach($categories as $key=>$category)

                                        @if ($key<10)
                                            <div class="text-center __m-5px __cate-item">
                                                <a href="{{route('products',['id'=> $category['id'],'data_from'=>'category','page'=>1])}}">
                                                    <div class="__img">
                                                        <img
                                                            onerror="this.src='{{asset('public/assets/front-end/img/image-place-holder.png')}}'"
                                                            src="{{asset('storage/app/public/category/'.$category->icon)}}"
                                                            alt="{{$category->name}}">
                                                    </div>
                                                    <p class="text-center small mt-2">{{Str::limit($category->name, 12)}}</p>
                                                </a>
                                            </div>
                                        @endif

                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="col-md-12">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="row d-flex justify-content-between">
                                    <div
                                        style="{{Session::get('direction') === 'rtl' ? 'margin-right: 20px;' : 'margin-left: 22px;'}}">
                                        <span class="font-semibold">{{ \App\CPU\translate('categories')}}</span>
                                    </div>
                                    <div
                                        style="{{Session::get('direction') === 'rtl' ? 'margin-left: 15px;' : 'margin-right: 13px;'}}">
                                        <a class="text-capitalize view-all-text"
                                           href="{{route('categories')}}">{{ \App\CPU\translate('view_all')}}
                                            <i class="czi-arrow-{{Session::get('direction') === 'rtl' ? 'left mr-1 ml-n1 mt-1 float-left' : 'right ml-1 mr-n1'}}"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    @foreach($categories as $key=>$category)
                                        @if ($key<11)
                                            <div class="text-center __m-5px __cate-item">
                                                <a href="{{route('products',['id'=> $category['id'],'data_from'=>'category','page'=>1])}}">
                                                    <div class="__img">
                                                        <img
                                                            onerror="this.src='{{asset('public/assets/front-end/img/image-place-holder.png')}}'"
                                                            src="{{asset('storage/app/public/category/'.$category->icon)}}"
                                                            alt="{{$category->name}}">
                                                        <p class="text-center small mt-1">{{Str::limit($category->name, 12)}}</p>
                                                    </div>
                                                </a>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                <!-- top sellers -->

                @if ($business_mode == 'multi')
                    @if(count($top_sellers) > 0)
                        <div class="col-md-6 mt-2 mt-md-0 seller-card">
                            <div class="card __shadow h-100">
                                <div class="card-body">
                                    <div class="row d-flex justify-content-between">
                                        <div class="seller-list-title">
                                            <span class="font-semibold">{{ \App\CPU\translate('sellers')}}</span>
                                        </div>
                                        <div class="seller-list-view-all">
                                            <a class="text-capitalize view-all-text"
                                               href="{{route('sellers')}}">{{ \App\CPU\translate('view_all')}}
                                                <i class="czi-arrow-{{Session::get('direction') === 'rtl' ? 'left mr-1 ml-n1 mt-1 float-left' : 'right ml-1 mr-n1'}}"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        @foreach($top_sellers as $key=>$seller)
                                            @if ($key<10)

                                                @if($seller->shop)
                                                    <div class="__m-5px __cate-item">
                                                        <a href="{{route('shopView',['id'=>$seller['id']])}}">
                                                            <div class="__img circle position-relative">
                                                                @php($shop=$seller->shop)
                                                                @php($current_date = date('Y-m-d'))
                                                                @php($start_date = date('Y-m-d', strtotime($shop['vacation_start_date'])))
                                                                @php($end_date = date('Y-m-d', strtotime($shop['vacation_end_date'])))
                                                                @if($shop->vacation_status && ($current_date >= $start_date) && ($current_date <= $end_date))
                                                                    <span class="temporary-closed">
                                                                        <small>{{\App\CPU\translate('closed_now')}}</small>
                                                                    </span>
                                                                @elseif($shop->temporary_close)
                                                                    <span class="temporary-closed">
                                                                        <small>{{\App\CPU\translate('closed_now')}}</small>
                                                                    </span>
                                                                @endif
                                                                <img
                                                                    onerror="this.src='{{asset('public/assets/front-end/img/image-place-holder.png')}}'"
                                                                    src="{{asset('storage/app/public/shop/'.$seller->shop->image)}}">
                                                            </div>
                                                            <p class="text-center small mt-2">{{Str::limit($seller->shop->name, 14)}}</p>
                                                        </a>
                                                    </div>
                                                @endif
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endif
            </div>
        </div>


        <div class="container rtl mt-4">
            <div class="arrival-title">
                <div>
                    <img src="{{asset('public/assets/front-end/png/new-arrivals.png')}}" alt="">

                </div>
                <div class="pl-2">
                    {{ \App\CPU\translate('ARRIVALS')}}
                </div>
            </div>
        </div>
        <div class="container rtl mb-3 overflow-hidden">
            <div class="py-2">
                <div class="new_arrival_product">
                    <div class="carousel-wrap">
                        <div class="owl-carousel owl-theme" id="new-arrivals-product">
                            @foreach($latest_products as $key=>$product)

                                @include('web-views.partials._product-card-1',['product'=>$product,'decimal_point_settings'=>$decimal_point_settings])

                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container rtl">
            <div class="row g-3">
                <div class="col-md-6">
                    <div class="card card __shadow h-100">
                        <div class="card-body p-xl-35">
                            <div class="row d-flex justify-content-between mx-1 mb-3">
                                <div>
                                    <img class="size-30"
                                         src="{{asset('public/assets/front-end/png/best sellings.png')}}"
                                         alt="">
                                    <span class="font-bold pl-1">{{ \App\CPU\translate('best sellings')}}</span>
                                </div>
                                <div>
                                    <a class="text-capitalize view-all-text"
                                       href="{{route('products',['data_from'=>'best-selling','page'=>1])}}">{{ \App\CPU\translate('view_all')}}
                                        <i class="czi-arrow-{{Session::get('direction') === 'rtl' ? 'left mr-1 ml-n1 mt-1 float-left' : 'right ml-1 mr-n1'}}"></i>
                                    </a>
                                </div>
                            </div>
                            <div>
                                @foreach($bestSellProduct as $key=>$bestSell)
                                    @if($bestSell->product && $key<3)
                                        <a class="__best-selling" href="{{route('product',$bestSell->product->slug)}}">
                                            @if($bestSell->product->discount > 0)
                                                <div class="d-flex"
                                                     style="top:0;position:absolute;{{Session::get('direction') === 'rtl' ? 'right:0;' : 'left:0;'}}">
                                                    <span class="for-discoutn-value p-1 pl-2 pr-2"
                                                          style="{{Session::get('direction') === 'rtl' ? 'border-radius:0px 5px' : 'border-radius:5px 0px'}};">
                                                        @if ($bestSell->product->discount_type == 'percent')
                                                            {{round($bestSell->product->discount)}}%
                                                        @elseif($bestSell->product->discount_type =='flat')
                                                            {{\App\CPU\Helpers::currency_converter($bestSell->product->discount)}}
                                                        @endif {{\App\CPU\translate('off')}}
                                                    </span>
                                                </div>
                                            @endif
                                            <div class="d-flex flex-wrap p-2">
                                                <div class="best-selleing-image">
                                                    <img class="rounded"
                                                         onerror="this.src='{{asset('public/assets/front-end/img/image-place-holder.png')}}'"
                                                         src="{{\App\CPU\ProductManager::product_image_path('thumbnail').'/'.$bestSell->product['thumbnail']}}"
                                                         alt="Product"/>
                                                </div>
                                                <div class="best-selling-details">
                                                    <h6 class="widget-product-title">
                                                    <span class="ptr">
                                                        {{\Illuminate\Support\Str::limit($bestSell->product['name'],100)}}
                                                    </span>
                                                    </h6>
                                                    @php($bestSell_overallRating = \App\CPU\ProductManager::get_overall_rating($bestSell->product['reviews']))
                                                    <div class="rating-show">
                                                    <span class="d-inline-block font-size-sm text-body">
                                                        @for($inc=0;$inc<5;$inc++)
                                                            @if($inc<$bestSell_overallRating[0])
                                                                <i class="p-0 sr-star czi-star-filled active"></i>
                                                            @else
                                                                <i class="p-0 sr-star czi-star __color-fea569"></i>
                                                            @endif
                                                        @endfor
                                                        <label class="badge-style">( {{$bestSell->product->reviews_count}} )</label>
                                                    </span>
                                                    </div>
                                                    <div>
                                                        @if($bestSell->product->discount > 0)
                                                            <strike class="__color-E96A6A __text-12px">
                                                                {{\App\CPU\Helpers::currency_converter($bestSell->product->unit_price)}}
                                                            </strike>
                                                        @endif
                                                    </div>
                                                    <div class="widget-product-meta">
                                                    <span class="text-accent">
                                                        {{\App\CPU\Helpers::currency_converter(
                                                        $bestSell->product->unit_price-(\App\CPU\Helpers::get_product_discount($bestSell->product,$bestSell->product->unit_price))
                                                        )}}
                                                    </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mt-2 mt-md-0">
                    <div class="card card __shadow h-100">
                        <div class="card-body p-xl-35">
                            <div class="row d-flex justify-content-between mx-1 mb-3">
                                <div>
                                    <img class="size-30" src="{{asset('public/assets/front-end/png/top-rated.png')}}"
                                         alt="">
                                    <span class="font-bold pl-1">{{ \App\CPU\translate('top rated')}}</span>
                                </div>
                                <div>
                                    <a class="text-capitalize view-all-text"
                                       href="{{route('products',['data_from'=>'top-rated','page'=>1])}}">{{ \App\CPU\translate('view_all')}}
                                        <i class="czi-arrow-{{Session::get('direction') === 'rtl' ? 'left mr-1 ml-n1 mt-1 float-left' : 'right ml-1 mr-n1'}}"></i>
                                    </a>
                                </div>
                            </div>
                            <div>
                                @foreach($topRated as $key=>$top)
                                    @if($top->product && $key<3)
                                        <a class="__best-selling" href="{{route('product',$top->product->slug)}}">
                                            @if($top->product->discount > 0)
                                                <div class="d-flex"
                                                     style="top:0;position:absolute;{{Session::get('direction') === 'rtl' ? 'right:0;' : 'left:0;'}}">
                                                    <span class="for-discoutn-value p-1 pl-2 pr-2"
                                                          style="{{Session::get('direction') === 'rtl' ? 'border-radius:0px 5px' : 'border-radius:5px 0px'}};">
                                                        @if ($top->product->discount_type == 'percent')
                                                            {{round($top->product->discount)}}%
                                                        @elseif($top->product->discount_type =='flat')
                                                            {{\App\CPU\Helpers::currency_converter($top->product->discount)}}
                                                        @endif {{\App\CPU\translate('off')}}
                                                    </span>
                                                </div>
                                            @endif
                                            <div class="d-flex flex-wrap p-2">
                                                <div class="top-rated-image">
                                                    <img class="rounded"
                                                         onerror="this.src='{{asset('public/assets/front-end/img/image-place-holder.png')}}'"
                                                         src="{{\App\CPU\ProductManager::product_image_path('thumbnail').'/'.$top->product['thumbnail']}}"
                                                         alt="Product"/>
                                                </div>
                                                <div class="top-rated-details">
                                                    <h6 class="widget-product-title">
                                                    <span class="ptr">
                                                        {{\Illuminate\Support\Str::limit($top->product['name'],100)}}
                                                    </span>
                                                    </h6>
                                                    @php($top_overallRating = \App\CPU\ProductManager::get_overall_rating($top->product['reviews']))
                                                    <div class="rating-show">
                                                    <span class="d-inline-block font-size-sm text-body">
                                                        @for($inc=0;$inc<5;$inc++)
                                                            @if($inc<$top_overallRating[0])
                                                                <i class="p-0 sr-star czi-star-filled active"></i>
                                                            @else
                                                                <i class="p-0 sr-star czi-star __color-fea569"></i>
                                                            @endif
                                                        @endfor
                                                        <label
                                                            class="badge-style">( {{$top->product->reviews_count}} )</label>
                                                    </span>
                                                    </div>
                                                    <div>
                                                        @if($top->product->discount > 0)
                                                            <strike class="__text-12px __color-E96A6A">
                                                                {{\App\CPU\Helpers::currency_converter($top->product->unit_price)}}
                                                            </strike>
                                                        @endif
                                                    </div>
                                                    <div class="widget-product-meta">
                                                    <span class="text-accent">
                                                        {{\App\CPU\Helpers::currency_converter(
                                                        $top->product->unit_price-(\App\CPU\Helpers::get_product_discount($top->product,$top->product->unit_price))
                                                        )}}
                                                    </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    @endif
                                @endforeach
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- I will develop here -->
        {{-- Banner  --}}
        <div class="container rtl py-4 ">
            <div class="row g-3">
                @foreach(\App\Model\Banner::where('banner_type','Footer Banner')->where('published',1)->orderBy('id','desc')->take(2)->get() as $banner)
                    <div class="col-md-6">
                        <a href="{{$banner->url}}" class="d-block">
                            <img class="footer_banner_img"
                                 onerror="this.src='{{asset('public/assets/front-end/img/image-place-holder.png')}}'"
                                 src="{{asset('storage/app/public/banner').'/'.$banner['photo']}}">
                        </a>
                    </div>
                @endforeach
            </div>
        </div>

        <style>
            .arrival-products {
                margin-bottom: 10px;
            }
            .arrival-products .grid-container {
                display: grid;
                grid-template-columns: repeat(2, minmax(0, 1fr));
                grid-template-rows: auto repeat(2, 1fr);
                text-align: center;
                grid-gap: 20px;
            }
            .arrival-products .item {
                width: 100%;
                height: 100%;
                display: block;
                position: relative;
            }
            .arrival-products img {
                min-width: 100%;
                min-height: 100%;
                width: 500px;
                height: 250px;
                object-fit: fill;
                left: 0;
                top: 0;
                padding: 0;
            }
            .arrival-products .item1 {
                grid-column: 1/2;
                grid-row: 1/3;
            }
            .arrival-products .item2 {
                grid-column: 2/3;
                grid-row: 1/2;
            }
            .arrival-products .item3 {
                grid-column: 1/2;
                grid-row: 3/4;
            }
            .arrival-products .item4 {
                grid-column: 2/3;
                grid-row: 2/4;
            }
            .arrival-products a {
                height: 100%;
                color: rgb(72, 72, 72);
            }
            .ratio-box-image__aspect-constraint {
                position: absolute;
                top: 0;
                pointer-events: none;
                background: none;
            }
            .ratio-box-image__aspect-constraint>* {
                pointer-events: initial;
            }
            .ratio-box {
                width: 100%;
                position: relative;
                height: 100%;
                display: block;
                padding-bottom: 75%;

            }
            .ratio-box[class*="--square"] {
                padding-bottom: 50%;
            }
            .ratio-box[class*="--portrait"] {
                padding-bottom: 100%;
            }
            .arrival-image__product-list {
                list-style-type: none;
            }
            .arrival-image__area {
                position: absolute;
            }
            .arrival-products a:hover {
                color: rgba(17, 17, 17);
                text-decoration: underline;
            }
            .arrival-image__dot {
                transition: border-color 250ms ease-in-out, opacity 250ms ease-in-out, visibility 250ms ease-in-out;
                transform: translateX(-1rem) translateY(-1rem) scale(0.999);
                padding: 0;
                width: 2rem;
                height: 2rem!important;
                border: 2px solid transparent;
                position: absolute;
                background: rgba(17, 17, 17, 0.2);
                opacity: 0;
                visibility: hidden;
                border-radius: 64px;
                line-height: .5;
                display: flex;
                align-items: center;
                justify-content: center;
            }
            .arrival-image__dot::before {
                content: "";
                position: absolute;
                top: -0.5rem;
                left: -0.5rem;
                right: -0.5rem;
                bottom: -0.5rem;
                display: block;
            }
            .arrival-image__dot::after {
                content: "";
                transition: transform 250ms ease-in-out;
                position: relative;
                display: block;
                background: rgb(255, 255, 255);
                box-shadow: 0 1px 4px rgba(17, 17, 17, 0.55);
                width: 0.75rem;
                height: 0.75rem;
                border-radius: 64px;
            }
            .arrival-image__dot:hover {
                border-color: rgba(255, 255, 255, 0.5);
                background: rgba(17, 17, 17, 0.4);
            }
            .arrival-image__tag {
                z-index: 1;
                transition: opacity 250ms ease-in-out, visibility 250ms ease-in-out;
                transform: translateX(-50%) translateY(-100%) translateY(-1.5rem);
                min-width: 7.5rem;
                position: absolute;
                opacity: 0;
                visibility: hidden;
            }
            @media screen and (min-width: 37.5em) {
                .arrival-image__tag {
                    min-width: 8.4375rem;
                }
            }
            .arrival-image__tag--top {
                transform: translateX(-100%) translateX(-0.5rem) translateY(-100%) translateY(-1.8rem);
            }
            .arrival-image__tag--right {
                transform: translateX(50%) translateX(-2.5rem) translateY(-1rem);
            }
            .arrival-image__tag--bottom {
                transform: translateX(50%) translateX(-2.5rem) translateY(0.5rem);
            }
            .arrival-image__tag--left {
                transform: translateX(-100%) translateX(-1.5rem) translateY(-100%) translateY(1rem);
            }
            .arrival-image__tag-inner {
                transition: transform 250ms ease-in-out;
                width: 100%;
                text-align: initial;
                display: flex;
                flex-direction: column;
                text-decoration: none;
                color: rgba(17, 17, 17);
                background-color: rgb(255, 255, 255);
                box-shadow: 0 1px 4px rgba(17, 17, 17, 0.55);
                border-radius: 10px;
            }
            .ratio-item1-box:hover .arrival-image__dot{
                visibility: visible;
            }
            .arrival-image-price-package {
                display: inline-block;
                background-color: rgb(255, 255, 255);
                min-width: 8.4375rem;
                max-width: 12.625rem;
                border-radius: 10px;
            }
            .arrival-image-price-package a {
                text-decoration: none !important;
            }
            .arrival-image-price-package__link,
            .arrival-image-price-package__link:hover {
                display: flex;
                justify-content: space-between;
                width: 100%;
            }
            .arrival-image-price-module__information {
                margin-bottom: 0.5rem;
                padding: 0.5rem 1.25rem;
            }
            .arrival-image-commercial-message {
                font-size: 0.8rem;
                font-weight: 600;
                line-height: 1.2;
            }
            .arrival-image-commercial-message__title {
                color: rgb(202, 80, 8);
            }
            .arrival-image-price-module-name {
                text-transform: uppercase;
                color: rgb(17, 17, 17);
            }
            .arrival-image-section__title {
                font-size: 0.75rem;
                font-weight: 700;
            }
            .arrival-image-section__description {
                font-size: 0.7rem;
            }
            .arrival-image-price-module__price {
                color: rgb(17, 17, 17);
            }
            .arrival-image__tag:hover {
                visibility: visible!important;
                opacity: 1!important;
                text-decoration: none!important;
            }
            .arrival-image-package__chevron {
                display: flex;
                align-items: center;
                justify-content: center;
                border-left: 1px solid rgb(233, 233, 233);
            }
            .arrival-image-price-moudle__price-temp-mark {
                font-size: 0.6rem;
            }
            .arrival-image-price-moudle__price-temp-value {
                font-size: 0.8rem;
            }
        </style>

        <script>
            // In Item1
            function dotItem1Display() {
                const dot_item1_image = document.querySelector(".arrival-image__dot-item1");
                dot_item1_image.style.visibility = "visible";
                dot_item1_image.style.opacity = 1;
            }
            function dotItem1Hidden() {
                const dot_item1_image = document.querySelector(".arrival-image__dot-item1");
                dot_item1_image.style.visibility = "hidden";
                dot_item1_image.style.opacity = 0;
            }
            function detailItem1Disply() {
                const dot_item1_image = document.querySelector(".arrival-image__dot-item1");
                const detail_item1_image = document.querySelector(".arrival-image__tag-item1");
                dot_item1_image.style.visibility = "visible";
                dot_item1_image.style.opacity = 1;
                detail_item1_image.style.visibility = "visible";
                detail_item1_image.style.opacity = 1;
            }
            function detailItem1Hidden() {
                const dot_item1_image = document.querySelector(".arrival-image__dot-item1");
                const detail_item1_image = document.querySelector(".arrival-image__tag-item1");
                dot_item1_image.style.visibility = "visible";
                dot_item1_image.style.opacity = 1;
                detail_item1_image.style.visibility = "hidden";
                detail_item1_image.style.opacity = 0;
            }
            // In Item2
            function dotItem2Display() {
                const dot_item2_image = document.querySelector(".arrival-image__dot-item2");
                dot_item2_image.style.visibility = "visible";
                dot_item2_image.style.opacity = 1;
            }
            function dotItem2Hidden() {
                const dot_item2_image = document.querySelector(".arrival-image__dot-item2");
                dot_item2_image.style.visibility = "hidden";
                dot_item2_image.style.opacity = 0;
            }
            function detailItem2Disply() {
                const dot_item2_image = document.querySelector(".arrival-image__dot-item2");
                dot_item2_image.style.visibility = "visible";
                dot_item2_image.style.opacity = 1;
                const detail_item2_image = document.querySelector(".arrival-image__tag-item2");
                detail_item2_image.style.visibility = "visible";
                detail_item2_image.style.opacity = 1;
            }
            function detailItem2Hidden() {
                const dot_item2_image = document.querySelector(".arrival-image__dot-item2");
                dot_item2_image.style.visibility = "visible";
                dot_item2_image.style.opacity = 1;
                const detail_item2_image = document.querySelector(".arrival-image__tag-item2");
                detail_item2_image.style.visibility = "hidden";
                detail_item2_image.style.opacity = 0;
            }
            // In Item3
            function dotItem3Display() {
                const dot_item3_image = document.querySelector(".arrival-image__dot-item3");
                dot_item3_image.style.visibility = "visible";
                dot_item3_image.style.opacity = 1;
            }
            function dotItem3Hidden() {
                const dot_item3_image = document.querySelector(".arrival-image__dot-item3");
                dot_item3_image.style.visibility = "hidden";
                dot_item3_image.style.opacity = 0;
            }
            function detailItem3Disply() {
                const dot_item3_image = document.querySelector(".arrival-image__dot-item3");
                dot_item3_image.style.visibility = "visible";
                dot_item3_image.style.opacity = 1;
                const detail_item3_image = document.querySelector(".arrival-image__tag-item3");
                detail_item3_image.style.visibility = "visible";
                detail_item3_image.style.opacity = 1;
            }
            function detailItem3Hidden() {
                const dot_item3_image = document.querySelector(".arrival-image__dot-item3");
                dot_item3_image.style.visibility = "visible";
                dot_item3_image.style.opacity = 1;
                const detail_item3_image = document.querySelector(".arrival-image__tag-item3");
                detail_item3_image.style.visibility = "hidden";
                detail_item3_image.style.opacity = 0;
            }
            // In Item4
            function dotItem4Display() {
                const dot_item4_image = document.querySelector(".arrival-image__dot-item4");
                dot_item4_image.style.visibility = "visible";
                dot_item4_image.style.opacity = 1;
            }
            function dotItem4Hidden() {
                const dot_item4_image = document.querySelector(".arrival-image__dot-item4");
                dot_item4_image.style.visibility = "hidden";
                dot_item4_image.style.opacity = 0;
            }
            function detailItem4Disply() {
                const dot_item4_image = document.querySelector(".arrival-image__dot-item4");
                dot_item4_image.style.visibility = "visible";
                dot_item4_image.style.opacity = 1;
                const detail_item4_image = document.querySelector(".arrival-image__tag-item4");
                detail_item4_image.style.visibility = "visible";
                detail_item4_image.style.opacity = 1;
            }
            function detailItem4Hidden() {
                const dot_item4_image = document.querySelector(".arrival-image__dot-item4");
                dot_item4_image.style.visibility = "visible";
                dot_item4_image.style.opacity = 1;
                const detail_item1_image = document.querySelector(".arrival-image__tag-item4");
                detail_item1_image.style.visibility = "hidden";
                detail_item1_image.style.opacity = 0;
            }
        </script>

        <div class="arrival-products">
            <div class="container">
                <div class="grid-container">
                    <div class="item item1 ratio-box-android">
                        <a href="#" style="width: 100%;">
                            <img src="/storage/app/public/banner/Table.png" alt="" onmouseover="dotItem1Display()" onmouseout="dotItem1Hidden()">
                        </a>
                        <div class="ratio-box ratio-box--portrait ratio-item1-box ratio-box-image__aspect-constraint" style="position: absolute; top:0; left:0;">
                            <ul class="arrival-image__product-list">
                                <li class="arrival-image__area" aria-hidden="false" style="top: 60%; left:55%;">
                                    <a href="/product/coffee-table-htUdeF" class="arrival-image__dot arrival-image__dot-item1 arrival-image__dot-item1-coffeetable" aria-labelledby="arrival-image-art,80533570" onmouseenter="detailItem1Disply()" onmouseleave="detailItem1Hidden()"></a>
                                    <div class="arrival-image__tag arrival-image__tag--top arrival-image__tag-item1 arrival-image__tag-item1-coffeetable" aria-hidden="true" role="tooltip" id="arrival-image-art,80533570">
                                        <div class="arrival-image__tag-inner">
                                            <div class="arrival-image-price-package">
                                                <a href="/product/coffee-table-htUdeF" class="arrival-image-price-package__link">
                                                    <div class="arrival-image-price-module__information">
                                                        <div class="arrival-image-commercial-message">
                                                            <span class="arrival-image-commercial-message__title">New</span>
                                                        </div>
                                                        <div class="arrival-image-price-module-name">
                                                            <span class="arrival-image-section__title">Table</span><br>
                                                            <span class="arrival-image-section__description">Coffee Table</span>
                                                        </div>
                                                        <div class="arrival-image-price-module__price">
                                                            <span class="arrival-image-price-moudle__price-temp-mark"> $ </span>
                                                            <span class="arrival-image-price-moudle__price-temp-value"> 153.60</span>
                                                        </div>
                                                    </div>
                                                    <!-- <div class="arrival-image-package__chevron">
                                                        <svg focusable="false" viewBox="0 0 24 24" width="24" height="24" class="pip-svg-icon" aria-hidden="true"><path fill-rule="evenodd" clip-rule="evenodd" d="m16.415 12.0011-8.0012 8.0007-1.4141-1.4143 6.587-6.5866-6.586-6.5868L8.415 4l8 8.0011z"></path></svg>
                                                    </div> -->
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="item item2">
                        <a href="#" style="width:100%;">
                            <img src="/storage/app/public/banner/Interior.png" alt="" onmouseover="dotItem2Display()" onmouseout="dotItem2Hidden()">
                        </a>
                        <div class="ratio-box ratio-box--square ratio-item2-box ratio-box-image__aspect-constraint" style="position: absolute; top:0; left:0;">
                            <ul class="arrival-image__product-list">
                                <li class="arrival-image__area" aria-hidden="false" style="top: 50%; left:60%;">
                                    <a href="/product/full-bed-BcXbdS" class="arrival-image__dot arrival-image__dot-item2" aria-labelledby="arrival-image__art, 2055109" onmouseenter="detailItem2Disply()" onmouseleave="detailItem2Hidden()"></a>
                                    <div class="arrival-image__tag arrival-image__tag--left arrival-image__tag-item2" aria-hidden="true" role="tooltip" id="arrival-image__art, 2055109">
                                        <div class="arrival-image__tag-inner">
                                            <div class="arrival-image-price-package">
                                                <a href="/product/full-bed-BcXbdS" class="arrival-image-price-package__link">
                                                    <div class="arrival-image-price-module__information">
                                                        <div class="arrival-image-commercial-message">
                                                            <span class="arrival-image-commercial-message__title">New</span>
                                                        </div>
                                                        <div class="arrival-image-price-module-name">
                                                            <span class="arrival-image-section__title">Bed</span><br>
                                                            <span class="arrival-image-section__description">Full Bed</span>
                                                        </div>
                                                        <div class="arrival-image-price-module__price">
                                                            <span class="arrival-image-price-moudle__price-temp-mark"> $ </span>
                                                            <span class="arrival-image-price-moudle__price-temp-value"> 2400</span>
                                                        </div>
                                                    </div>
                                                    <!-- <div class="arrival-image-package__chevron">
                                                        <svg focusable="false" viewBox="0 0 24 24" width="24" height="24" class="pip-svg-icon" aria-hidden="true"><path fill-rule="evenodd" clip-rule="evenodd" d="m16.415 12.0011-8.0012 8.0007-1.4141-1.4143 6.587-6.5866-6.586-6.5868L8.415 4l8 8.0011z"></path></svg>
                                                    </div> -->
                                                </a>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="item item3">
                        <a href="#" style="width:100%;">
                            <img src="/storage/app/public/banner/Woodentrunck.png" alt="" onmouseover="dotItem3Display()" onmouseout="dotItem3Hidden()">
                        </a>
                        <div class="ratio-box ratio-box--square ratio-item3-box ratio-box-image__aspect-constraint" style="position: absolute; top:0; left:0;">
                            <ul class="arrival-image__product-list">
                                <li class="arrival-image__area" aria-hidden="false" style="top: 40%; left:40%;">
                                    <a href="/product/wooden-trunk-MePjqt" class="arrival-image__dot arrival-image__dot-item3" aria-labelledby="arrival-image-spr,99449642" onmouseenter="detailItem3Disply()" onmouseleave="detailItem3Hidden()"></a>
                                    <div class="arrival-image__tag arrival-image__tag--right arrival-image__tag-item3" aria-hidden="true" role="tooltip" id="arrival-image-spr,99449642">
                                        <div class="arrival-image__tag-inner">
                                            <div class="arrival-image-price-package">
                                                <a href="/product/wooden-trunk-MePjqt" class="arrival-image-price-package__link">
                                                    <div class="arrival-image-price-module__information">
                                                        <div class="arrival-image-commercial-message">
                                                            <span class="arrival-image-commercial-message__title">New</span>
                                                        </div>
                                                        <div class="arrival-image-price-module-name">
                                                            <span class="arrival-image-section__title">Nightstand</span><br>
                                                            <span class="arrival-image-section__description">Wooden Trunk</span>
                                                        </div>
                                                        <div class="arrival-image-price-module__price">
                                                            <span class="arrival-image-price-moudle__price-temp-mark"> $ </span>
                                                            <span class="arrival-image-price-moudle__price-temp-value"> 616.55</span>
                                                        </div>
                                                    </div>
                                                    <!-- <div class="arrival-image-package__chevron">
                                                        <svg focusable="false" viewBox="0 0 24 24" width="24" height="24" class="pip-svg-icon" aria-hidden="true"><path fill-rule="evenodd" clip-rule="evenodd" d="m16.415 12.0011-8.0012 8.0007-1.4141-1.4143 6.587-6.5866-6.586-6.5868L8.415 4l8 8.0011z"></path></svg>
                                                    </div> -->
                                                </a>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="item item4">
                        <a href="#" style="width:100%;">
                            <img src="/storage/app/public/banner/Whitedoor.png" alt="" onmouseover="dotItem4Display()" onmouseout="dotItem4Hidden()">
                        </a>
                        <div class="ratio-box ratio-box--portrait ratio-item4-box ratio-box-image__aspect-constraint" style="position: absolute; top:0; left:0;">
                            <ul class="arrival-image__product-list">
                                <li class="arrival-image__area" aria-hidden="false" style="top: 45%; left:45%;">
                                    <a href="/product/arvika-white-door-d460DW" class="arrival-image__dot arrival-image__dot-item4" aria-labelledby="arrival-image-art,30554188" onmouseenter="detailItem4Disply()" onmouseleave="detailItem4Hidden()"></a>
                                    <div class="arrival-image__tag arrival-image__tag--bottom arrival-image__tag-item4" aria-hidden="true" role="tooltip" id="arrival-image-art,30554188">
                                        <div class="arrival-image__tag-inner">
                                            <div class="arrival-image-price-package">
                                                <a href="/product/arvika-white-door-d460DW" class="arrival-image-price-package__link">
                                                    <div class="arrival-image-price-module__information">
                                                        <div class="arrival-image-commercial-message">
                                                            <span class="arrival-image-commercial-message__title">New</span>
                                                        </div>
                                                        <div class="arrival-image-price-module-name">
                                                            <span class="arrival-image-section__title">Door</span><br>
                                                            <span class="arrival-image-section__description">Arvike-Door</span>
                                                        </div>
                                                        <div class="arrival-image-price-module__price">
                                                            <span class="arrival-image-price-moudle__price-temp-mark"> $ </span>
                                                            <span class="arrival-image-price-moudle__price-temp-value"> 314.00</span>
                                                        </div>
                                                    </div>
                                                    <!-- <div class="arrival-image-package__chevron">
                                                        <svg focusable="false" viewBox="0 0 24 24" width="24" height="24" class="pip-svg-icon" aria-hidden="true"><path fill-rule="evenodd" clip-rule="evenodd" d="m16.415 12.0011-8.0012 8.0007-1.4141-1.4143 6.587-6.5866-6.586-6.5868L8.415 4l8 8.0011z"></path></svg>
                                                    </div> -->
                                                </a>
                                            </div>

                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Categorized product --}}
        @foreach($home_categories as $category)
            <section class="container rtl pb-4">
                <!-- Heading-->
                <div class="__p-20px rounded bg-white">
                    <div class="flex-wrap __gap-6px flex-between pl-xl-4">
                        <div class="category-product-view-title">
                        <span
                            class="for-feature-title {{Session::get('direction') === 'rtl' ? 'float-right' : 'float-left'}} font-bold __text-20px text-uppercase"
                            style="{{Session::get('direction') === 'rtl' ? 'text-align:right;' : 'text-align:left;'}}">
                                {{Str::limit($category['name'],18)}}
                        </span>
                        </div>
                        <div class="category-product-view-all">
                            <a class="text-capitalize view-all-text "
                               href="{{route('products',['id'=> $category['id'],'data_from'=>'category','page'=>1])}}">{{ \App\CPU\translate('view_all')}}
                                <i class="czi-arrow-{{Session::get('direction') === 'rtl' ? 'left mr-1 ml-n1 mt-1 float-left' : 'right ml-1 mr-n1'}}"></i>
                            </a>

                        </div>
                    </div>

                    <div class="row mt-2 justify-content-between g-3">
                        <div class="col-md-3 col-12">
                            <a href="{{route('products',['id'=> $category['id'],'data_from'=>'category','page'=>1])}}"
                               class="cursor-pointer d-block h-100 __cate-product-side-img">
                                <img class="h-100"
                                     onerror='this.src="{{asset("public/assets/front-end/img/image-place-holder.png")}}"'
                                     src="{{asset('storage/app/public/category').'/'.$category['icon']}}">
                            </a>
                        </div>
                        <div class="col-md-9 col-12 ">
                            <div class="row g-2">
                                @foreach($category['products'] as $key=>$product)
                                    @if ($key<4)
                                        <div class="col-md-3 col-sm-4 col-6">
                                            @include('web-views.partials._category-single-product',['product'=>$product,'decimal_point_settings'=>$decimal_point_settings])
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>


                    </div>
                </div>
            </section>
        @endforeach

        {{--delivery type --}}

        <div class="container rtl pb-4 pt-3">
            <div class="shipping-policy-web">
                <div class="row g-3">
                    <div class="col-md-3 d-flex justify-content-center">
                        <div class="shipping-method-system">
                            <div class="text-center">
                                <img class="size-60" src="{{asset('public/assets/front-end/png/delivery.png')}}"
                                     alt="">
                            </div>
                            <div class="text-center">
                                <p class="m-0">
                                    {{ \App\CPU\translate('Fast Delivery all accross the country')}}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 d-flex justify-content-center">
                        <div class="shipping-method-system">
                            <div class="text-center">
                                <img class="size-60" src="{{asset('public/assets/front-end/png/Payment.png')}}"
                                     alt="">
                            </div>
                            <div class="text-center">
                                <p class="m-0">
                                    {{ \App\CPU\translate('Safe Payment')}}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 d-flex justify-content-center">
                        <div class="shipping-method-system">
                            <div class="text-center">
                                <img class="size-60" src="{{asset('public/assets/front-end/png/money.png')}}"
                                     alt="">
                            </div>
                            <div class="text-center">
                                <p class="m-0">
                                    {{ \App\CPU\translate('7 Days Return Policy')}}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 d-flex justify-content-center">
                        <div class="shipping-method-system">
                            <div class="text-center">
                                <img class="size-60" src="{{asset('public/assets/front-end/png/Genuine.png')}}"
                                     alt="">
                            </div>
                            <div class="text-center">
                                <p class="m-0">
                                    {{ \App\CPU\translate('100% Authentic Products')}}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    {{-- Owl Carousel --}}
    <script src="{{asset('public/assets/front-end')}}/js/owl.carousel.min.js"></script>

    <script>
        $('#flash-deal-slider').owlCarousel({
            loop: false,
            autoplay: false,
            margin: 20,
            nav: true,
            navText: ["<i class='czi-arrow-left'></i>", "<i class='czi-arrow-right'></i>"],
            dots: false,
            autoplayHoverPause: true,
            '{{session("direction")}}': false,
            // center: true,
            responsive: {
                //X-Small
                0: {
                    items: 1
                },
                360: {
                    items: 1
                },
                375: {
                    items: 1
                },
                540: {
                    items: 2
                },
                //Small
                576: {
                    items: 2
                },
                //Medium
                768: {
                    items: 2
                },
                //Large
                992: {
                    items: 2
                },
                //Extra large
                1200: {
                    items: 2
                },
                //Extra extra large
                1400: {
                    items: 3
                }
            }
        })

        $('#web-feature-deal-slider').owlCarousel({
            loop: false,
            autoplay: true,
            margin: 20,
            nav: false,
            //navText: ["<i class='czi-arrow-left'></i>", "<i class='czi-arrow-right'></i>"],
            dots: false,
            autoplayHoverPause: true,
            '{{session("direction")}}': true,
            // center: true,
            responsive: {
                //X-Small
                0: {
                    items: 1
                },
                360: {
                    items: 1
                },
                375: {
                    items: 1
                },
                540: {
                    items: 2
                },
                //Small
                576: {
                    items: 2
                },
                //Medium
                768: {
                    items: 2
                },
                //Large
                992: {
                    items: 2
                },
                //Extra large
                1200: {
                    items: 2
                },
                //Extra extra large
                1400: {
                    items: 2
                }
            }
        })

        $('#new-arrivals-product').owlCarousel({
            loop: true,
            autoplay: false,
            margin: 20,
            nav: true,
            navText: ["<i class='czi-arrow-{{Session::get('direction') === 'rtl' ? 'right' : 'left'}}'></i>", "<i class='czi-arrow-{{Session::get('direction') === 'rtl' ? 'left' : 'right'}}'></i>"],
            dots: false,
            autoplayHoverPause: true,
            '{{session("direction")}}': true,
            // center: true,
            responsive: {
                //X-Small
                0: {
                    items: 1
                },
                360: {
                    items: 1
                },
                375: {
                    items: 1
                },
                540: {
                    items: 2
                },
                //Small
                576: {
                    items: 2
                },
                //Medium
                768: {
                    items: 2
                },
                //Large
                992: {
                    items: 2
                },
                //Extra large
                1200: {
                    items: 4
                },
                //Extra extra large
                1400: {
                    items: 4
                }
            }
        })
    </script>
    <script>
        $('#featured_products_list').owlCarousel({
            loop: true,
            autoplay: false,
            margin: 20,
            nav: true,
            navText: ["<i class='czi-arrow-left'></i>", "<i class='czi-arrow-right'></i>"],
            dots: false,
            autoplayHoverPause: true,
            '{{session("direction")}}': false,
            // center: true,
            responsive: {
                //X-Small
                0: {
                    items: 1
                },
                360: {
                    items: 1
                },
                375: {
                    items: 1
                },
                540: {
                    items: 2
                },
                //Small
                576: {
                    items: 2
                },
                //Medium
                768: {
                    items: 3
                },
                //Large
                992: {
                    items: 4
                },
                //Extra large
                1200: {
                    items: 5
                },
                //Extra extra large
                1400: {
                    items: 5
                }
            }
        });
    </script>
    <script>
        $('#brands-slider').owlCarousel({
            loop: false,
            autoplay: false,
            margin: 10,
            nav: false,
            '{{session("direction")}}': true,
            dots: true,
            autoplayHoverPause: true,
            // center: true,
            responsive: {
                //X-Small
                0: {
                    items: 4
                },
                360: {
                    items: 5
                },
                375: {
                    items: 5
                },
                540: {
                    items: 5
                },
                //Small
                576: {
                    items: 6
                },
                //Medium
                768: {
                    items: 7
                },
                //Large
                992: {
                    items: 9
                },
                //Extra large
                1200: {
                    items: 11
                },
                //Extra extra large
                1400: {
                    items: 12
                }
            }
        })
    </script>

    <script>
        $('#category-slider, #top-seller-slider').owlCarousel({
            loop: false,
            autoplay: false,
            margin: 20,
            nav: false,
            // navText: ["<i class='czi-arrow-left'></i>","<i class='czi-arrow-right'></i>"],
            dots: true,
            autoplayHoverPause: true,
            '{{session("direction")}}': true,
            // center: true,
            responsive: {
                //X-Small
                0: {
                    items: 2
                },
                360: {
                    items: 3
                },
                375: {
                    items: 3
                },
                540: {
                    items: 4
                },
                //Small
                576: {
                    items: 5
                },
                //Medium
                768: {
                    items: 6
                },
                //Large
                992: {
                    items: 8
                },
                //Extra large
                1200: {
                    items: 10
                },
                //Extra extra large
                1400: {
                    items: 11
                }
            }
        })
    </script>
@endpush

