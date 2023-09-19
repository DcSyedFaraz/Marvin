<?php

namespace App\Http\Controllers;
use App\Models\Banner;
use App\Models\Product;
use App\Models\Category;
use App\Models\PostTag;
use App\Models\PostCategory;
use App\Models\Post;
use App\Models\Cart;
use App\Models\Brand;
use App\Models\ProductReview;
use App\Models\VendorReview;
use App\Models\ProductQA;
use App\Models\User;
use Auth;
use Session;
use Newsletter;
use DB;
use Hash;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
class FrontendController extends Controller
{

    public function index(Request $request)
    {
        return redirect()->route($request->user()->role);
    }

    public function home()
    {

        return view('frontend.index');
    }

    public function aboutUs()
    {
        return view('frontend.pages.about-us');
    }

    public function howtouse()
    {
        return view('frontend.pages.how-to-use');
    }

    public function commerce_policy()
    {
        return view('frontend.pages.commerce-policy');
    }

    public function dispute_policy()
    {
        return view('frontend.pages.dispute-policy');
    }

    public function fee_schedule()
    {
        return view('frontend.pages.fee-schedule');
    }

    public function postage_label_terms()
    {
        return view('frontend.pages.postage-label-terms');
    }

    public function faqs()
    {
        return view('frontend.pages.faqs');
    }

    // public function contact()
    // {
    //     return view('frontend.pages.contact');
    // }

    public function productDetail($slug)
    {
        $data['product_detail'] = Product::getProductBySlug($slug);
        $data['vendor'] = User::find($data['product_detail']->user_id);
        $data['qas'] = ProductQA::where('product_id',$data['product_detail']->id)->get();
        $data['product_review']= ProductReview::where('product_id',$data['product_detail']->id)->get();
        $data['vendor_review']= VendorReview::with('user')->where('vendor_id',$data['product_detail']->user_id)->get();
        // dd($product_detail);
        return view('frontend.pages.product_detail',$data);
    }

    public function terms()
    {
        return view('frontend.pages.terms');
    }

    public function privacy_policy()
    {
        return view('frontend.pages.privacy-policy');
    }

    public function product_review_fetch($offset,$id)
	{
		$products = ProductReview::with('user_info')->where('product_id',$id)->skip($offset)->take(1)->get();
		return response()->json($products);
	}

    public function productGrids(){
        $products=Product::query();

        if(!empty($_GET['category'])){
            $slug=explode(',',$_GET['category']);
            // dd($slug);
            $cat_ids=Category::select('id')->whereIn('slug',$slug)->pluck('id')->toArray();
            // dd($cat_ids);
            $products->whereIn('cat_id',$cat_ids);
            // return $products;
        }
        if(!empty($_GET['brand'])){
            $slugs=explode(',',$_GET['brand']);
            $brand_ids=Brand::select('id')->whereIn('slug',$slugs)->pluck('id')->toArray();
            return $brand_ids;
            $products->whereIn('brand_id',$brand_ids);
        }
        if(!empty($_GET['sortBy'])){
            if($_GET['sortBy']=='title'){
                $products=$products->where('status','active')->orderBy('title','ASC');
            }
            if($_GET['sortBy']=='price'){
                $products=$products->orderBy('price','ASC');
            }
        }

        if(!empty($_GET['price'])){
            $price=explode('-',$_GET['price']);
            // return $price;
            // if(isset($price[0]) && is_numeric($price[0])) $price[0]=floor(Helper::base_amount($price[0]));
            // if(isset($price[1]) && is_numeric($price[1])) $price[1]=ceil(Helper::base_amount($price[1]));

            $products->whereBetween('price',$price);
        }

        $recent_products=Product::where('status','active')->orderBy('id','DESC')->limit(3)->get();
        // Sort by number
        if(!empty($_GET['show'])){
            $products=$products->where('status','active')->paginate($_GET['show']);
        }
        else{
            $products=$products->where('status','active')->paginate(9);
        }
        // Sort by name , price, category


        return view('frontend.pages.product-grids')->with('products',$products)->with('recent_products',$recent_products);
    }
    // public function productLists(){
    //     $products=Product::query();

