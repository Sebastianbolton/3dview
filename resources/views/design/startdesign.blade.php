@extends('layouts.front-end.app')

@section('title',\App\CPU\translate('3D Design'))

@push('css_or_js')
<meta property="og:image" content="{{asset('storage/app/public/company')}}/{{$web_config['web_logo']->value}}"/>
    <meta property="og:title" content="Brands of {{$web_config['name']->value}} "/>
    <meta property="og:url" content="{{env('APP_URL')}}">
    <meta property="og:description" content="{!! substr($web_config['about']->value,0,100) !!}">

    <meta property="twitter:card" content="{{asset('storage/app/public/company')}}/{{$web_config['web_logo']->value}}"/>
    <meta property="twitter:title" content="Brands of {{$web_config['name']->value}}"/>
    <meta property="twitter:url" content="{{env('APP_URL')}}">
    <meta property="twitter:description" content="{!! substr($web_config['about']->value,0,100) !!}">
    <style>
        .page-item.active .page-link {
            background-color: {{$web_config['primary_color']}}    !important;
        }
        .design-items p, .design-items span {
          margin: 0 1px;
          padding: 0 1px;
        }
        .design-items p {
          white-space: nowrap;
          overflow: hidden;
          text-overflow: ellipsis;
        }
        .design-items p:hover {
          overflow: visible;
          text-overflow: clip;
        }
    </style>

  <link href="public/css/bootstrap.css" rel="stylesheet">
  <link href="public/css/example.css" rel="stylesheet">

  <script src="public/js/three.min.js"></script>
  <script src="public/js/blueprint3d.js"></script>

  <script src="public/js/jquery.js"></script>
  <script src="public/js/bootstrap.js"></script>

  <script src="public/js/items.js"></script>
  <script src="public/js/example.js"></script>

  <script language="javascript" type="text/javascript">
  </script>
@endpush

@section('content')
    <div class="container">
        <div class="startdesigningpage" style="width: 100%;">
            <div class="designimage">
                <div class="contentdesign">
                    <div class="designtitle" style="text-align: center;">
                        Design Your Interior Online
                    </div>
                    <div class="arrangementbutton">
                        <div class="buttongroup">
                            <a class="saveddesigning">Your Saved Designs</a>
                            <a class="startdesigning" href="{{route('design')}} ">{{ \App\CPU\translate('Start Designing')}}</a>
                            <!-- <button class="startdesigning" onclick="route('design')">Start Designing</button> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection