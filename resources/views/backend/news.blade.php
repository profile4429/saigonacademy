@extends('backend/layouts/adminHome')
@section('title')
    news
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-primary text-white">
                <h5 class="text-center mb-0">Add News</h5>
            </div>
            <div class="card-body">
                <form method="post" action="{{ route('addNews') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="date"><b>Date:</b></label>
                        <input name="date" type="datetime-local" id="date" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label for="language_id">Language:</label>
                        <select class="form-control" name="language_id" id="language_id" required>
                            @foreach ($language as $item)
                            <option value="{{ $item->id }}">
                                {{ $item->title }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="title">Title:</label>
                        <input name="title" required type="text" class="form-control" id="title" value="">
                    </div>
                    <div class="form-group">
                        <label for="image">Image:</label>
                        <input required type="file" class="form-control-file" id="image" name="image"
                            accept=".jpg, .png, .jpeg|image/*">
                            <img class="card-img-top" style="height: 150px; width: 300px; object-fit: cover;" src="" alt="" id="preview-image">
                    </div>
                    <div class="form-group">
                        <label for="description">Decsription:</label>
                        <textarea name="description" class="form-control" id="description"></textarea>
                    </div>
                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detele News</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h3>Delete?</h3>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="idNews" value="02">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary btnDel">Delete</button>
                </div>
            </div>
        </div>
    </div>


    <div class="container-fluid mt-4">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5>News</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Date</th>
                                <th>Language</th>
                                <th>Title</th>
                                <th>Image</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($news as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->date }}</td>

                                    @foreach ($language as $items)
                                        @if ($items->id == $item->language_id)
                                            <td>{{ $items->title }}</td>
                                        @endif
                                    @endforeach
                                    <td>{{ $item->title }}</td>
                                    <td><img class="card-img-top" style="height: 150px; object-fit: cover;"
                                        src="{{ asset('/images/' . $item->image) }}" alt=""></td>
                                    <td>{!! $item->description !!}</td>
                                    <td>
                                        <a href="{{ route('showdataNews') }}?id={{ $item->id }}"><button
                                                class="btn btn-warning">Edit</button></a>
                                        <button type="button" class="btn btn-danger btnDelete"
                                            data-id="{{ $item->id }}">Delete</button>
                                           
                                            @php
                                            $newslocale = App\Models\newslocale::where('vi', $item->id)
                                                ->orWhere('en', $item->id)
                                                ->first();
                                            if ($newslocale && (($newslocale->vi == $item->id && $newslocale->en != null) || ($newslocale->en == $item->id && $newslocale->vi != null))) {
                                                $hide_translate = true;
                                            } else {
                                                $hide_translate = false;    
                                            }
                                        @endphp

                                        @if (!$hide_translate)
                                            <a href="{{ route('showtransContact') }}?id={{ $item->id }}">
                                                <button class="btn btn-primary">Translate</button>
                                            </a>
                                        @endif
                                        
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
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
        $(document).ready(function() {
            $(document).on("click", ".btnDelete", function() {
                let id = $(this).data('id');
                $('#idNews').val(id);
                $('#exampleModal').modal('show');
            });

            $(document).on('click', ".btnDel", function() {
                let id = $('#idNews').val();

                $.ajax({
                    type: 'post',
                    dataType: 'json',
                    url: '{{ route('deleteNews') }}',
                    data: {
                        'id': id,
                        '_token': '{{ csrf_token() }}'
                    },
                    success: function(data) {
                        if (data.error == 0) {
                            window.location.reload();
                        } else {
                            alert('Xoa that bai');
                        }
                    }
                });
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
