@extends('user.layouts.master')
@section('main-content')
<style>
    div#example1_filter{
        display: none;
    }
</style>
    <div class="content-wrapper">
        <div class="container mt-5">
            <h2>College Search</h2>
            <form action="{{ route('searchcollege.search') }}" method="GET">
                <div class="row">

                    <div class="form-group col-5">
                        <label for="search">Name:</label>
                        <input type="text" name="name" id="" class="form-control" value="{{old('name')}}">
                    </div>
                    <div class="form-group col-5">
                        <label for="sports">Select Sports:</label>
                        <select class="form-control" id="sports" name="sports">
                            <option value="">Select sport</option>
                            @foreach ($sport as $sports)
                                <option value="{{ $sports->id }}">
                                    {{ $sports->title }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mt-4 col-2">

                        <button type="submit" class="btn btn-primary">Search</button>
                    </div>
                </div>

            </form>

            <!-- Display search results below this line -->
            @if (isset($college) && count($college) > 0)
                {{-- <h3>Search Results:</h3> --}}
                <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-bordered" id="example1" width="100%" cellspacing="0">
                        <thead>
                          <tr>
                            <th>S.N.</th>
                            <th>Name</th>
                            <th>Sports</th>
                            <th>Status</th>
                            <th>Action</th>
                          </tr>
                        </thead>

                        <tbody>

                            @foreach($college as $key=> $colleges)
                              <tr>
                                  <td>{{$key+1}}</td>
                                  <td>{{$colleges->title}}</td>
                                  <td>
                                    @foreach ($colleges->sports as $sport)
                                    <span class="badge badge-success">
                                     {{ $sport->title }}
                                     </span> @if (!$loop->last), @endif
                                 @endforeach
                                  </td>
                                  <td >
                                      @if($colleges->status=='active')
                                          <span class="badge badge-success">{{$colleges->status}}</span>
                                      @else
                                          <span class="badge badge-warning">{{$colleges->status}}</span>
                                      @endif
                                  </td>

                                  <td>
                                      <a href="{{route('searchcollege.show',$colleges->id)}}" class="btn btn-primary btn-sm " style="height:30px; width:32px;border-radius:50%" data-toggle="tooltip" title="show profile" ><i class="fas fa-eye"></i></a>
                                      <a href="{{route('showcollegesCoach.show',$colleges->id)}}" class="btn btn-info btn-sm " style="height:30px; width:32px;border-radius:50%" data-toggle="tooltip" title="show Coaches info" ><i class="fas fa-info"></i></a>
                                      <a href="{{$colleges->camp ?? '#'}}" target="blank" class="btn btn-warning btn-sm " style="height:30px; width:32px;border-radius:50%" data-toggle="tooltip" title="show camp info" ><i class="fas fa-info-circle"></i></a>
                                      <a href="{{$colleges->question ?? '#'}}" target="blank" class="btn btn-secondary btn-sm " style="height:30px; width:32px;border-radius:50%" data-toggle="tooltip" title="show Questionaire" ><i class="fas fa-question-circle"></i></a>

                                  </td>
                              </tr>
                            @endforeach

                        </tbody>
                      </table>
                    </div>
                  </div>
                {{-- <ul>
                    @foreach ($college as $colleges)
                        <li><a href="{{route('searchcollege.show',$colleges->id)}}" title="show profile">{{ $colleges->title }}</a>
                            <ul>

                                @foreach ($colleges->sports as $names)
                                    <li>{{ $names->title }}</li>
                                @endforeach
                            </ul>
                        </li>
                    @endforeach
                </ul> --}}
                @else
                <p>No Record Found</p>
            @endif
        </div>
    </div>
@endsection