    //     if(!empty($_GET['category'])){
    //         $slug=explode(',',$_GET['category']);
    //         // dd($slug);
    //         $cat_ids=Category::select('id')->whereIn('slug',$slug)->pluck('id')->toArray();
    //         // dd($cat_ids);
    //         $products->whereIn('cat_id',$cat_ids)->paginate;
    //         // return $products;
    //     }
    //     if(!empty($_GET['brand'])){
    //         $slugs=explode(',',$_GET['brand']);
    //         $brand_ids=Brand::select('id')->whereIn('slug',$slugs)->pluck('id')->toArray();
    //         return $brand_ids;
    //         $products->whereIn('brand_id',$brand_ids);
    //     }
    //     if(!empty($_GET['sortBy'])){
    //         if($_GET['sortBy']=='title'){
    //             $products=$products->where('status','active')->orderBy('title','ASC');
    //         }
    //         if($_GET['sortBy']=='price'){
    //             $products=$products->orderBy('price','ASC');
    //         }
    //     }

    //     if(!empty($_GET['price'])){
    //         $price=explode('-',$_GET['price']);
    //         // return $price;
    //         // if(isset($price[0]) && is_numeric($price[0])) $price[0]=floor(Helper::base_amount($price[0]));
    //         // if(isset($price[1]) && is_numeric($price[1])) $price[1]=ceil(Helper::base_amount($price[1]));

    //         $products->whereBetween('price',$price);
    //     }

    //     $recent_products=Product::where('status','active')->orderBy('id','DESC')->limit(3)->get();
    //     // Sort by number
    //     if(!empty($_GET['show'])){
    //         $products=$products->where('status','active')->paginate($_GET['show']);
    //     }
    //     else{
    //         $products=$products->where('status','active')->paginate(6);
    //     }
    //     // Sort by name , price, category


    //     return view('frontend.pages.product-lists')->with('products',$products)->with('recent_products',$recent_products);
    // }
    // public function productFilter(Request $request){
    //         $data= $request->all();
    //         // return $data;
    //         $showURL="";
    //         if(!empty($data['show'])){
    //             $showURL .='&show='.$data['show'];
    //         }

    //         $sortByURL='';
    //         if(!empty($data['sortBy'])){
    //             $sortByURL .='&sortBy='.$data['sortBy'];
    //         }

    //         $catURL="";
    //         if(!empty($data['category'])){
    //             foreach($data['category'] as $category){
    //                 if(empty($catURL)){
    //                     $catURL .='&category='.$category;
    //                 }
    //                 else{
    //                     $catURL .=','.$category;
    //                 }
    //             }
    //         }

    //         $brandURL="";
    //         if(!empty($data['brand'])){
    //             foreach($data['brand'] as $brand){
    //                 if(empty($brandURL)){
    //                     $brandURL .='&brand='.$brand;
    //                 }
    //                 else{
    //                     $brandURL .=','.$brand;
    //                 }
    //             }
    //         }
    //         // return $brandURL;

    //         $priceRangeURL="";
    //         if(!empty($data['price_range'])){
    //             $priceRangeURL .='&price='.$data['price_range'];
    //         }
    //         if(request()->is('e-shop.loc/product-grids')){
    //             return redirect()->route('product-grids',$catURL.$brandURL.$priceRangeURL.$showURL.$sortByURL);
    //         }
    //         else{
    //             return redirect()->route('product-lists',$catURL.$brandURL.$priceRangeURL.$showURL.$sortByURL);
    //         }
    // }
    public function productSearch(Request $request){
		//return $request->search;
        $recent_products=Product::where('status','active')->orderBy('id','DESC')->limit(3)->get();
        $products=Product::orwhere('title','like','%'.$request->search.'%')
                    ->orwhere('slug','like','%'.$request->search.'%')
                    ->orwhere('description','like','%'.$request->search.'%')
                    ->orwhere('price','like','%'.$request->search.'%')
                    ->orderBy('id','DESC')
                    ->get();
        return view('frontend.pages.product-grids')->with('products',$products)->with('recent_products',$recent_products);
    }

    // public function productBrand(Request $request){
    //     $products=Brand::getProductByBrand($request->slug);
    //     $recent_products=Product::where('status','active')->orderBy('id','DESC')->limit(3)->get();
    //     if(request()->is('e-shop.loc/product-grids')){
    //         return view('frontend.pages.product-grids')->with('products',$products->products)->with('recent_products',$recent_products);
    //     }
    //     else{
    //         return view('frontend.pages.product-lists')->with('products',$products->products)->with('recent_products',$recent_products);
    //     }

