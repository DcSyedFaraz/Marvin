<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::where('id', auth()->user()->id)->with('userdetail')->first();
        return view('general-setting.index', compact('user'));
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
        //
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
        // return $request;
        $this->validate($request, [
            'name' => 'required',
            'password' => 'required',
        ]);

        $input = $request->all();

        $user = User::find($id);
        $input['password']= Hash::make($request->password);
        $user->update([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => $input['password'],
        ]);

        $profileData = [
            'address' => $request->input('address'),
            'cell_number' => $request->input('cell_number'),
            'office_number' => $request->input('office_number'),
            'call_time' => $request->input('call_time'),
            'twitter' => $request->input('twitter'),
            'facebook' => $request->input('facebook'),
        ];

        // Check if the user already has a profile; if not, create one
        $user->userdetail()->updateOrCreate(
            ['user_id' => $user->id],
            $profileData
        );

        if ($request->hasFile('school_mascot')) {
            $file = $request->file('school_mascot');
            $filename = $file->getClientOriginalName();
            $file->storeAs('school_mascots', $filename, 'public');

            $user->userdetail->school_mascot = $filename;
        }

        if ($request->hasFile('coaches_photo')) {
            $file = $request->file('coaches_photo');
            $filename = $file->getClientOriginalName();
            $file->storeAs('coaches_photos', $filename, 'public');

            $user->userdetail->coaches_photo = $filename;
        }

        $user->userdetail->save();




        return redirect()->back()->with('success','Successfully Updated The Profile');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
