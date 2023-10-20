@extends('coach.layouts.master')

@section('main-content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Atheletes</h1>
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
                        {{-- @dd($player->sports_name) --}}
                        <td>{{ $player->sport_name->title ?? '' }}</td>
                        <td>{{ $player->status ?? '' }}</td>
                        <td class="d-flex">
                            @if ($results->contains('user_id', $player->id))
                            <a href="{{ route('index.team', $player->id) }}" class="btn btn-primary btn-sm">Manage Player</a>
                            {{-- <form action="{{ route('manage-players.destroy', $player->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="mx-2 btn btn-danger btn-sm"
                                    onclick="return confirm('Are you sure you want to Delete this?')">Delete</button>
                            </form> --}}
                            @endif
                            <a href="{{ route('manage-players.show', $player->id) }}" title="show profile" class="mx-2 btn btn-success btn-sm"><i class="fas fa-user-circle"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

