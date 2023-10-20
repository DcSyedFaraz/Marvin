@extends('admin.layouts.master')

@section('main-content')
    <div class="card">
        @include('admin.layouts.notification')

        <h5 class="card-header">Update Sport</h5>
        <div class="card-body">
            <form method="post" action="{{ route('sport.update', $sport->id) }}">
                {{ csrf_field() }}
                @method('put')
                <div class="form-group">
                    <label for="inputTitle" class="col-form-label">Title</label>
                    <input id="inputTitle" type="text" value="{{ $sport->title }}" name="title" placeholder="Enter Title"
                        value="{{ old('title') }}" class="form-control">
                    @error('title')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>


                <div class="form-group">


                    <div class="form-group">
                        <label for="status" class="col-form-label">Status</label>
                        <select name="status" class="form-control">
                            <option value="active" {{ $sport->status == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ $sport->status == 'inactive' ? 'selected' : '' }}>Inactive
                            </option>
                        </select>
                        @error('status')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="my-2">

                        <div class="d-flex">
                            <strong>New Field Name:</strong>
                            <button type="button" class="btn btn-primary btn-sm mx-2" id="add-checklist-item">Add
                                Field</button>
                        </div>
                        <div id="checklist-items">

                        </div>
                        @foreach ($sport->fields as $key => $sportss)
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <div class="row">

                                        <p>{{ $key + 1 }} &nbsp;</p>
                                        <p>{{ $sportss->name }}</p>
                                        <a href="{{ route('field.delete', $sportss->id) }}" data-id="{{ $sportss->id }}"
                                            class="dltBtn " title="Remove This Field"  style="height:30px; width:30px;border-radius:50%"><i class="btn btn-sm fas fa-trash-alt text-danger"></i></a>
                                        {{-- <form method="POST" id="saad" action="{{route('field.delete',$sportss->id)}}">
                                            @csrf
                                            @method('delete')
                                                <button data-id="{{$sportss->id}}" class="mx-2 btn btn-danger btn-sm dltBtn"  style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" data-placement="bottom" title="Delete"><i class="fas fa-trash-alt"></i></button>
                                              </form> --}}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="">

                        <div class="d-flex">
                            <strong>New Stats Name:</strong>
                            <button type="button" class="btn btn-primary btn-sm mx-2" id="add-stat-item">Add
                                Stats</button>
                        </div>
                        <div id="stat-items">

                        </div>
                        @foreach ($sport->stats as $key => $stat)
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <div class="row">

                                        <p>{{ $key + 1 }} &nbsp;</p>
                                        <p>{{ $stat->name }}</p>
                                        <a href="{{ route('stats.delete', $stat->id) }}" data-id="{{ $stat->id }}"
                                            class="dltBtn " title="Remove This Field"  style="height:30px; width:30px;border-radius:50%"><i class="btn btn-sm fas fa-trash-alt text-danger"></i></a>
                                        {{-- <form method="POST" action="{{ route('stats.delete', $stat->id) }}">
                                            @csrf
                                            @method('delete')
                                            <button data-id="{{ $stat->id }}" class="btn mx-2 btn-danger btn-sm dltBtn"
                                                style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip"
                                                data-placement="bottom" title="Delete"><i
                                                    class="fas fa-trash-alt"></i></button>
                                        </form> --}}

                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="form-group mb-3">
                        <button class="btn btn-success my-3" type="submit">Submit</button>
                    </div>
            </form>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        // function delconfirm()
        // {

        //     swal({
        //               title: "Are you sure?",
        //               text: "Once deleted, you will not be able to recover this data!",
        //               icon: "warning",
        //               buttons: true,
        //               dangerMode: true,
        //           })
        //           .then((willDelete) => {
        //               if (willDelete) {
        //                 return true;
        //             } else {
        //                 swal("Your data is safe!");
        //                 return false;
        //               }
        //           });
        // }
        $('#add-checklist-item').click(function() {
            var newChecklistItem = $(
                '<div class="my-2 new-checklist-item">' +

                '<input type="text" class="form-control my-custom-class" name="fields[]" placeholder="Enter Field Name">' +


                '<div class="col-md-3 my-1">' +
                '<button type="button" class="btn btn-danger remove-checklist-item">Remove</button>' +

                '</div>' +
                '</div>'
            );

            $('#checklist-items').append(newChecklistItem);
        });

        $(document).on('click', '.remove-checklist-item', function() {
            $(this).closest('.new-checklist-item').remove();
        });

        $('#add-stat-item').click(function() {
            var newstatItem = $(
                '<div class="my-2 new-stat-item">' +

                '<input type="text" class="form-control my-custom-class" name="stats[]" placeholder="Enter Field Name">' +


                '<div class="col-md-3 my-1">' +
                '<button type="button" class="btn btn-danger remove-stat-item">Remove</button>' +

                '</div>' +
                '</div>'
            );

            $('#stat-items').append(newstatItem);
        });

        $(document).on('click', '.remove-stat-item', function() {
            $(this).closest('.new-stat-item').remove();
        });
    </script>
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('.dltBtn').click(function(e) {
                e.preventDefault();
                var anchor = $(this);
                var dataID = anchor.data('id');
                //   var form=$(this).closest('form');
                //     var dataID=$(this).data('id');
                // alert(dataID);
                swal({
                        title: "Are you sure?",
                        text: "Once deleted, you will not be able to recover this data!",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            // form.submit();
                            window.location.href = anchor.attr('href');
                        } else {
                            swal("Your data is safe!");
                        }
                    });
            })
        })
    </script>
@endpush
