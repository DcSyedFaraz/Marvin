<?php

namespace App\Http\Controllers\Admin;

use App\Models\Colleges;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CollegesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['colleges'] = Colleges::paginate(10);
        return view('admin.colleges.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.colleges.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data=$request->all();
        $this->validate($request,
        [
            'title'=>'string|required|max:30',
            'type'=>'string|required|max:30',
            'country'=>'string|required|max:30',
            'location'=>'string|required',
            'website'=>'string|required',
            'instagram'=>'string|required',
            'facebook'=>'string|required',
            'twitter'=>'string|required',
            'locale'=>'string|required',
            'level'=>'string|required',
            'predominant_degree'=>'string|required',
            'fields_of_study'=>'string|required',
            'status'=>'required|in:active,inactive',
            'photo'=>'nullable|string',
        ]);

        $data=$request->all();
        // return $data;

        $status= Colleges::create($data);
        if($status){
            request()->session()->flash('success','Successfully added college');
        }
        else{
            request()->session()->flash('error','Error occurred while adding college');
        }
        return redirect()->route('college.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Colleges  $colleges
     * @return \Illuminate\Http\Response
     */
    public function show(Colleges $colleges)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Colleges  $colleges
     * @return \Illuminate\Http\Response
     */
    public function edit(Colleges $colleges,$id)
    {
        $data['college'] = $colleges::find($id);
        return view('admin.colleges.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Colleges  $colleges
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Colleges $colleges,$id)
    {
        $data=$request->all();
        $this->validate($request,
        [
           'title'=>'string|required|max:30',
            'type'=>'string|required|max:30',
            'country'=>'string|required|max:30',
            'location'=>'string|required',
            'website'=>'string|required',
            'instagram'=>'string|required',
            'facebook'=>'string|required',
            'twitter'=>'string|required',
            'locale'=>'string|required',
            'level'=>'string|required',
            'predominant_degree'=>'string|required',
            'fields_of_study'=>'string|required',
            'status'=>'required|in:active,inactive',
            'photo'=>'nullable|string',
        ]);

        $data=$request->all();
        $college = $colleges->find($id);

        $status= $college->update($data);
        if($status){
            request()->session()->flash('success','Successfully updated college');
        }
        else{
            request()->session()->flash('error','Error occurred while adding college');
        }
        return redirect()->route('college.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Colleges  $colleges
     * @return \Illuminate\Http\Response
     */
    public function destroy(Colleges $colleges,$id)
    {
        $data = $colleges->find($id);
        $data->delete();
        request()->session()->flash('success','college deleted');
        return redirect()->route('college.index');

    }
}
