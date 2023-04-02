@extends('frontend/layouts/master')
@section('title')
    Trang Chủ
@endsection

@section('content')
    <div class="container-fluid">
        @foreach ($getintro_id as $item)
            <div class="container">
              <div class="row">
               <div class="col-md-12">
                <h2 class="text-center span_title">{{ $item->title }}</h2>
                <div>
                    <p>{!! $item->description !!}</p>
                </div>
               </div>
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
