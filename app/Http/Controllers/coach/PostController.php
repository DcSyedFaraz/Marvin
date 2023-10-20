<?php

namespace App\Http\Controllers\coach;

use App\Http\Controllers\Controller;
use App\Models\Post;
use DB;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $post= Post::with('usname')->orderBy("created_at","desc")->get();
        // dd($post);
        return view("coach.post.post",compact("post"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $request->validate([
                'content' => 'required',
            ]);

            $post = Post::create([
                'content' => $request->content,
                'user_id' => Auth::user()->id,
            ]);

            DB::commit();

            return redirect()->back()->with('success', 'Your post has been successfully submitted.');
        } catch (QueryException $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'An error occurred while posting: ' . $e->getMessage());
        }
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $post = Post::findOrFail($id);
            $post->delete();
            return redirect()->back()->with('success', 'Post Deleted Successfully');
        } catch (QueryException $e) {
            return redirect()->back()->with('error', 'An error occurred while deleting the post: ' . $e->getMessage());
        }
    }
}
