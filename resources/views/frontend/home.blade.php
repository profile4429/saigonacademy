@extends('frontend/layouts/master')
@section('title')
    Trang Chủ
@endsection

@section('content')
    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000"
        data-bs-pause="hover">
        <div class="carousel-inner">
            @foreach ($picture as $item)
                @if (!is_null($item->slider))
                    <div class="carousel-item @if ($loop->first) active @endif">
                        <a href="{{ $item->url }}">
                            <img src="{{ asset('/images/' . $item->slider) }}" class="d-block w-100" alt="slide">
                        </a>
                    </div>
                @endif
            @endforeach
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>


    <div class="container-fluid p-5 intro">
        <h3 class="text-center" style="color: #88191c">{{ __('home.intro_header') }}</h3>
        <div class="container">
            <p>{{ __('home.intro_content') }}</p>
        </div>
    </div>

    <div class="container-fluid linhvuc"
        style="background-image: url('https://saigonacademy.com/themes/custom/bulma_theta/images/footer_bg.png'); background-repeat: no-repeat; background-size: cover;">
        <h3 class="text-center" style="color: #88191c">{{ __('home.linhvuc_header') }}</h3>

        <div class="container-fluid">
            <div class="album mb-2">
                <div class="container">
                    <p>
                        {{ __('home.linhvuc_content') }}
                    </p>
                    <div class="row row-cols-1 row-cols-md-4 g-4">
                        @foreach ($programs as $item)
                            <div class="col">
                                <div class="card shadow-sm">
                                    <a href="{{ route('programs_detail') }}?id={{ $item->id }}"
                                        class="text-decoration-none">
                                        <div class="position-relative">
                                            <img class="bd-placeholder-img card-img-top" width="100%" height="225"
                                                src="{{ asset('/images/' . $item->image) }}" alt="Linh vuc">
                                            <div class="card-img-overlay text-white d-flex flex-column justify-content-end">
                                                <h6 class="card-title">{{ $item->title }}</h6>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid mt-3">
        <div class="image-caption text-center">
            <h5 style="color: #88191c">{{ __('home.feedback_header') }}</h5>
        </div>
        <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000"
            data-bs-pause="hover">
            <div class="carousel-inner">
                @foreach ($feedback as $item)
                    <div class="carousel-item  @if ($loop->first) active @endif">
                        <div class="image-container">
                            <img src="{{ asset('/images/' . $item->image) }}" class="mx-auto d-block rounded-circle"
                                alt="phanhoi">
                            <div class="image-caption text-center">
                                <h6><strong>{{ $item->title }}</strong></h6>
                                <p><strong>{{ $item->career }}</strong></p>
                                <td>{!! $item->description !!}</td>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>


    <div class="container-fluid tintuc">
        <div class="album bg-light">
            <h3 class="text-center m-2" style="color: #88191c">{{ __('home.tintuc_header') }}</h3>
            <div class="container">
                <div class="row row-cols-1 row-cols-md-4 mb">
                    @foreach ($news->take(4) as $item)
                        <div class="col mb-2">
                            <div class="card shadow-sm" style="height: 100%;">
                                <a href="{{ route('news_detail') }}?id={{ $item->id }}">
                                    <img class="bd-placeholder-img card-img-top"
                                        src="{{ asset('/images/' . $item->image) }}" alt="{{ $item->title }}"
                                        width="100%"></a>

                                <div class="card-body">
                                    <h6 class="card-title">{{ $item->title }}</h6>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid mt-5">
        <h5 class="text-center" style="color: #88191c">{{ __('home.member_header') }}</h5>
        <div class="thanhvien-slider">
            @foreach ($picture as $item)
                @if (!is_null($item->members))
                    <div class="thanhvien-slider-item">
                        <a href="{{ $item->url }}"><img class="" src="{{ asset('/images/' . $item->members) }}"
                                width="100%" height="100%"></a>
                    </div>
                @endif
            @endforeach
        </div>
    </div>



    <script>
        $('.thanhvien-slider').slick({
            infinite: true, //Lặp lại
            accessibility: true,
            slidesToShow: 1, //Số item hiển thị
            slidesToScroll: 1, //Số item cuộn khi chạy
            autoplay: true, //Tự động chạy
            autoplaySpeed: 3000, //Tốc độ chạy
            speed: 1000, //Tốc độ chuyển slider
            arrows: false, //Hiển thị mũi tên
            centerMode: false, //item nằm giữa
            dots: false, //Hiển thị dấu chấm
            draggable: true, //Kích hoạt tính năng kéo chuột
            mobileFirst: true,
            pauseOnHover: true,
            responsive: [{
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 6,
                        slidesToScroll: 1,
                        infinite: true,
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
            ]
        });
    </script>





    </div>
@endsection
<style>
    .intro {
        margin: 2rem;
        background-image: url('https://saigonacademy.com/themes/custom/bulma_theta/images/background-ht-sga.jpg');
    }


    .intro p {
        color: #666;
    }


    .image-container {
        position: relative;
    }


    .rounded-circle {
        border-radius: 50%;
        overflow: hidden;
        width: 300px;
        height: 300px;


    }

    .thanhvien-slider {

        height: 250;

    }

    .card {
        transition: .3s all ease;
        border-radius: 20px;
        overflow: hidden;
        height: 100%;
    }

    .card:hover {
        transform: scale(1.1);
        box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.3);
    }

    .card-title {
        font-size: 1rem;
        font-weight: 500;
        text-align: center
    }

    .card-img-overlay {
        background-color: rgba(0, 0, 0, 0.5);
        transition: .3s all ease;
    }

    .card-img-overlay:hover {
        background-color: rgba(0, 0, 0, 0.7);
    }
</style>
