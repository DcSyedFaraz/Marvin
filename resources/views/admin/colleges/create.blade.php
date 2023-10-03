@extends('admin.layouts.master')

@section('main-content')
    <div class="card">
        @if (session('success'))
            <div class="alert alert-success alert-dismissable fade show">
                <button class="close" data-dismiss="alert" aria-label="Close">×</button>
                {{ session('success') }}
            </div>
        @endif


        @if (session('error'))
            <div class="alert alert-danger alert-dismissable fade show">
                <button class="close" data-dismiss="alert" aria-label="Close">×</button>
                {{ session('error') }}
            </div>
        @endif @include('admin.layouts.notification')

        <h5 class="card-header">Add College</h5>
        <div class="card-body">
            <form method="post" action="{{ route('college.store') }}">
                {{ csrf_field() }}
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="inputTitle" class="col-form-label">Title</label>
                        <input id="inputTitle" type="text" name="title" placeholder="Enter Title"
                            value="{{ old('title') }}" class="form-control">
                        @error('title')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-6">
                        <label for="inputEmail" class="col-form-label">Type</label>
                        <input id="inputTitle" type="text" id="location-input" name="type" placeholder="Enter Type"
                            value="{{ old('type') }}" class="form-control">
                        @error('type')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="inputTitle" class="col-form-label">Country</label>
                        <input id="inputTitle" type="text" name="country" placeholder="Enter Country"
                            value="{{ old('country') }}" class="form-control">
                        @error('country')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-6">
                        <label for="inputEmail" class="col-form-label">Location</label>
                        <input id="inputTitle" type="text" id="location-input" name="location"
                            placeholder="Enter Location" value="{{ old('location') }}" class="form-control">
                        @error('location')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-3">
                        <label for="inputEmail" class="col-form-label">Website URL</label>
                        <input id="inputTitle" type="text" id="location-input" name="website" placeholder="Enter Website"
                            value="{{ old('website') }}" class="form-control">
                        @error('website')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group col-md-3">
                        <label for="inputEmail" class="col-form-label">Instagram URL</label>
                        <input id="inputTitle" type="text" id="location-input" name="instagram"
                            placeholder="Enter Instagram" value="{{ old('instagram') }}" class="form-control">
                        @error('instagram')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-3">
                        <label for="inputEmail" class="col-form-label">Facebook URL</label>
                        <input id="inputTitle" type="text" id="location-input" name="facebook"
                            placeholder="Enter Facebook" value="{{ old('facebook') }}" class="form-control">
                        @error('facebook')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-3">
                        <label for="inputEmail" class="col-form-label">Twitter URL</label>
                        <input id="inputTitle" type="text" id="location-input" name="twitter" placeholder="Enter Twitter"
                            value="{{ old('twitter') }}" class="form-control">
                        @error('twitter')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group col-md-12">
                        <label for="inputPhoto" class="col-form-label">Photo</label>
                        <div class="input-group">
                            <span class="input-group-btn">
                                <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                                    <i class="fa fa-picture-o"></i> Choose
                                </a>
                            </span>
                            <input id="thumbnail" class="form-control" type="text" name="photo"
                                value="{{ old('photo') }}">
                        </div>
                        <div id="holder" style="margin-top:15px;max-height:100px;"></div>
                        @error('photo')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-md-12">
                        <label class="col-form-label">Sports Offered</label>
                        <div class="row">
                            @foreach ($sports as $sport)
                                <div class="form-check col-sm-3">
                                    <input class="form-check-input" type="checkbox" name="sports[]"
                                        value="{{ $sport->id }}">
                                    <label class="form-check-label">{{ $sport->title }}</label>
                                </div>
                            @endforeach
                        </div>
                        @error('sports')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group col-md-12">
                    <label for="inputEmail" class="col-form-label">Locale</label>
                    <input id="inputTitle" type="text" id="location-input" name="locale" placeholder="Enter Locale"
                        value="{{ old('locale') }}" class="form-control">
                    @error('locale')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group col-md-12">
                    <label for="inputEmail" class="col-form-label">Level</label>
                    <input id="inputTitle" type="text" id="location-input" name="level" placeholder="Enter level"
                        value="{{ old('level') }}" class="form-control">
                    @error('level')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group col-md-12">
                    <label for="inputEmail" class="col-form-label">Predominant Degree</label>
                    <input id="inputTitle" type="text" id="location-input" name="predominant_degree"
                        placeholder="Enter Predominant Degree" value="{{ old('predominant_degree') }}"
                        class="form-control">
                    @error('predominant_degree')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group col-md-12">
                    <label for="inputEmail" class="col-form-label">Fields Of Study</label>
                    <input id="inputTitle" type="text" id="location-input" name="fields_of_study"
                        placeholder="Enter Fields Of Study" value="{{ old('fields_of_study') }}" class="form-control">
                    @error('fields_of_study')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group col-md-12">
                    <label for="status" class="col-form-label">Status</label>
                    <select name="status" class="form-control">
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                    @error('status')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
        </div>

        <div class="form-group mb-3">
            <button type="reset" class="btn btn-warning">Reset</button>
            <button class="btn btn-success" type="submit">Submit</button>
        </div>
        </form>
    </div>
    </div>
@endsection
@push('scripts')
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>


    <script>
        $('#lfm').filemanager('image');
    </script>
@endpush
