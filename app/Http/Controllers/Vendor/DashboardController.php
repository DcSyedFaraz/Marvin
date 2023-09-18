<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Category;
use App\Models\PostTag;
use Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $data['users'] = Auth::user();
        $data['products'] = Product::where('user_id',Auth::user()->id)->paginate(10);
        $data['brand'] = Brand::get();
        $data['categories'] = Category::where('is_parent',1)->get();
        // return $data['category'] ; 
        $data['tags'] = PostTag::get();
        return view('vendor.dashboard',$data);
    }
}
