@extends('coach.layouts.master')


@section('main-content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Teams</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Teams</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
     @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Team List</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-header">

                <a class="btn btn-success" href="{{ route('team.create') }}"> Create New Team</a>

                <!-- <a class="btn btn-success" href="{{ route('roles.create') }}"> Create New Role</a> -->
                </div>
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>S.No</th>
                    <th>Roles</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  @if($team)
                  @php
                  $id =1;
                  @endphp
                  @foreach($team as $key =>  $role)
                  <tr>
                      <td>{{ $key+1 }}</td>
                      <td>{{ $role->name }}</td>
                       <td>
                        <a class="btn btn-primary" href="{{ route('team.edit',$role->id) }}">Edit</a>

                          <form action="{{ route('team.destroy', $role->id) }}" method="POST"
                            class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"
                                onclick="return confirm('Are you sure you want to delete this Team?')">Delete</button>
                        </form>
                      </td>
			      </tr>
                  @endforeach
                  @endif
                  </tbody>
                  {{-- <tfoot>
                  <tr>
                    <th>S.No</th>
                    <th>Roles</th>
                    <th>Action</th>
                  </tr>
                  </tfoot> --}}
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

@endsection
