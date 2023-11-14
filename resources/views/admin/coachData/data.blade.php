@extends(Auth::user()->hasRole('admin') ? 'admin.layouts.master' : 'coach.layouts.master')

@section('main-content')
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="row">
            <div class="col-md-12">
                {{-- @include('admin.layouts.notification') --}}
            </div>
        </div>
        <div class="card-header py-3">
            <form action="{{ route('upload.csv') }}" method="post" class="float-left border" enctype="multipart/form-data">
                @csrf
                <input type="file" name="csv_file" id="" accept=".csv"><br>
                <button type="submit" class="btn btn-primary btn-sm my-2">submit</button>
            </form><br><br><br>

        </div>
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>S.N.</th>
                        <th>Name</th>
                        <th>Postion</th>
                        <th>Email</th>
                        <th>Phone No.</th>
                        <th>City</th>
                        {{-- @if (auth()->user()->hasRole('admin')) --}}

                        <th>Action</th>
                        {{-- @endif --}}
                    </tr>
                </thead>
                {{-- <tfoot>
                        <tr>
                            <th>S.N.</th>
                            <th>Name</th>
                            <th>Postion</th>
                            <th>Email</th>
                            <th>Phone No.</th>
                            <th>City</th>

                            <th>Action</th>
                        </tr>
                    </tfoot> --}}
                <tbody>
                    @foreach ($data as $key => $datas)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $datas->first_name }}&nbsp;{{ $datas->last_name }}</td>
                            <td>{{ $datas->position }}</td>
                            <td>{{ $datas->email_address }}</td>
                            <td>{{ $datas->phone_number }}</td>
                            <td>{{ $datas->city }}</td>

                            <td class="d-flex">
                                <a href="{{ route('data.edit', $datas->id) }}"
                                    class="btn btn-primary btn-sm float-left mr-1"
                                    style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="edit"
                                    data-placement="bottom"><i class="fas fa-edit"></i></a>
                                </a>
                                <form method="POST" action="{{ route('data.destroy', [$datas->id]) }}">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-danger btn-sm dltBtn" data-id="{{ $datas->id }}"
                                        style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip"
                                        data-placement="bottom" title="Delete"><i class="fas fa-trash-alt"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{-- <span style="float:right"></span> --}}
        </div>
    </div>
@endsection

@push('styles')
    <link href="{{ asset('backend/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />

@endpush

@push('scripts')
    <!-- Page level plugins -->
    <script src="{{ asset('backend/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('backend/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('backend/js/demo/datatables-demo.js') }}"></script>
    {{-- <script>
        $('#user-dataTable').DataTable({
            "columnDefs": [{
                "orderable": false,
                "targets": [6, 7]
            }]
        });

        // Sweet alert

        function deleteData(id) {

        }
    </script> --}}
    <script>
        $(document).ready(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('.dltBtn').click(function(e) {
                var form = $(this).closest('form');
                var dataID = $(this).data('id');
                // alert(dataID);
                e.preventDefault();
                swal({
                        title: "Are you sure?",
                        text: "Once deleted, you will not be able to recover this data!",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            form.submit();
                        } else {
                            swal("Your data is safe!");
                        }
                    });
            })
        })
    </script>
@endpush
