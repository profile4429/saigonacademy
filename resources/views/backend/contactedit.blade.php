@extends('backend/layouts/adminHome')
@section('title')
    Trang Chủ
@endsection

@section('content')
    <div class="container">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-primary text-white">
                <h5 class="text-center mb-0">Edit Contact</h5>
            </div>
            <div class="card-body">
                <form method="post" action="{{ route('editContact')}}" enctype="multipart/form-data">
                    @csrf
                    <input name="id" type="hidden" class="form-control"
                        value="{{ $contact->id }}">
                    <div class="form-group">
                        <label for="language_id">Language:</label>
                        <select class="form-control" name="language_id" id="language_id" required>
                            @foreach ($language as $item)
                                <option value="{{ $item->id }}"
                                    {{ !empty($contact) && $contact->language_id == $item->id ? 'selected' : '' }}>
                                    {{ $item->title }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="title">Title:</label>
                        <input name="title" required type="text" class="form-control" id="title"
                            value="{{ $contact->title }}">
                    </div>
                    <div class="form-group">
                        <label for="address">Address:</label>
                        <input name="address" required type="text" class="form-control" id="address" value="{{ $contact->address}}">
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone:</label>
                        <input name="phone" required type="text" class="form-control" id="phone" value="{{ $contact->phone}}">
                    </div>

                    <div class="form-group">
                        <label for="description">Decsription:</label>
                        <textarea name="description" class="form-control" id="description">{{$contact->description }}</textarea>
                    </div>
                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-primary">Edit</button>
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
      <script>
        $('#image').change(function() {
          let reader = new FileReader();
          reader.onload = function(e) {
            $('#preview-image').attr('src', e.target.result);
          }
          reader.readAsDataURL(this.files[0]);
        });
      </script>
@endsection
