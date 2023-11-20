<?php

namespace App\Http\Controllers;

use App\Models\FieldsValue;
use App\Models\PlayerProfile;
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

            $player->name = $request->input('name');
            $player->email = $request->input('email');

            if ($request->filled('password')) {
                $player->password = Hash::make($request->input('password'));
            }

            $player->save();
            
            $playerProfile = PlayerProfile::where('user_id', $id)->first();
            if ($playerProfile) {
                if ($request->hasFile('profile_picture')) {
                    $newImage = $request->file('profile_picture');
                    $imageName = time() . '.' . $newImage->getClientOriginalExtension();
                    $newImage->move(public_path('uploads/profile_pictures'), $imageName);
                    $playerProfile->profile_picture = 'uploads/profile_pictures/' . $imageName;
                    $playerProfile->save();
                }
            }

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

            return redirect()->back()->with('error', 'Something went wrong. Please try again later.' . $e->getMessage());
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
