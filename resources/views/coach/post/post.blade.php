@extends(Auth::user()->hasRole('admin') ? 'admin.layouts.master' : 'coach.layouts.master')



@section('main-content')
    <style>
        body {
            background-color: #eee !important
        }

        .time {
            font-size: 10px !important
        }

        .socials i {
            margin-right: 14px;
            font-size: 17px;
            color: #d2c8c8;
            cursor: pointer
        }

        .feed-image img {
            width: 100%;
            height: auto
        }
    </style>
    <div class="content-wrapper">
        <div class="container mt-4 mb-5">
            <div class="d-flex justify-content-center row">
                <div class="col-md-8">
                    <div class="feed p-2 ">
                        <div class="d-flex flex-row justify-content-between align-items-center p-2 bg-white border row">
                            <div class="feed-text px-2 col-11">
                                <form action="{{Auth::user()->hasRole('admin') ? route('post.store') : route('posts.store')  }}" method="post">
                                    @csrf
                                    <input type="text" class="text-black-50 mt-2 form-control w-full" name="content"
                                        placeholder="What's on your mind">
                                    {{-- <h6 class="text-black-50 mt-2">What's on your mind</h6> --}}
                            </div>
                            <div class="feed-icon px-2 col-1"> <button type="submit" class="btn border-primary"><i
                                        class="fa fa-paper-plane text-black-50"></i></button></div>
                        </div>
                        </form>
                        @foreach ($post as $posts )

                        <div class="bg-white border mt-2">
                            <div>
                                <div class="d-flex flex-row justify-content-between align-items-center p-2 border-bottom">
                                    <div class="d-flex flex-row align-items-center feed-text px-2">
                                        @if (isset($posts->usname->userdetail->coaches_photo))

                                        <img
                                            class="rounded" src="{{asset('storage/coaches_photos/' . $posts->usname->userdetail->coaches_photo)}}" width="45">
                                        @endif
                                        <div class="d-flex flex-column flex-wrap ml-2"><span
                                                class="font-weight-bold">{{$posts->usname->name}}</span><span
                                                class="text-black-50 time font-weight-bold">{{ $posts->created_at->diffForHumans() }}</span></div>
                                    </div>
                                    @if ($posts->user_id == auth()->user()->id || auth()->user()->hasRole('admin'))
                                    <form method="POST" action="{{Auth::user()->hasRole('admin') ? route('post.destroy',[$posts->id]) : route('posts.destroy',[$posts->id])}}">
                                        @csrf
                                        @method('delete')
                                            <button class="btn btn-danger btn-sm feed-icon px-2" onclick="return confirm('Are You Sure Want To Delete This Post?')" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" data-placement="bottom" title="Delete"><i class="fas fa-trash-alt"></i></button>
                                          </form>
                                    {{-- <a href="{{route()}}" class="feed-icon px-2"><i class="fa fa-trash text-danger"></i></a> --}}
                                    @endif
                                </div>
                            </div>
                            <div class="p-2 px-3"><span>{{$posts->content}}</span></div>
                            {{-- <div class="d-flex justify-content-end socials p-2 py-3"><i class="fa fa-thumbs-up"></i><i class="fa fa-comments-o"></i><i class="fa fa-share"></i></div> --}}
                        </div>
                        @endforeach
                        {{-- <div class="bg-white border mt-2">
                            <div>
                                <div class="d-flex flex-row justify-content-between align-items-center p-2 border-bottom">
                                    <div class="d-flex flex-row align-items-center feed-text px-2"><img class="rounded-circle" src="https://i.imgur.com/aoKusnD.jpg" width="45">
                                        <div class="d-flex flex-column flex-wrap ml-2"><span class="font-weight-bold">Thomson ben</span><span class="text-black-50 time">40 minutes ago</span></div>
                                    </div>
                                    <div class="feed-icon px-2"><i class="fa fa-ellipsis-v text-black-50"></i></div>
                                </div>
                            </div>
                            <div class="feed-image p-2 px-3"><img class="img-fluid img-responsive" src="https://i.imgur.com/aoKusnD.jpg"></div>
                            <div class="d-flex justify-content-end socials p-2 py-3"><i class="fa fa-thumbs-up"></i><i class="fa fa-comments-o"></i><i class="fa fa-share"></i></div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
