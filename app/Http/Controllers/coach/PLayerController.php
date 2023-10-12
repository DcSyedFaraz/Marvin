<?php

namespace App\Http\Controllers\coach;

use App\Http\Controllers\Controller;
use App\Models\Player;
use App\Models\PlayerProfile;
use App\Models\User;
use Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PLayerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $players = User::withRole('athelete')->get();

        return view('coach.players.index', ['players' => $players]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('coach.players.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,',
            'password' => 'same:confirm-password',
            'profile_picture' => 'image|mimes:jpeg,png,gif|max:2048',
        ]);
        try {
            $player = new User([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => bcrypt($request->input('password')),
                // Assuming the coach is logged in.
            ]);
            $player->save();
            $player->assignRole(3);

            // Create a profile for the player
            $playerProfile = new PlayerProfile([
                'user_id' => $player->id,
                'video_embed' => $request->input('video_embed'),
                'introduction' => $request->input('introduction'),
                'forty_times' => $request->input('forty_times'),
                'vertical_jump' => $request->input('vertical_jump'),
                'gpa' => $request->input('gpa'),
            ]);
            if ($request->hasFile('profile_picture')) {
                $newImage = $request->file('profile_picture');
                $imageName = time() . '.' . $newImage->getClientOriginalExtension();

                $newImage->move(public_path('uploads/profile_pictures'), $imageName);

                $playerProfile->profile_picture = 'uploads/profile_pictures/' . $imageName;
            }
            $playerProfile->save();

            return redirect()->route('manage-players.index')->with('success', 'New Player Added Successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while adding the player: ' . $e->getMessage());
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
        $player = User::where('id', $id)->with('profile')->first();

        if (!$player) {
            return redirect()->route('manage-players.index')->with('error', 'Player not found.');
        }
        // dd($player);
        return view('coach.players.manage', ['player' => $player]);
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
    $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users,email,' . $id,
        'password' => 'nullable|confirmed',
        'profile_picture' => 'image|mimes:jpeg,png,gif|max:2048',
    ]);

    try {
        // Find the player by ID or return with an error message
        $player = User::findOrFail($id);

        $player->name = $request->input('name');
        $player->email = $request->input('email');

        if ($request->filled('password')) {
            $player->password = Hash::make($request->input('password'));
        }

        $player->save();

        // Update player profile if it exists
        $playerProfile = PlayerProfile::where('user_id', $id)->first();

        if ($playerProfile) {
            $playerProfile->update([
                'introduction' => $request->input('introduction'),
                'forty_times' => $request->input('forty_times'),
                'vertical_jump' => $request->input('vertical_jump'),
                'video_embed' => $request->input('video_embed'),
                'gpa' => $request->input('gpa'),
            ]);

            if ($request->hasFile('profile_picture')) {
                $newImage = $request->file('profile_picture');
                $imageName = time() . '.' . $newImage->getClientOriginalExtension();
                $newImage->move(public_path('uploads/profile_pictures'), $imageName);
                $playerProfile->profile_picture = 'uploads/profile_pictures/' . $imageName;
                $playerProfile->save();
            }
        }

        return redirect()->route('manage-players.index')->with('success', 'Player information updated successfully');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'An error occurred while updating the player: ' . $e->getMessage());
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
    try {
        // Find the player by ID
        $player = User::find($id);

        if (!$player) {
            return redirect()->route('manage-players.index')->with('error', 'Player not found.');
        }

        $playerProfile = PlayerProfile::where('user_id', $id)->first();
        if ($playerProfile) {
            // Delete the profile picture file if it exists
            if (file_exists(public_path($playerProfile->profile_picture))) {
                unlink(public_path($playerProfile->profile_picture));
            }

            $playerProfile->delete();
        }

        // Delete the player
        $player->delete();

        return redirect()->route('manage-players.index')->with('success', 'Player deleted successfully');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'An error occurred while deleting the player: ' . $e->getMessage());
    }
}

}
