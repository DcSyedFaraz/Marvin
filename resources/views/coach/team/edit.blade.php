{{-- @extends('admin.layouts.master') --}}
@extends(Auth::user()->hasRole('coach') ? 'coach.layouts.master' : 'admin.layouts.master')


@section('main-content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Team</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Team</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <section class="content">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <form method="post" action="{{ route('team.update', $team->id) }}">
                                    @csrf
                                    @method('put')
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <strong>Name:</strong>
                                                <input name="name" placeholder="Name" class="form-control" required
                                                    value="{{ old('name', $team->name ?? '') }}">
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <strong>Description:</strong>
                                                <input name="description" placeholder="Description" class="form-control"
                                                    required value="{{ old('description', $team->description ?? '') }}">
                                            </div>
                                        </div>


                                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                            <button type="submit" class="btn btn-success">Update Info</button>
                                        </div>
                                    </div>
                                </form>
                                <div class="row mt-4">
                                    <div class="col-md-12">
                                        <h2>Players in {{ $team->name }}</h2>
                                        <button type="button" class="btn btn-success" data-toggle="modal"
                                            data-target="#exampleModal">
                                            Add Player
                                        </button>
                                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Add Player
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('player.store') }}" method="post">
                                                            @csrf
                                                            <div class="form-group">
                                                                <input type="hidden" value="{{ $team->id }}"
                                                                    name="team_id">
                                                                <label for="player">Add Player:</label>
                                                                <select class="form-control" id="player" name="user_id"
                                                                    required>
                                                                    <option value="" hidden disabled selected>Select
                                                                        Player</option>
                                                                    @foreach ($playersToAdd as $playersTo)
                                                                        <option value="{{ $playersTo->id }}">
                                                                            {{ $playersTo->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                    </div>
                                                    <div class="modal-footer">

                                                        <button type="submit" class="btn btn-primary">Save
                                                            changes</button>
                                                        <a href="">

                                                        </a>
                                                    </div>
                                                    </form>
                                                </div>

                                            </div>
                                        </div>

                                        <table class="table" id="example1">
                                            <thead>
                                                <tr>
                                                    <th>Player Name</th>
                                                    <th>Status</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($players as $player)
                                                    <tr>
                                                        {{-- @dd($player->users) --}}
                                                        <td>{{ $player->users->name }}
                                                            {{-- <a href="{{ route('manage-players.edit', $player->users->id) }}">{{ $player->users->name }}</a> --}}
                                                        </td>
                                                        <td> @switch($player->status)
                                                                @case('pending')
                                                                    <span class="badge bg-warning">Pending</span>
                                                                @break

                                                                @case('accepted')
                                                                    <span class="badge bg-success">Accepted</span>
                                                                @break

                                                                @case('declined')
                                                                    <span class="badge bg-danger">Declined</span>
                                                                @break

                                                                @default
                                                                    {{ $player->status }}
                                                            @endswitch
                                                        </td>
                                                        <td class="d-flex">
                                                            @if ($player->status == 'declined')
                                                                <a href="{{ route('invite.resend', $player->id) }}"
                                                                    title="Resend Invitation"
                                                                    class="btn btn-primary mx-1" onclick="return confirm('Are you sure you want to Resend Invitation?')"><i
                                                                        class="fas fa-paper-plane"></i></a>
                                                            @endif
                                                            <form method="POST"
                                                                action="{{ route('player.destroy', $player->id) }}">
                                                                @csrf
                                                                @method('DELETE')
                                                                <input type="hidden" name="player_id"
                                                                    value="{{ $player->id }}">
                                                                <button type="submit" class="btn btn-danger" title="Remove athlete"
                                                                    onclick="return confirm('Are you sure you want to Remove this?')"><i
                                                                    class="fas fa-trash"></i></button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>
    </div>
    <script>
        $('.select2').select2()

        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })

        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": []
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>

    <script type="text/javascript">
        var APP_URL = {!! json_encode(url('/')) !!}
    </script>
    <style>
        .form-check-input {
            border-radius: 0 !important;
            height: 20px;
            width: 20px;
            margin: 0;
        }

        .form-group strong {
            margin: 0 0 10px;
            width: fit-content;
            display: block;
        }

        .my-txt-box {
            padding: 0 0 10px;
        }

        .my-label {
            padding-left: 30px;
            text-transform: capitalize;
        }
    </style>
@endsection
