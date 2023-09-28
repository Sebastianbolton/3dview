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
    <div class="row main-row">
      <!-- Left Column -->
      <div class="col-lg-4">
        <div class="row">
          <div class="col-xs-3 tool-tab" style="width:20%">
            <!-- Main Navigation -->
            <ul class="nav nav-sidebar">
              <li class="tab border-bottom" id="floorplan_tab"><a href="#">
                  <div class="tab-icon">
                    <img src="public/images/icons/Edit-dark.png" id="edit" style="width: 100%;">
                  </div>
                  <div class="center">Edit</div>
                  <!-- <span class="glyphicon glyphicon-chevron-right pull-right"></span> -->
                </a>
              </li>
              <li class="tab border-bottom" id="design_tab"><a href="#">
                  <div class="tab-icon">
                    <img src="public/images/icons/Design-dark.png" id="design" style="width: 100%;">
                  </div>
                  <div class="center">Design</div>
                  <!-- <span class="glyphicon glyphicon-chevron-right pull-right"></span> -->
                </a></li>
              <li class="tab border-bottom" id="items_tab"><a href="#">
                  <div class="tab-icon">
                    <img src="public/images/icons/Add item-dark.png" id="add" style="width: 100%;">
                  </div>
                  <div class="center">Add items</div>
                  <!-- <span class="glyphicon glyphicon-chevron-right pull-right"></span> -->
                </a></li>
              <li class="tab" id="order_tab"><a href="#">
                  <div class="tab-icon">
                    <img src="public/images/icons/Order-dark.png" id="aaa" style="width: 100%;">
                  </div>
                  <div class="center">Order</div>

                </a></li>
            </ul>
            <!-- <hr /> -->
          </div>

          <div class="col-xs-9" style="padding: 0px;">
            <div class="medium-sidebar">

              <!-- Add Items -->
              <div class="board-group" id="accordion">
                <div class="board board-default">
                  <div class="board-heading title-box">
                    <h4 class="board-title">
                      <a data-toggle="collapsea" data-parent="#accordion" href="#collapsea1">Furniture</a>
                    </h4>
                  </div>
                  <div id="collapsea1" class="board-collapsea collapsea in">
                    <div class="board-body add-items">
                      <div class="row" id="items-wrapper">

                        <!-- Items added here by items.js -->
                      </div>
                    </div>
                  </div>
                </div>
                <div class="board board-default">
                  <div class="board-heading title-box">
                    <h4 class="board-title">
                      <a data-toggle="collapsea" data-parent="#accordion" href="#collapsea2">Chair</a>
                    </h4>
                  </div>
                  <div id="collapsea2" class="board-collapsea collapsea">
                    <!-- <div class="board-body">Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                      sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                      quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</div> -->
                    <div class="board-body add-items">
                      <div class="row" id="chairs-wrapper">

                        <!-- Items added here by items.js -->
                      </div>
                    </div>
                  </div>
                </div>
                <div class="board board-default">
                  <div class="board-heading title-box">
                    <h4 class="board-title">
                      <a data-toggle="collapsea" data-parent="#accordion" href="#collapsea3">Door</a>
                    </h4>
                  </div>
                  <div id="collapsea3" class="board-collapsea collapsea">
                    <div class="board-body add-items">
                      <div class="row" id="doors-wrapper">

                        <!-- Items added here by items.js -->
                      </div>
                    </div>
                  </div>
                </div>
                <div class="board board-default">
                  <div class="board-heading title-box">
                    <h4 class="board-title">
                      <a data-toggle="collapsea" data-parent="#accordion" href="#collapsea4">Carpet</a>
                    </h4>
                  </div>
                  <div id="collapsea4" class="board-collapsea collapsea">
                    <div class="board-body add-items">
                      <div class="row" id="carpets-wrapper">

                        <!-- Items added here by items.js -->
                      </div>
                    </div>
                  </div>
                </div>



              </div>

              <!-- Context Menu -->
              <div id="context-menu">
                <div style="margin: 20px 20px">
                  <span id="context-menu-name" class="lead"></span>
                  <br /><br />
                  <button class="btn btn-block btn-danger" id="context-menu-delete">
                    <span class="glyphicon glyphicon-trash"></span>
                    Delete Item
                  </button>
                  <br />
                  <div class="board board-default">
                    <div class="board-heading">Adjust Size</div>
                    <div class="board-body" style="color: #333333">

                      <div class="form form-horizontal" class="lead">
                        <div class="form-group">
                          <label class="col-sm-5 control-label">
                            Width
                          </label>
                          <div class="col-sm-6">
                            <input type="number" class="form-control" id="item-width">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-5 control-label">
                            Depth
                          </label>
                          <div class="col-sm-6">
                            <input type="number" class="form-control" id="item-depth">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-5 control-label">
                            Height
                          </label>
                          <div class="col-sm-6">
                            <input type="number" class="form-control" id="item-height">
                          </div>
                        </div>
                      </div>
                      <small><span class="text-muted">Measurements in inches.</span></small>
                    </div>
                  </div>

                  <label><input type="checkbox" id="fixed" /> Lock in place</label>
                  <br /><br />
                </div>
              </div>

              <!-- Floor textures -->
              <div id="floorTexturesDiv" style="display:none; padding: 10px 20px">
                <div class="board board-default">
                  <div class="board-heading">Adjust Floor</div>
                  <div class="board-body" style="color: #333333">

                    <div class="col-sm-6" style="padding: 3px">
                      <a href="#" class="thumbnail texture-select-thumbnail"
                        texture-url="public/rooms/textures/light_fine_wood.jpg" texture-stretch="false" texture-scale="300">
                        <img alt="Thumbnail light fine wood" src="public/rooms/thumbnails/thumbnail_light_fine_wood.jpg" />
                      </a>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Wall Textures -->
              <div id="wallTextures" style="display:none; padding: 10px 20px">
                <div class="board board-default">
                  <div class="board-heading">Adjust Wall</div>
                  <div class="board-body" style="color: #333333">
                    <div class="col-sm-6" style="padding: 3px">
                      <a href="#" class="thumbnail texture-select-thumbnail"
                        texture-url="public/rooms/textures/marbletiles.jpg" texture-stretch="false" texture-scale="300">
                        <img alt="Thumbnail marbletiles" src="public/rooms/thumbnails/thumbnail_marbletiles.jpg" />
                      </a>
                    </div>
                    <div class="col-sm-6" style="padding: 3px">
                      <a href="#" class="thumbnail texture-select-thumbnail"
                        texture-url="public/rooms/textures/wallmap_yellow.png" texture-stretch="true" texture-scale="">
                        <img alt="Thumbnail wallmap yellow" src="public/rooms/thumbnails/thumbnail_wallmap_yellow.png" />
                      </a>
                    </div>
                    <div class="col-sm-6" style="padding: 3px">
                      <a href="#" class="thumbnail texture-select-thumbnail"
                        texture-url="public/rooms/textures/light_brick.jpg" texture-stretch="false" texture-scale="100">
                        <img alt="Thumbnail light brick" src="public/rooms/thumbnails/thumbnail_light_brick.jpg" />
                      </a>
                    </div>
                  </div>
                </div>
              </div>
              <div id="order_menu" style="display: none;">
                <div id="order-wrapper">
                  
                </div>
              </div>
            </div>

          </div>
        </div>




      </div>

      <!-- Right Column -->
      <div class="col-lg-8 main">
        <div class="row">
          <div class="col-xs-11">
            <!-- 3D Viewer -->
            <div id="viewer">

              <!-- <div id="camera-controls">
                <a href="#" class="btn btn-default bottom" id="zoom-out">
                  <span class="glyphicon glyphicon-zoom-out"></span>
                </a>
                <a href="#" class="btn btn-default bottom" id="reset-view">
                  <span class="glyphicon glyphicon glyphicon-home"></span>
                </a>
                <a href="#" class="btn btn-default bottom" id="zoom-in">
                  <span class="glyphicon glyphicon-zoom-in"></span>
                </a>

                <span>&nbsp;</span>

                <a class="btn btn-default bottom" href="#" id="move-left">
                  <span class="glyphicon glyphicon-arrow-left"></span>
                </a>
                <span class="btn-group-vertical">
                  <a class="btn btn-default" href="#" id="move-up">
                    <span class="glyphicon glyphicon-arrow-up"></span>
                  </a>
                  <a class="btn btn-default" href="#" id="move-down">
                    <span class="glyphicon glyphicon-arrow-down"></span>
                  </a>
                </span>
                <a class="btn btn-default bottom" href="#" id="move-right">
                  <span class="glyphicon glyphicon-arrow-right"></span>
                </a>
              </div> -->

              <div id="loading-modal">
                <h1>Loading...</h1>
              </div>
            </div>

            <!-- 2D Floorplanner -->
            <div id="floorplanner">
              <canvas id="floorplanner-canvas"></canvas>
              <div id="floorplanner-controls">

                <button id="move" class="btn btn-sm btn-default">
                  <span class="glyphicon glyphicon-move"></span>
                  Move Walls
                </button>
                <button id="draw" class="btn btn-sm btn-default">
                  <span class="glyphicon glyphicon-pencil"></span>
                  Draw Walls
                </button>
                <button id="delete" class="btn btn-sm btn-default">
                  <span class="glyphicon glyphicon-remove"></span>
                  Delete Walls
                </button>
                <span class="pull-right">
                  <button class="btn btn-sm" id="update-floorplan" style="background-color: #1B7FED; color:#ffffff;">Done
                    &raquo;</button>
                </span>

              </div>
              <div id="draw-walls-hint">
                Press the "Esc" key to stop drawing walls
              </div>
            </div>
          </div>

          <div class="col-xs-1 tool-tab" style="padding: 0px; width: 5.8%;">
            <div class="" id="tool">
              <div class="tool-icon border-bottom">
                <a href="#" class="" id="new">
                  <img src="public/images/icons/New.png" style="width: 100%;">
                </a>
              </div>
              <div class="tool-icon border-bottom">
                <a href="#" class="" id="saveFile">
                  <img src="public/images/icons/Save.png" style="width: 100%;">
                </a>
              </div>
              <div class="tool-icon border-bottom">
                <a class="btn-file">
                  <input type="file" class="hidden-input" id="loadFile">
                  <img src="public/images/icons/Load.png" style="width: 100%;">
                </a>
              </div>

            </div>
            <!-- <div id="camera-controls"> -->
            <div>
              <div class="border-bottom bottom">
                <a href="#" id="zoom-out">
                  <span class="glyphicon glyphicon-zoom-out"></span>
                </a>
              </div>

              <div class="border-bottom bottom">
                <a href="#" id="reset-view">
                  <span class="glyphicon glyphicon glyphicon-home"></span>
                </a>
              </div>
              <div class="border-bottom bottom">
                <a href="#" id="zoom-in">
                  <span class="glyphicon glyphicon-zoom-in"></span>
                </a>
              </div>
              <div class="border-bottom bottom">
                <a href="#" id="move-left">
                  <span class="glyphicon glyphicon-arrow-left"></span>
                </a>
              </div>
              <div class="border-bottom bottom">
                <a class="" href="#" id="move-up">
                  <span class="glyphicon glyphicon-arrow-up"></span>
                </a>
              </div>
              <div class="border-bottom bottom">
                <a class="" href="#" id="move-down">
                  <span class="glyphicon glyphicon-arrow-down"></span>
                </a>
              </div>
              <div class="border-bottom bottom">
                <a href="#" id="move-right">
                  <span class="glyphicon glyphicon-arrow-right"></span>
                </a>
              </div>

            </div>
          </div>
        </div>


      </div>

      <!-- End Right Column -->
    </div>
  </div>

  <style>
    #order-wrapper {
      font-size: 1.1rem;
      font-weight: 600;
    }
    .order-table {
      margin: 10px;
      align-items: center;
      border-bottom: 1px solid #000;
      height: 50px;
    }
  </style>

  @endsection
