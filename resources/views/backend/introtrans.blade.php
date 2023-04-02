@extends('backend/layouts/adminHome')
@section('title')
    Trang Chủ
@endsection

@section('content')
    <div class="container">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-primary text-white">
                <h5 class="text-center mb-0">Translate Intro</h5>
            </div>
            <div class="card-body">
                <form method="post" action="{{ route('transIntro')}}" enctype="multipart/form-data">
                    @csrf
                    <input name="id" type="hidden" class="form-control"
                        value="{{ $intro->id }}">
                        <div class="form-group">
                            <label for="language_id_from">Translate from:</label>
                            <select class="form-control" name="language_id_from" id="language_id_from" required disabled>
                                @foreach ($language as $item)
                                    <option value="{{ $item->id }}"
                                        {{ !empty($intro) && $intro->language_id == $item->id ? 'selected' : '' }}>
                                        {{ $item->title }}
                                    </option>
                                @endforeach
                            </select>
                            <?php $language_id_from = $intro->language_id ?? null; ?>
                        </div>
                        
                        <div class="form-group">
                            <label for="language_id">Translate to:</label>
                            <select class="form-control" name="language_id" id="language_id" required>
                                @foreach ($language as $item)
                                    @if ($item->id != $language_id_from)
                                        <option value="{{ $item->id }}"
                                            {{ !empty($intro) && $intro->language_id == $item->id ? 'selected' : '' }}>
                                            {{ $item->title }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        

                    <div class="form-group">
                        <label for="title">Title:</label>
                        <input name="title" required type="text" class="form-control" id="title"
                            value="{{ $intro->title }}">
                    </div>
                    <div class="form-group">
                        <label for="description">Decsription:</label>
                        <textarea name="description" class="form-control" id="description">{{$intro->description }}</textarea>
                    </div>
                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-primary">Translate</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#description').summernote({
                placeholder: 'Nhap noi dung',
                tabsize: 2,
                height: 300,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ]
            });
        });
    </script>
@endsection
