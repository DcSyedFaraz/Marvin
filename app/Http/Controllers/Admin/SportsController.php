<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sports;
use Illuminate\Http\Request;

class SportsController extends Controller
{
    public function index()
    {
        $data['sports'] = Sports::paginate(10);
        return view('admin.sports.index',$data);
    }

    public function create()
    {
        return view('admin.sports.create');
    }

    public function store(Request $request)
    {
        $data=$request->all();
        $this->validate($request,
        [
            'title'=>'string|required|max:30',
            'photo'=>'nullable|string',
            'status'=>'required|in:active,inactive',
        ]);

        $data=$request->all();
        // return $data;

        $status= Sports::create($data);
        if($status){
            request()->session()->flash('success','Successfully added sport');
        }
        else{
            request()->session()->flash('error','Error occurred while adding sport');
        }
        return redirect()->route('sport.index');
    }

    public function show(Sports $sports)
    {
        //
    }

    public function edit(Sports $sports,$id)
    {
        $data['sport'] = Sports::find($id);
        return view('admin.sports.edit',$data);
    }

    public function update(Request $request, Sports $sports,$id)
    {
        $data=$request->all();
        $this->validate($request,
        [
            'title'=>'string|required|max:30',
            'photo'=>'nullable|string',
            'status'=>'required|in:active,inactive',
        ]);

        $data=$request->all();
        // return $data;

        $spert = Sports::find($id);
        $status = $spert->update($data);
        if($status){
            request()->session()->flash('success','Successfully updated sport');
        }
        else{
            request()->session()->flash('error','Error occurred while adding sport');
        }
        return redirect()->route('sport.index');
    }

    public function destroy(Sports $sports,$id)
    {
        $spert = Sports::find($id);
        $spert->delete();
        request()->session()->flash('success','Successfully deleted sport');

        return redirect()->route('sport.index');
    }
}
