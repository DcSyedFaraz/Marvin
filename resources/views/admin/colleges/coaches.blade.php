@extends('admin.layouts.master')

@section('main-content')
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="row">
            <div class="col-md-12">
                @include('admin.layouts.notification')
            </div>
        </div>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        {{-- <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary float-left">Colleges List</h6>
      <a href="{{route('college.create')}}" class="btn btn-primary btn-sm float-right" data-toggle="tooltip" data-placement="bottom" title="Add User"><i class="fas fa-plus"></i> Add College</a>
    </div> --}}
        <div class="card-body">
            <div class="container">
                <h2>Assign Coaches to Sports</h2>
                <form method="POST" action="{{ route('adminCoachsave') }}">
                    @csrf
                    <input type="hidden" name="college_id" value="{{ $colleges->id }}">

                    @foreach ($sports as $sport)
                        <h3>Sports: {{ $sport->title }}</h3>

                        @foreach ($coaches as $coach)
                            <div class="form-check">
                                @php
                                    $isAssigned = in_array(
                                        $coach->id,
                                        $coachSport
                                            ->where('sports_id', $sport->id)
                                            ->where('colleges_id', $colleges->id)
                                            ->pluck('user_id')
                                            ->toArray(),
                                    );
                                @endphp
                                <input type="checkbox" class="form-check-input"
                                    name="sports[{{ $sport->id }}][coaches][]" value="{{ $coach->id }}"
                                    {{ $isAssigned ? 'checked' : '' }}>
                                <label class="form-check-label">{{ $coach->name }}</label>
                            </div>
                        @endforeach
                        <br>
                    @endforeach

                    <button type="submit" class="btn btn-primary">Assign Coaches</button>
                </form>

            </div>
        </div>
    </div>
@endsection

@push('styles')
    <link href="{{ asset('backend/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
    <style>
        div.dataTables_wrapper div.dataTables_paginate {
            display: none;
        }
    </style>
@endpush

@push('scripts')
    <!-- Page level plugins -->
    <script src="{{ asset('backend/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('backend/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('backend/js/demo/datatables-demo.js') }}"></script>
    <script>
        $('#user-dataTable').DataTable({
            "columnDefs": [{
                "orderable": false,
                "targets": [6, 7]
            }]
        });

        // Sweet alert

        function deleteData(id) {

        }
    </script>
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
