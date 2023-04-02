@extends('backend/layouts/adminHome')
@section('title')
    contact
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-primary text-white">
                <h5 class="text-center mb-0">Add Contact</h5>
            </div>
            <div class="card-body">
                <form method="post" action="{{ route('addContact') }}" enctype="multipart/form-data">
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
                        <label for="address">Address:</label>
                        <input name="address" required type="text" class="form-control" id="address" value="">
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone:</label>
                        <input name="phone" required type="text" class="form-control" id="phone" value="">
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
                    <h5 class="modal-title" id="exampleModalLabel">Detele contact</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h3>Delete?</h3>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="idContact" value="">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary btnDel">Delete</button>
                </div>
            </div>
        </div>
    </div>


    <div class="container-fluid mt-4">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5>Contact</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Language</th>
                                <th>Title</th>
                                <th>Address</th>
                                <th>Phone</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($contact as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    @foreach ($language as $items)
                                        @if ($items->id == $item->language_id)
                                            <td>{{ $items->title }}</td>
                                        @endif
                                    @endforeach
                                    <td>{{ $item->title }}</td>
                                    <td>{{ $item->address }}</td>
                                    <td>{{ $item->phone }}</td>
                                    <td>{!! $item->description !!}</td>
                                    <td>
                                        <a href="{{ route('showdataContact') }}?id={{ $item->id }}"><button
                                                class="btn btn-warning">Edit</button></a>
                                        <button type="button" class="btn btn-danger btnDelete"
                                            data-id="{{ $item->id }}">Delete</button>

                                        @php
                                            $contactlocale = App\Models\contactlocale::where('vi', $item->id)
                                                ->orWhere('en', $item->id)
                                                ->first();
                                            if ($contactlocale && (($contactlocale->vi == $item->id && $contactlocale->en != null) || ($contactlocale->en == $item->id && $contactlocale->vi != null))) {
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
                $('#idContact').val(id);
                $('#exampleModal').modal('show');
            });

            $(document).on('click', ".btnDel", function() {
                let id = $('#idContact').val();

                $.ajax({
                    type: 'post',
                    dataType: 'json',
                    url: '{{ route('deleteContact') }}',
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
