<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Player;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;

class AdminTeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $team = Team::orderby('created_at','desc')->get();
        return view('admin.team.index', compact('team'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.team.create');
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
        // dd('done');
        $players = Player::with('users')->where('team_id', $id)->get();
        $team = Team::find($id);
        $playersToAdd = User::withRole('athelete')->get();
        // dd($players);
        return view('coach.team.edit', compact('team', 'players', 'playersToAdd'));
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
        try{
            Team::destroy($id);
             return redirect()->back()->with('success','Team Deleted Successfully');
        } catch (\Exception $e){
            return redirect()->back()->with('error', 'Something went wrong. Please try again later.' . $e->getMessage());
        }
    }
}
