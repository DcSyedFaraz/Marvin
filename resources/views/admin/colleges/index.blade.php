@extends(Auth::user()->hasRole('admin') ? 'admin.layouts.master' : 'coach.layouts.master')

@section('main-content')
 <!-- DataTales Example -->
 <div class="card shadow mb-4">
     <div class="row">
         <div class="col-md-12">
         </div>
     </div>
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary float-left">Colleges List</h6>
      @if (auth()->user()->hasRole('admin'))

      <a href="{{route('college.create')}}" class="btn btn-primary btn-sm float-right" data-toggle="tooltip" data-placement="bottom" title="Add User"><i class="fas fa-plus"></i> Add College</a>
      @endif
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="example1" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>S.N.</th>
              <th>Name</th>
              <th>Predominant Degree</th>
              <th>Fields Of Study</th>
              <th>Photo</th>
              <th>Social Links</th>
              <th>Status</th>
              @if (auth()->user()->hasRole('admin'))

              <th>Action</th>
              @endif
            </tr>
          </thead>
          <tfoot>
            <tr>
                <th>S.N.</th>
                <th>Name</th>
                <th>Predominant Degree</th>
                <th>Fields Of Study</th>
                <th>Photo</th>
                <th>Social Links</th>
                <th>Status</th>
                @if (auth()->user()->hasRole('admin'))

                <th>Action</th>
                @endif
              </tr>
          </tfoot>
          <tbody>
          @foreach($colleges as $college)
                <tr>
                    <td>{{$college->id}}</td>
                    <td>{{$college->title}}</td>
                    <td>{{$college->predominant_degree}}</td>
                    <td>{{$college->fields_of_study}}</td>
                    <td>
                        @if($college->photo)
                            <img src="{{$college->photo}}" class="img-fluid rounded-circle" style="max-width:50px" alt="{{$college->photo}}">
                        @else
                            <img src="{{asset('backend/img/avatar.png')}}" class="img-fluid rounded-circle" style="max-width:50px" alt="avatar.png">
                        @endif
                    </td>
                    <td>
                      <a href="{{$college->instagream}}" class="btn btn-danger btn-sm float-left mr-1" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="instagram url" data-placement="bottom"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                      <a href="{{$college->twitter}}" class="btn btn-info btn-sm float-left mr-1" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="twitter url" data-placement="bottom"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                      <a href="{{($college->facebook)}}" class="btn btn-primary btn-sm float-left mr-1" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="facebook url" data-placement="bottom"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                    </td>
                    <td>
                        @if($college->status=='active')
                            <span class="badge badge-success">{{$college->status}}</span>
                        @else
                            <span class="badge badge-warning">{{$college->status}}</span>
                        @endif
                    </td>
                    @if (auth()->user()->hasRole('admin'))

                    <td class="d-flex">
                        <a href="{{route('college.edit',$college->id)}}" class="btn btn-primary btn-sm float-left mr-1" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="edit" data-placement="bottom"><i class="fas fa-edit"></i></a>
                        <a href="{{route('adminCoach',$college->id)}}" class="btn btn-info btn-sm float-left mr-1" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="assign coach" data-placement="bottom"><i class="fas fa-check"></i>
                        </a>
                    <form method="POST" action="{{route('college.destroy',[$college->id])}}">
                      @csrf
                      @method('delete')
                          <button class="btn btn-danger btn-sm dltBtn" data-id="{{$college->id}}" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" data-placement="bottom" title="Delete" onclick="return confirm('Are you sure you want to delete this college?')"><i class="fas fa-trash-alt"></i></button>
                        </form>
                    </td>
                    @endif
                </tr>
            @endforeach
          </tbody>
        </table>
        <span style="float:right"></span>
      </div>
    </div>
</div>
@endsection

@push('styles')
  <link href="{{asset('backend/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
  
@endpush

@push('scripts')

  <!-- Page level plugins -->
  <script src="{{asset('backend/vendor/datatables/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('backend/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="{{asset('backend/js/demo/datatables-demo.js')}}"></script>
  <script>

      $('#user-dataTable').DataTable( {
            "columnDefs":[
                {
                    "orderable":false,
                    "targets":[6,7]
                }
            ]
        } );

        // Sweet alert

        function deleteData(id){

        }
  </script>
  <script>
      $(document).ready(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
          $('.dltBtn').click(function(e){
            var form=$(this).closest('form');
              var dataID=$(this).data('id');
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
