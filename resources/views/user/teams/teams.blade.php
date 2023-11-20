@extends('user.layouts.master')


@section('main-content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->



        <div class="container">


            <!-- Display Teams -->
            <div class="row mt-4">
                <div class="col-md-12">
                    <h2>Teams</h2>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Team Name</th>
                                <th>College</th>
                                <th>Sport</th>
                                <th>Created By</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($teams as $team)
                                <tr>
                                    <td>{{ $team->name }}</td>
                                    {{-- @dd($team->sports) --}}
                                    <td>{{ $team->colleges->title }}</td>
                                    <td ><span class="badge badge-success">{{ $team->sports->title }}</span></td>
                                    <td>{{ $team->csname->name }}</td>
                                    <td class="d-flex">
                                        <a href="#" class="btn btn-primary "><i class="fas fa-info-circle"></i></a>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


        <!-- /.content -->
    </div>
@endsection
