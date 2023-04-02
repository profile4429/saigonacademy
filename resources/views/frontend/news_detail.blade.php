@extends('frontend/layouts/master')
@section('title')
    Trang Chủ
@endsection

@section('content')
    <div class="container justify-content-center">
        <div class="row">
            @foreach ($getnews_id as $item)
                <div class="col-md-12   ">
                    <h3 class="text-center mb-3 span_title">{{ $item->title }}</h3>
                    <p class="lead mb-3">{{ $item->date }}</p>
                    <img src="{{ asset('/images/' . $item->image) }}" class="img-fluid mb-3 mx-auto d-block rounded" alt="Hình ảnh tuyển sinh">
                    <p class="mb-5">{!! $item->description !!}</p>
                </div>
            @endforeach
        </div>
    </div>
@endsection

<style>
    .span_title {
        font-weight: bold;
        color: #88191c;
        font-size: 2rem;
    }
</style>
