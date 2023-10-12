@extends('coach.layouts.master')

@section('main-content')
    <div class="container-fluid">
        
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        </div>



        <!-- Content Row -->

        <div class="row">

            <!-- Order -->
            <div class="col-xl-12 col-lg-12">
                <table class="table table-striped" id="order-dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th scope="col">S.N.</th>
                            <th scope="col">College Names</th>
                            <th scope="col">Level
                            </th>
                            <th scope="col">Assigned Sports</th>
                            <th scope="col">Status</th>

                            <th scope="col">Actions</th>

                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th scope="col">S.N.</th>
                            <th scope="col">College Names</th>
                            <th scope="col">Level</th>
                            <th scope="col">Assigned Sports</th>
                            <th scope="col">Status</th>

                            <th scope="col">Actions</th>

                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($college as $key => $collegess)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>
                                    <span class="">

                                        {{ $collegess->colleges->title }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge badge-primary">

                                        {{ $collegess->colleges->level }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge badge-secondary">

                                        {{ $collegess->sports->title }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge badge-success">

                                        {{ $collegess->colleges->status }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('coach.team',$collegess->id) }}" class="btn btn-primary btn-sm">Manage Team</a>
                                </td>

                            </tr>
                        @endforeach

                    </tbody>
                </table>

            </div>
        </div>

    </div>
@endsection
