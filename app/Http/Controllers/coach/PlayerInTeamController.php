<?php

namespace App\Http\Controllers\coach;

use App\Http\Controllers\Controller;
use App\Models\Player;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PlayerInTeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }
    public function resend($id)

        {
            $teams = Player::find($id);

            if ($teams && $teams->status === 'declined') {
                // Update the status to 'Accepted'
                $teams->status = 'pending';
                $teams->save();
            }

            return redirect()->back()->with('info', 'Invitation Resend Successfully');
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
        // return $request;
        try {
            DB::beginTransaction();

            $this->validate($request, [
                'user_id' => 'required',
                'team_id' => 'required',
            ]);

            $request['status'] = 'pending';

            $player = Player::create($request->all());

            DB::commit();

            return redirect()->back()->with('success', 'Player Added Successfully');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Failed to add player. ' . $e->getMessage());
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
            // Find the player by ID
            $player = Player::findOrFail($id);

            // Delete the player
            $player->delete();

            return redirect()->back()->with('error', 'Player deleted successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete player. ' . $e->getMessage());
        }
    }
}
