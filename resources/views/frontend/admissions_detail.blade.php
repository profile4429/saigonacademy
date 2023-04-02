@extends('frontend/layouts/master')
@section('title')
    Trang Chủ
@endsection

@section('content')
    <div class="container justify-content-center">
        <div class="row">
            @foreach ($getadmissions_id as $item)
                <div class="col-md-12">
                    <span class="mb-3 span_title">{{ $item->title }}</span>
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
        font-size: 1.5rem;
    }
</style>
