@extends('frontend.layouts.master')
@section('title','Product Create')

@section('content')
<style>
    .bootstrap-tagsinput {
	margin: 0;
	width: 100%;
	padding: 0.5rem 0.75rem 0;
	font-size: 1rem;
  line-height: 1.25;
	transition: border-color 0.15s ease-in-out;
	
	&.has-focus {
    background-color: #fff;
    border-color: #5cb3fd;
	}
	
	.label-info {
		display: inline-block;
		background-color: #636c72;
		padding: 0 .4em .15em;
		border-radius: .25rem;
		margin-bottom: 0.4em;
	}
	
	input {
		margin-bottom: 0.5em;
	}
}

.bootstrap-tagsinput .tag [data-role="remove"]:after {
	content: '\00d7';
}
</style>
<link rel="stylesheet" href="{{asset('backend/summernote/summernote.min.css')}}">


<section class="dashboard">
        <h2 class="Shopping-heading">Create Product</h2>
        <div class="container">
            <div class="row">
                @include('vendor.layouts.sidebar')
                <div class="col-md-8 p-0">
                    <div class="dash-div1">
                        <h2 class="dashboard-txt1">Create Product</h2>
                    </div>
                    <div id="Products" class="tabcontent" style="display: block;">
                        <form method="post" action="{{route('vproduct.store')}}">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label for="inputTitle" class="col-form-label">Title <span class="text-danger">*</span></label>
                                <input  type="text" name="user_id" value="{{auth()->user()->id}}" hidden>
                                <input type="text" name="title" placeholder="Enter title" id="title" value="{{old('title')}}" class="form-control">
                                @error('title')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="description" class="col-form-label">Description</label>
                                <textarea class="form-control" id="description" name="description">{{old('description')}}</textarea>
                                @error('description')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>


                            <div class="form-group">
                                <label for="is_featured">Is Featured <b>($5 will be charged)</b></label><br>
                                <input type="checkbox" name='is_featured' id='is_featured' value='1' checked> Yes                        
                            </div>
                            {{-- {{$categories}} --}}

                            <div class="form-group">
                                <label for="cat_id">Category <span class="text-danger">*</span></label>
                                <select name="cat_id" id="cat_id" class="form-control">
                                    <option value="">--Select any category--</option>
                                    @foreach($categories as $key=>$cat_data)
                                        <option value='{{$cat_data->id}}'>{{$cat_data->title}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group d-none" id="child_cat_div">
                                <label for="child_cat_id">Sub Category</label>
                                <select name="child_cat_id" id="child_cat_id" class="form-control">
                                    <option value="">--Select any category--</option>
                                    {{-- @foreach($parent_cats as $key=>$parent_cat)
                                        <option value='{{$parent_cat->id}}'>{{$parent_cat->title}}</option>
                                    @endforeach --}}
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="price" class="col-form-label">Price <span class="text-danger">*</span></label>
                                <input id="price" type="number" name="price" placeholder="Enter price"  value="{{old('price')}}" class="form-control">
                                @error('price')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            

                            <div class="form-group">
                                <label for="brand_id">Brand</label>
                                {{-- {{$brands}} --}}
                                <input id="" type="text" name="brand" placeholder="Enter Brand" required value="{{old('brand')}}" class="form-control">
                                @error('brand')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="condition">Condition</label>
                                <select name="condition" required="" class="form-control">
                                    <option value="">--Select Condition--</option>
                                    <option value="new">New</option>
									<option value="Used - Like New">Used - Like New</option>
                                    <option value="Used – Good">Used – Good</option>
									<option value="Used – Fair">Used – Fair</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="tags">Size</label>
                                <input name="size[]" id="size" data-role="tagsinput" class="form-control">
                                <span>Separate keywords with a comma, space bar, or enter key</span>
                            </div>
                            
                            <div class="form-group">
                                <label for="tags">Color</label>
                                <input name="color[]" id="color" data-role="tagsinput" class="form-control">
                                <span>Separate keywords with a comma, space bar, or enter key</span>
                            </div>

                            

                            <div class="form-group">
                                <label for="inputPhoto" class="col-form-label">Photo <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-btn">
                                        <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                                        <i class="fa fa-picture-o"></i> Choose
                                        </a>
                                    </span>
                                    <input id="thumbnail" class="form-control" readonly style="margin-right: 70px;" placeholder="Choose Photo" name="photo" value="{{old('photo')}}">
                                </div>
                                <div id="holder" style="margin-top:15px;max-height:100px;"></div>
                                @error('photo')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="tags">Tag</label>
                                <select name="tags[]" multiple  data-live-search="true" class="form-control selectpicker">
                                    <option value="">--Select any tag--</option>
                                    @foreach($tags as $key=>$data)
                                        <option value='{{$data->title}}'>{{$data->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label for="status" class="col-form-label">Status <span class="text-danger">*</span></label>
                                <select name="status" class="form-control">
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                                @error('status')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <button class="btn btn-success" type="submit">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </section>

    
@endsection