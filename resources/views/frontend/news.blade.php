@extends('frontend/layouts/master')
@section('title')
    Trang Chủ
@endsection

@section('content')
    <div class="container">
        <div class="m-2"><span class="span_title">{{__('header.tintuc')}}</span></div>
        <div class="row">
            @foreach ($news as $item)
                <div class="col-md-6 mb-4">
                    <div class="card mb-4" style="height: 100%;">
                        <a href="{{ route('news_detail') }}?id={{ $item->id }}"><img
                                class="bd-placeholder-img card-img-top" width="100%" height="355"
                                src="{{ asset('/images/' . $item->image) }}" alt="Linh vuc"></a>
                        <div class="card-body">
                            <h4 class="card-title mt-3" style="transform: translateY(-20px);">{{ $item->title }}</h4>
                            <p class="card-text">{!! $item->description !!}</p>
                            <p class="card-text"><small class="text-muted">Ngày đăng: {{ $item->date }}</small></p>
                        </div>
                    </div>
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

    .card-title {
        font-size: 1rem;
        font-weight: bold;
        color: #333;
        transition: all 0.3s ease;
    }

    .card-title:hover {
        color: #88191c;
        transform: translateY(-5px);
    }

    .card-text {
        color: #555;
        font-size: 1rem;

    }
</style>