    // }
     public function productCat(Request $request){
         $products=Category::getProductByCat($request->slug);
         // return $request->slug;
         $recent_products=Product::where('status','active')->orderBy('id','DESC')->limit(3)->get();

         if(request()->is('e-shop.loc/product-grids')){
             return view('frontend.pages.product-grids')->with('products',$products->products)->with('recent_products',$recent_products);
         }
         else{
             return view('frontend.pages.product-grids')->with('products',$products->products)->with('recent_products',$recent_products);
         }

     }


    public function product_qa_store(Request $request)
    {
            ProductQA::create([
                'user_id' => Auth::user()->id,
                'product_id' => $request->product_id,
                'question' => $request->question,
            ]);

            return redirect()->back()->with('success','Question Submited');
    }

    public function productSubCat(Request $request,$slug)
    {
        $products=Category::getProductBySubCat($slug);
        $recent_products=Product::where('status','active')->orderBy('id','DESC')->limit(3)->get();
        //  return $products;

        if(request()->is('e-shop.loc/product-grids')){
            return view('frontend.pages.product-grids')->with('products',$products->sub_products)->with('recent_products',$recent_products);
        }
        else{
            return view('frontend.pages.product-lists')->with('products',$products->sub_products)->with('recent_products',$recent_products);
        }

    }

    // public function blog(){
    //     $post=Post::query();

    //     if(!empty($_GET['category'])){
    //         $slug=explode(',',$_GET['category']);
    //         // dd($slug);
    //         $cat_ids=PostCategory::select('id')->whereIn('slug',$slug)->pluck('id')->toArray();
    //         return $cat_ids;
    //         $post->whereIn('post_cat_id',$cat_ids);
    //         // return $post;
    //     }
    //     if(!empty($_GET['tag'])){
    //         $slug=explode(',',$_GET['tag']);
    //         // dd($slug);
    //         $tag_ids=PostTag::select('id')->whereIn('slug',$slug)->pluck('id')->toArray();
    //         // return $tag_ids;
    //         $post->where('post_tag_id',$tag_ids);
    //         // return $post;
    //     }

    //     if(!empty($_GET['show'])){
    //         $post=$post->where('status','active')->orderBy('id','DESC')->paginate($_GET['show']);
    //     }
    //     else{
    //         $post=$post->where('status','active')->orderBy('id','DESC')->paginate(9);
    //     }
    //     // $post=Post::where('status','active')->paginate(8);
    //     $rcnt_post=Post::where('status','active')->orderBy('id','DESC')->limit(3)->get();
    //     return view('frontend.pages.blog')->with('posts',$post)->with('recent_posts',$rcnt_post);
    // }

    // public function blogDetail($slug){
    //     $post=Post::getPostBySlug($slug);
    //     $rcnt_post=Post::where('status','active')->orderBy('id','DESC')->limit(3)->get();
    //     // return $post;
    //     return view('frontend.pages.blog-detail')->with('post',$post)->with('recent_posts',$rcnt_post);
    // }

    // public function blogSearch(Request $request){
    //     // return $request->all();
    //     $rcnt_post=Post::where('status','active')->orderBy('id','DESC')->limit(3)->get();
    //     $posts=Post::orwhere('title','like','%'.$request->search.'%')
    //         ->orwhere('quote','like','%'.$request->search.'%')
    //         ->orwhere('summary','like','%'.$request->search.'%')
    //         ->orwhere('description','like','%'.$request->search.'%')
    //         ->orwhere('slug','like','%'.$request->search.'%')
    //         ->orderBy('id','DESC')
    //         ->paginate(8);
    //     return view('frontend.pages.blog')->with('posts',$posts)->with('recent_posts',$rcnt_post);
    // }

    // public function blogFilter(Request $request){
    //     $data=$request->all();
    //     // return $data;
    //     $catURL="";
    //     if(!empty($data['category'])){
    //         foreach($data['category'] as $category){
    //             if(empty($catURL)){
    //                 $catURL .='&category='.$category;
    //             }
    //             else{
    //                 $catURL .=','.$category;
    //             }
    //         }
    //     }

