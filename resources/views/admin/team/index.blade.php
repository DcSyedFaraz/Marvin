@extends('admin.layouts.master')


@section('main-content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Team List</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Team List</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              {{-- <div class="card-header">
                <h3 class="card-title">Team List</h3>
              </div> --}}
              <!-- /.card-header -->
              {{-- <div class="card-header">

                <a class="btn btn-success" href="{{ route('teams.create') }}"> Create New Team</a>

                </div> --}}
              <div class="card-body table-responsive-xl">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>S.No</th>
                    <th>Team</th>
                    <th>College Name</th>
                    <th>Coach Name</th>
                    <th>Total players</th>
                    <th>Created at</th>
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
                      <td>{{ $role->name ?? '' }}</td>
                      <td>{{ $role->colleges->title ?? '' }}</td>
                      <td>{{ $role->csname->name ?? '' }}</td>
                      <td>{{ $role->player->count() }}</td>
                      <td>{{ $role->created_at->diffforhumans() }}</td>
                       <td class="d-flex">
                        <a class="btn btn-sm mx-1 btn-primary" href="{{ route('teams.edit',$role->id) }}">Edit</a>

                          <form action="{{ route('teams.destroy', $role->id) }}" method="POST"
                            class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm mx-1 btn-danger"
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
