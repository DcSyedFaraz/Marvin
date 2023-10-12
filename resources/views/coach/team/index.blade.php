@extends('coach.layouts.master')


@section('main-content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->



        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Create Team</div>

                        <div class="card-body">
                            <form method="POST" action="{{ route('team.store') }}">
                                @csrf

                                <div class="form-group">
                                    <label for="name">Team Name:</label>
                                    <input type="text" class="form-control" placeholder="Team Name" id="name" name="name" required>
                                </div>
                                <div class="form-group">
                                    <strong>Description:</strong>
                                    <input name="description" placeholder="Description" class="form-control" required >
                                </div>
                                <!-- Automatically assign the sport based on coach's sport -->
                                <input type="hidden" name="sports_id" value="{{ $coach->sports_id }}">

                                <!-- Coach field is hidden but assigned based on logged-in coach -->
                                <input type="hidden" name="colleges_id" value="{{ $coach->colleges_id }}">

                                <button type="submit" class="btn btn-primary">Create Team</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

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
                                <th>Players</th>
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
                                    <td>{{ $team->sports->title }}</td>
                                    <td>{{ $team->player->count() }}</td>
                                    <td>{{ $team->csname->name }}</td>
                                    <td class="d-flex">
                                        <a href="{{ route('team.edit', $team->id) }}" class="btn btn-primary btn-sm">Manage Team</a>
                                        <form action="{{ route('team.destroy', $team->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="mx-2 btn btn-danger btn-sm"
                                                onclick="return confirm('Are you sure you want to Delete this?')">Delete</button>
                                        </form>
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
