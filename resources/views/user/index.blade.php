@extends('user.layouts.master')

@section('main-content')
    <div class="container-fluid">
        @include('user.layouts.notification')
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        </div>


        <!-- Content Row -->

        <div class="row">

            <!-- Order -->
            <div class="col-xl-12 col-lg-12">
                <table class="table table-bordered" id="order-dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>S.N.</th>
                            <th>College</th>
                            <th>Sport</th>
                            <th>Coach</th>
                            <th>Action</th>

                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>S.N.</th>
                            <th>College</th>
                            <th>Sport</th>
                            <th>Coach</th>
                            <th>Action</th>

                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($player as $key => $teams)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $teams->team->colleges->title }}</td>
                                {{-- @dd($teams->team->colleges->title) --}}
                                <td>{{ $teams->team->sports->title }}</td>
                                <td>{{ $teams->team->csname->name }}</td>
                                <td>
                                    @if ($teams->status == 'pending')
                                        <!-- Show Accept Button -->
                                        <a href="{{ route('athelte.accept', ['id' => $teams->id]) }}"
                                            class="btn btn-success"
                                            onclick="return confirm('Are you sure you want to Accept this?')">
                                            <i class="fa fa-check"></i> Accept
                                        </a>
                                        <!-- Show Decline Button -->
                                        <a href="{{ route('athelte.decline', ['id' => $teams->id]) }}"
                                            class="btn btn-danger"
                                            onclick="return confirm('Are you sure you want to Decline this?')">
                                            <i class="fa fa-times"></i> Decline
                                        </a>

                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>

    </div>
@endsection
