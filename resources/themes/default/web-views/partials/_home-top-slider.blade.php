<div class="grid">
    <div class="grid-item" tabindex="1">
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                @foreach($main_banner as $key=>$banner)
                    <li data-target="#carouselExampleIndicators" data-slide-to="{{$key}}"
                        class="{{$key==0?'active':''}}">
                    </li>
                @endforeach
            </ol>
            <div class="carousel-inner">
                @foreach($main_banner as $key=>$banner)
                    <div class="carousel-item {{$key==0?'active':''}}">
                        <a href="{{$banner['url']}}">
                            <img class="d-block w-100 __slide-img"
                                 onerror="this.src='{{asset('public/assets/front-end/img/image-place-holder.png')}}'"
                                 src="{{asset('storage/app/public/banner').'/'.$banner['photo']}}"
                                 alt="">
                        </a>
                    </div>
                @endforeach
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button"
               data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true" ></span>
                <span class="sr-only">{{\App\CPU\translate('Previous')}}</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button"
               data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">{{\App\CPU\translate('Next')}}</span>
            </a>
        </div>
    </div>
    <div class="grid-item" tabindex="2">
        <img class="general-image general-image-nd" src="../../../../../public/assets/front-end/img/shopping-campaign.png" alt="this is my jpg">
    </div>
    <div class="grid-item" tabindex="3">
        <img class="general-image general-image-rd" src="../../../../../public/assets/front-end/img/smart-shopping.png" alt="this is my jpg">
    </div>
</div>

<style>
    @supports (display: grid) {
        .grid {
            display: grid;
            grid-gap: 1%;
            margin-top: 3px;
        }
        .grid {
            grid-template-columns: repeat(5, 1fr);
            grid-template-rows: auto;
            grid-template-areas:
                "carousel carousel carousel carousel carousel"
                "pic1 pic1 pic1 pic2 pic2";
        }
        .carousel img {
            height: 100%;
        }
        .general-image {
            border-radius: 5px;
            min-width: 100%!important;
            height: 97%;
        }
        @media screen and (min-width: 1280px) {
            .grid {
                grid-template-columns: repeat(3, 1fr);
                grid-template-rows: auto;
                grid-template-areas:
                    "carousel carousel pic1"
                    "carousel carousel pic1"
                    "carousel carousel pic2";
            }
        }
        .grid .grid-item:nth-child(1) { grid-area: carousel;}
        .grid .grid-item:nth-child(2) { grid-area: pic1;}
        .grid .grid-item:nth-child(3) { grid-area: pic2;}
    }
</style>

<script>
    $(function () {
        $('.list-group-item').on('click', function () {
            $('.glyphicon', this)
                .toggleClass('glyphicon-chevron-right')
                .toggleClass('glyphicon-chevron-down');
        });
    });
</script>
