<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Category;
use App\Models\PostTag;
use App\Models\VeriantColor;
use App\Models\VeriantSize;
use Auth;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::where('user_id',Auth::user()->id)->paginate(10);
        // return $products;
        return view('vendor.product.index')->with('products',$products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $brand=Brand::get();
        $category=Category::where('is_parent',1)->get();
        // return $category;
        $tags=PostTag::get();
        return view('vendor.product.create')->with('tags',$tags)->with('categories',$category)->with('brands',$brand);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request->all();
        $this->validate($request,[
            'title'=>'string|required',
            'description'=>'string|nullable',
            'photo'=>'string|required',
            'size'=>'nullable',
            'color'=>'nullable',
            'cat_id'=>'required|exists:categories,id',
            'brand'=>'required',
            'is_featured'=>'sometimes|in:1',
            'status'=>'required|in:active,inactive',
            'condition'=>'required',
            'price'=>'required|numeric',
        ]); 

        $data=$request->all();
        $tags = $request->input('tags');
        if($tags){
            $tagss =implode(',',$tags);
        }
        else{
            $tags = '';
        }

         // Size
         $size = $request->input('size');
         if($size){
             $size=implode(',',$size);
         }
         else{
             $size='';
         }
         
         // Color
         $color = $request->input('color');
         if($color){
             $color=implode(',',$color);
         }
         else{
             $color='';
         }

        $slug = \Str::slug($request->title);
        $count = Product::where('slug',$slug)->count();
        if($count>0){
            $slug=$slug.'-'.date('ymdis').'-'.rand(0,999);
        }
        
        $data['slug']=$slug;
        $data['is_featured']=$request->input('is_featured',0);
        
        $dataa = [
            'user_id' => $request->user_id,
            'title' => $request->title,
            'slug' => $slug,
            'description' => $request->description,
            'is_featured' => $request->is_featured,
            'cat_id' => $request->cat_id,
            'price' => $request->price,
            'photo' => $request->photo,
            'brand' => $request->brand,
            'condition' => $request->condition,
            'size' => $size,
            'color' => $color,
            'tags' => $tagss,
            'status' => $request->status,
        ];
        // return $data;
        
        $status = Product::create($dataa);

       


        if($status){
            request()->session()->flash('success','Product Successfully added');
        }
        else{
            request()->session()->flash('error','Please try again!!');
        }
        return redirect()->back();

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $id = $request->id;
        $data['products'] = Product::where('user_id',Auth::user()->id)->paginate(10);
        $data['brandss'] = Brand::get();
        
        $data['editproduct'] = Product::findOrFail($id);
        $data['categories'] = Category::where('is_parent',1)->get();
        $data['items'] = Product::where('id',$id)->get();
        $data['tags'] = PostTag::get();
        // return $items;
        // return response()->json(['success'=>'Edit your product','data'=>$data]);
        return view('vendor.product.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product=Product::findOrFail($id);
        $this->validate($request,[
            'title'=>'string|required',
            'description'=>'string|nullable',
            'photo'=>'string|required',
            'size'=>'nullable',
            'cat_id'=>'required|exists:categories,id',
            'is_featured'=>'sometimes|in:1',
            'status'=>'required|in:active,inactive',
            'condition'=>'required',
            'brand'=>'required',
            'price'=>'required|numeric',
        ]);

        $data=$request->all();
        $tags = $request->input('tags');
        if($tags){
            $tagss =implode(',',$tags);
        }
        else{
            $data['tags']='';
        }
        
        $size = $request->input('size');
        if($size){
            $size =implode(',',$size);
        }
        else{
            $size = '';
        }
        
        $color = $request->input('color');
        if($color){
            $color =implode(',',$color);
        }
        else{
            $color = '';
        }

        $slug = \Str::slug($request->title);
        $count = Product::where('slug',$slug)->count();
        if($count>0){
            $slug=$slug.'-'.date('ymdis').'-'.rand(0,999);
        }

        // $data=$request->all();
        $dataa = [
            'user_id' => $request->user_id,
            'title' => $request->title,
            'slug' => $slug,
            'description' => $request->description,
            'is_featured' => $request->is_featured,
            'cat_id' => $request->cat_id,
            'price' => $request->price,
            'photo' => $request->photo,
            'brand' => $request->brand,
            'condition' => $request->condition,
            'size' => $size,
            'color' => $color,
            'tags' => $tagss,
            'status' => $request->status,
        ];
       
        $status=$product->fill($dataa)->save();

        
        if($status){
            request()->session()->flash('success','Product Successfully updated');
        }
        else{
            request()->session()->flash('error','Please try again!!');
        }
        // return redirect()->route('vproduct.index');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product=Product::findOrFail($id);
        $status=$product->delete();
        
        if($status){
            request()->session()->flash('success','Product successfully deleted');
        }
        else{
            request()->session()->flash('error','Error while deleting product');
        }
        return redirect()->route('vproduct.index');
        // return redirect()->back();
    }
}