    //     $tagURL="";
    //     if(!empty($data['tag'])){
    //         foreach($data['tag'] as $tag){
    //             if(empty($tagURL)){
    //                 $tagURL .='&tag='.$tag;
    //             }
    //             else{
    //                 $tagURL .=','.$tag;
    //             }
    //         }
    //     }
    //     // return $tagURL;
    //         // return $catURL;
    //     return redirect()->route('blog',$catURL.$tagURL);
    // }

    // public function blogByCategory(Request $request){
    //     $post=PostCategory::getBlogByCategory($request->slug);
    //     $rcnt_post=Post::where('status','active')->orderBy('id','DESC')->limit(3)->get();
    //     return view('frontend.pages.blog')->with('posts',$post->post)->with('recent_posts',$rcnt_post);
    // }

    // public function blogByTag(Request $request){
    //     // dd($request->slug);
    //     $post=Post::getBlogByTag($request->slug);
    //     // return $post;
    //     $rcnt_post=Post::where('status','active')->orderBy('id','DESC')->limit(3)->get();
    //     return view('frontend.pages.blog')->with('posts',$post)->with('recent_posts',$rcnt_post);
    // }

    // Login
    public function login()
    {
        $this->middleware('auth')->except('logout');
        return view('auth.login');
    }

    public function loginSubmit(Request $request)
    {
        // return 'asd';
        //try{
            $data= $request->all();
            $validator = \Validator::make($data, [
                // 'name' => 'required|string',
                'email' => 'required|string|email|exists:users',
                'password' => 'required|string',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->with(['error'=>$validator->errors()->first()]);
            }

            if(Auth::attempt(['email' => $data['email'], 'password' => $data['password'],'status'=>'active'])
            ){
                Session::put('user',$data['email']);
                request()->session()->flash('success','Successfully login');
                $role = Auth::user()->getRoleNames();
                // dd($role);

                if($role)
                {
                    return redirect()->route($role[0].'.dashboard')->with('success','Successfully login');
                }

            }

            else
            {
                return redirect()->back()->with('error','Invalid email and password pleas try again!');
            }
        // }
        // catch(\Exception $e)
        // {
        //     return redirect()->back()->with('error',$e->getMessage());
        // }
    }

    public function logout(){
        Session::forget('user');
        Auth::logout();
        request()->session()->flash('success','Logout successfully');
        return redirect()->back()->with('success','Logout successfully');
    }

    public function register(){
        return view('frontend.pages.register');
    }
    public function registerSubmit(Request $request){
        // return $request->all();
        $this->validate($request,[
            'name'=>'string|required|min:2',
            'email'=>'string|required|unique:users,email',
            'password'=>'required|min:6',
        ]);
        $data=$request->all();
        // dd($data);
        $check=$this->create($data);
        Session::put('user',$data['email']);
        if($check){
            request()->session()->flash('success','Successfully registered');
            return redirect()->route('home');
        }
        else{
            request()->session()->flash('error','Please try again!');
            return back();
        }
    }

    public function institute_register(Request $request){
        // return $request->all();
        $this->validate($request,[
            'name'=>'string|required|min:2',
            'email'=>'string|required|unique:users,email',
            'password'=>'required|min:6',
        ]);
        $data=$request->all();
        // dd($data);
        $status= User::create([
            'name'=>$data['name'],
            'email'=>$data['email'],
            'password'=>Hash::make($data['password']),
            'status'=>'active'
        ]);
        $status->assignRole($request->input('roles'));

        Session::put('user',$data['email']);

            request()->session()->flash('success','Successfully registered');
            return redirect()->route('login');


    }
    public function create(array $data){
        return User::create([
            'name'=>$data['name'],
            'email'=>$data['email'],
            'password'=>Hash::make($data['password']),
            'status'=>'active'
            ]);
    }
    // Reset password
    public function showResetForm(){
        return view('auth.passwords.old-reset');
    }

    // public function subscribe(Request $request){
    //     if(! Newsletter::isSubscribed($request->email)){
    //             Newsletter::subscribePending($request->email);
    //             if(Newsletter::lastActionSucceeded()){
    //                 request()->session()->flash('success','Subscribed! Please check your email');
    //                 return redirect()->route('home');
    //             }
    //             else{
    //                 Newsletter::getLastError();
    //                 return back()->with('error','Something went wrong! please try again');
    //             }
    //         }
    //         else{
    //             request()->session()->flash('error','Already Subscribed');
    //             return back();
    //         }
    // }

}
