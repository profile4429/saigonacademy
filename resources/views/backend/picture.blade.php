@extends('backend/layouts/adminHome')
@section('title')
    picture
@endsection

@section('content')
<div class="container-fluid">
    <div class="card border-0 shadow-sm">
      <div class="card-header bg-primary text-white text-center">
        <h5>Add Picture</h5>
      </div>
      <div class="card-body">
        <form method="post" action="{{ route('addPicture') }}" enctype="multipart/form-data">
          @csrf
          <div class="form-group">
            <label for="url">Url:</label>
            <input name="url" type="text" class="form-control" id="url" value="">
          </div>
          <div class="form-group">
            <label for="slider">Slider:</label>
            <div class="input-group">
              <div class="custom-file">
                <input required type="file" class="custom-file-input" id="slider" name="slider" accept=".jpg, .png, .jpeg|image/*">
                <label class="custom-file-label" for="slider">Choose file</label>
              </div>
            </div>
            <img class="card-img-top mt-3" style="height: 350px;  object-fit: cover;" src="" alt="" id="preview-image">
          </div>
          <div class="form-group text-center">
            <button type="submit" class="btn btn-primary">Add Slider</button>
          </div>
        </form>
      </div>
      <div class="card-body">
        <form method="post" action="{{ route('addPictureMembers') }}" enctype="multipart/form-data">
          @csrf
          <div class="form-group">
            <label for="url">Url:</label>
            <input name="url" type="text" class="form-control" id="url" value="">
          </div>
          <div class="form-group">
            <label for="members">Members:</label>
            <div class="input-group">
              <div class="custom-file">
                <input required type="file" class="custom-file-input" id="members" name="members" accept=".jpg, .png, .jpeg|image/*">
                <label class="custom-file-label" for="members">Choose file</label>
              </div>
            </div>
            <img class="card-img-top mt-3" style="height: 220px; width: 220px; object-fit: cover;" src="" alt="" id="preview-image-members">
          </div>
          <div class="form-group text-center">
            <button type="submit" class="btn btn-primary">Add Members</button>
          </div>
        </form>
      </div>
    </div>
</div>
      

    <div class="container-fluid mt-4">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5>Slider List</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Url</th>
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($picture as $item)
                                @if (!is_null($item->slider))
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->url }}</td>
                                        <td><img class="card-img-top" style="height: 350px; object-fit: cover;"
                                                src="{{ asset('/images/' . $item->slider) }}" alt=""></td>
                                        <td>
                                            <button type="button" class="btn btn-danger btnDelete"
                                                data-id="{{ $item->id }}">Delete</button>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid mt-4">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5>Members List</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Url</th>

                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($picture as $item)
                                @if (!is_null($item->members))
                                    <tr>

                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->url }}</td>

                                        <td><img class="card-img-top" style="height: 220px;width: 220px; object-fit: cover;"
                                                src="{{ asset('/images/' . $item->members) }}" alt=""></td>
                                        <td>
                                            <button type="button" class="btn btn-danger btnDelete"
                                                data-id="{{ $item->id }}">Delete</button>
                                        </td>

                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>



    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detele Picture</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h3>Delete?</h3>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="idPicture" value="02">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary btnDel">Delete</button>
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
                $('#idPicture').val(id);
                $('#exampleModal').modal('show');
            });

            $(document).on('click', ".btnDel", function() {
                let id = $('#idPicture').val();

                $.ajax({
                    type: 'post',
                    dataType: 'json',
                    url: '{{ route('deletePicture') }}',
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
        $('#slider').change(function() {
            let reader = new FileReader();
            reader.onload = function(e) {
                $('#preview-image').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        });

        $('#members').change(function() {
            let reader = new FileReader();
            reader.onload = function(e) {
                $('#preview-image-members').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        });
    </script>
@endsection
