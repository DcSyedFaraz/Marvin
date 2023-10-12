<?php

namespace App\Http\Controllers\coach;

use App\Http\Controllers\Controller;
use App\Models\coach_sport;
use App\Models\Player;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function team($id)
    {
        // dd('a');
        $coach = coach_sport::find($id);
        $teams = Team::where('colleges_id',$coach->colleges_id)->where('sports_id',$coach->sports_id)->get();
        // dd($team);
        return view('coach.team.index',compact('teams','coach'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('coach.team.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request;
        $request['createdBy'] = Auth::user()->id;
        $team = Team::create($request->all());
        return redirect()->back()->with('success','Team created successfully');

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
        $players = Player::with('users')->where('team_id',$id)->get();
        $team = Team::find($id);
        $playersToAdd = User::withRole('athelete')->get();
        // dd($players);
        return view('coach.team.edit', compact('team','players','playersToAdd'));
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
        $team = Team::findOrFail($id);
        $team->update($request->all());
        return redirect()->back()->with('success','Team Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete=Team::findorFail($id);
        $status=$delete->delete();
        return redirect()->back()->with('success','Team Deleted successfully');
    }
}
