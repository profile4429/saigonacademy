@extends('backend/layouts/adminHome')
@section('title')
    Tintro
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-primary text-white">
                <h5 class="text-center mb-0">Add Intro</h5>
            </div>
            <div class="card-body">
                <form method="post" action="{{ route('addIntro') }}" enctype="multipart/form-data">
                    @csrf
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
                    <h5 class="modal-title" id="exampleModalLabel">Detele intro</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h3>Delete?</h3>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="idIntro" value="">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary btnDel">Delete</button>
                </div>
            </div>
        </div>
    </div>


    <div class="container-fluid mt-4">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5>Intro</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Language</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($intro as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    @foreach ($language as $items)
                                        @if ($items->id == $item->language_id)
                                            <td>{{ $items->title }}</td>
                                        @endif
                                    @endforeach
                                    <td>{{ $item->title }}</td>
                                    <td>{!! $item->description !!}</td>
                                    <td>
                                        <a href="{{ route('showdataIntro') }}?id={{ $item->id }}"><button
                                                class="btn btn-warning">Edit</button></a>
                                        <button type="button" class="btn btn-danger btnDelete"
                                            data-id="{{ $item->id }}">Delete</button>

                                        @php
                                            $introlocale = App\Models\introlocale::where('vi', $item->id)
                                                ->orWhere('en', $item->id)
                                                ->first();
                                            if ($introlocale && (($introlocale->vi == $item->id && $introlocale->en != null) || ($introlocale->en == $item->id && $introlocale->vi != null))) {
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
                    ['fontsize', ['fontsize']],
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
                $('#idIntro').val(id);
                $('#exampleModal').modal('show');
            });

            $(document).on('click', ".btnDel", function() {
                let id = $('#idIntro').val();

                $.ajax({
                    type: 'post',
                    dataType: 'json',
                    url: '{{ route('deleteIntro') }}',
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
        $(document).on('click', '.btnEdit', function() {
            // Lấy id của dòng được chọn
            // var introId = $(this).data('id');

            // // Lấy dữ liệu từ trang chủ
            // var introTitle = $(this).closest('tr').find('td:eq(1)').text();
            // var introDescription = $(this).closest('tr').find('td:eq(2)').html();
            // var introLanguageId = $(this).closest('tr').find('td:eq(3)').text();

            // // Điền dữ liệu vào form
            // $('#title').val(introTitle);
            // $('#description').val(introDescription);
            // $('#language_id').val(introLanguageId);
            $('html, body').animate({
                scrollTop: $('form').offset().top
            }, 'fast');
        });
    </script>
@endsection
