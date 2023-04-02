@extends('backend/layouts/adminHome')
@section('title')
    language
@endsection

@section('content')
    <div class="container">
        <form method="post" action="{{ route('addlanguage') }}">
            @csrf
            <h1>Add Language</h1>
            <div class="form-group">
                <label for="language">Language:</label>
                <input type="text" class="form-control" name="title" placeholder="Enter language">
            </div>
            <button type="submit" class="btn btn-primary btnAddLanguage" disabled>Add</button>
        </form>

    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detele Language</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h3>Delete?</h3>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="idLanguage" value="">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary btnDel">Delete</button>
                </div>
            </div>
        </div>
    </div>


    <div class="container
                        mt-4">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5>Languages</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Icon</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($language as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->title }}</td>
                                    <td>null</td>
                                    <td>
                                        <button class="btn btn-warning">Edit</button>
                                        <button type="button" class="btn btn-danger btnDelete"
                                            data-id="{{ $item->id }}">Delete</button>
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
            $(document).on("click", ".btnDelete", function() {
                let id = $(this).data('id');
                $('#idLanguage').val(id);
                $('#exampleModal').modal('show');
            });

            $(document).on('click', ".btnDel", function() {
                let id = $('#idLanguage').val();

                $.ajax({
                    type: 'post',
                    dataType: 'json',
                    url: '{{ route('deleteLanguage') }}',
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
@endsection
