@extends('frontend/layouts/master')
@section('title')
    Trang Chủ
@endsection

@section('content')
    {{-- <div class="container">
        <div class="row">
            @foreach ($contact as $item)
                <div class="col-md-3">
                    <div class="card mb-4" style="height: 100%;width:100%">
                        <div class="card-body">
                            <h5 class="card-title">{{ $item->title }}</h5>
                            <p class="card-text">Địa chỉ: {{ $item->address }}</p>
                            <p class="card-text">Số điện thoại:{{ $item->phone }}</p>
                            <p>{!! $item->description !!}</p>
                        </div>
                    </div>
                </div>
          @endforeach

        </div>
    </div> --}}

    <div class="container my-3">
        <div class="row">
            @foreach ($contact as $item)
                <div class="col-md-12">
                    <div class="card mb-4">
                        <div class="card-body">
                            <span class="span_header">{{ $item->title }}</span>
                            <p class="card-text"><strong>Địa chỉ:  </strong>{{ $item->address }}</p>
                            <p class="card-text"><strong>Số điện thoại: </strong>{{ $item->phone }}</p>
                            <p>{!! $item->description !!}</p>
                        </div>
                    </div>
                </div>
            @endforeach
            <!-- Thêm nhiều item cho các chi nhánh khác -->
        </div>
    </div>
@endsection
<style>
    .span_header {
        font-weight: bold;
        color: #88191c;
        font-size: 1.5rem;
    }

</style>
