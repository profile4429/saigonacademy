@extends('frontend/layouts/master')
@section('title')
    Trang Chủ
@endsection
@section('content')
    <div class="container mb-5 linhvuc">
        <span class="span_header">{{ __('home.linhvuc_header') }}</span>
        <p>
            {{ __('home.linhvuc_content') }}
        </p>
        <div class="container-fluid">
            <div class="album py-5 bg-light">
                <div class="container">
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
@endsection

<style>
    .span_header {
        font-weight: bold;
        color: #88191c;
        font-size: 2rem;
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
