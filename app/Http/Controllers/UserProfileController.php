<?php

namespace App\Http\Controllers;

use App\Models\FieldsValue;
use App\Models\Sports;
use App\Models\User;
use DB;
use Hash;
use Illuminate\Http\Request;
use Validator;

class UserProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sport = Sports::all();
        $user = User::with('sport_name')->where('id', auth()->user()->id)->first();

        // dd($user);
        return view('user.profile.profile', compact('sport', 'user'));
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
        $validator = Validator::make($request->all(), [
            'sport' => 'required',
            'fields' => 'required',
        ]);
        try {
            DB::beginTransaction();

            $player = User::findOrFail($id);

            if ($request->sport == $player->assigned_sport) {
                foreach ($request['field_id'] as $key => $fieldId) {

                    $updateData = [
                        'value' => $request['fields'][$key]
                    ];

                    $fieldsValue = FieldsValue::updateOrInsert(
                        ['field_id' => $fieldId, 'player_id' => auth()->user()->id],

                        $updateData
                    );
                }

            } else {
                $player->assigned_sport = $request->input('sport');
                $player->save();
                DB::commit();

                return redirect()->back()->with('info', 'Sport changed Successfully');
            }

            DB::commit();

            return redirect()->back()->with('success', 'Values changed Successfully');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()->with('error', 'Something went wrong. Please try again later.');
        }

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
