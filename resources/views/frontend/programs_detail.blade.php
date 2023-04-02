@extends('frontend/layouts/master')
@section('title')
    Trang Chủ
@endsection

@section('content')
    <div class="container">
        @foreach ($getprograms_id as $item)
            <div class="row">
                <div class="col-md-12">
                        <h1 class="text-center span_title">{{ $item->title }}</h1>
                        <p>{!! $item->description !!}</p>
                </div>
            </div>
        @endforeach
    </div>
@endsection
<style>
    .span_title {
        font-weight: bold;
        color: #88191c;
        font-size: 2rem;
    }
</style>
