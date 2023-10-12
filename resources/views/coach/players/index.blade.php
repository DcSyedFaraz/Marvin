@extends('coach.layouts.master')

@section('main-content')
<div class="container-fluid">
    @include('coach.layouts.notification')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>

    <!-- Content Row -->
    <div class="row">
        <!-- Player List -->
        <div class="col-xl-12 col-lg-12">
            <table class="table table-striped" id="example" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th scope="col">S.N.</th>
                        <th scope="col">Player Name</th>
                        <th scope="col">Assigned Sports</th>
                        <th scope="col">Status</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th scope="col">S.N.</th>
                        <th scope="col">Player Name</th>
                        <th scope="col">Assigned Sports</th>
                        <th scope="col">Status</th>
                        <th scope="col">Actions</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach ($players as $key => $player)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $player->name ?? '' }}</td>
                        <td>{{ $player->assigned_sport ?? '' }}</td>
                        <td>{{ $player->status ?? '' }}</td>
                        <td class="d-flex">
                            <a href="{{ route('manage-players.edit', $player->id) }}" class="btn btn-primary btn-sm">Manage Player</a>
                            <form action="{{ route('manage-players.destroy', $player->id) }}" method="POST">
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
@endsection

