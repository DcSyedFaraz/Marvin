<?php

namespace App\Http\Controllers\athelte;

use App\Http\Controllers\Controller;
use App\Models\Player;
use App\Models\Team;
use Illuminate\Http\Request;

class AtheleteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function team()
    {
        $teams = Team::whereHas('Player', function ($query) {
            $query->where('status', 'accepted');
                })->get();
                // dd($team);
                return view('user.teams.teams',compact('teams'));
    }
    public function acceptteam($id)
    {
        // Find the work order by ID
        $teams = Player::find($id);
        // dd($teams);
        // Check if the work order exists and is in 'Pending' status
        if ($teams && $teams->status === 'pending') {
            // Update the status to 'Accepted'
            // dd('d');
            $teams->status = 'accepted';
            $teams->save();
        }

        return redirect()->back()->with('success', 'Invitation Accepted Successfully');
    }

    public function declineteam($id)
    {
        $teams = Player::find($id);

        if ($teams && $teams->status === 'pending') {
            // Update the status to 'Accepted'
            $teams->status = 'declined';
            $teams->save();
        }

        return redirect()->back()->with('warning', 'Invitation Declined Successfully');
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
        //
    }
}
