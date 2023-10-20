<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Field;
use App\Models\Sports;
use App\Models\Stats;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SportsController extends Controller
{
    public function index()
    {
        $data['sports'] = Sports::all();
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
        try {
            DB::beginTransaction();

            $this->validate($request, [
                'title' => 'string|required|max:30',
                'photo' => 'nullable|string',
                'status' => 'required|in:active,inactive',
            ]);

            if ($request->has('fields')) {
                foreach ($request->input('fields') as $key => $fieldName) {
                    if (!empty($fieldName)) {
                        $updateData = [
                            'name' => $fieldName,
                            'sports_id' => $id,
                        ];

                        Field::create($updateData);
                    }
                }
            }

            if ($request->has('stats')) {
                foreach ($request->input('stats') as $key => $statName) {
                    if (!empty($statName)) {
                        $updateData = [
                            'name' => $statName,
                            'sports_id' => $id,
                        ];

                        Stats::create($updateData);
                    }
                }
            }

            $spert = Sports::find($id);
            $spert->title = $request['title'];
            $spert->status = $request['status'];
            $spert->save();

            DB::commit();

            request()->session()->flash('success', 'Successfully updated sport');
        } catch (\Exception $e) {
            DB::rollBack();

            request()->session()->flash('error', 'Error occurred while updating sport: ' . $e->getMessage());
        }

        return redirect()->route('sport.index');
    }

    public function destroy(Sports $sports,$id)
    {
        // return $id;
        $spert = Sports::find($id);
        $spert->delete();
        request()->session()->flash('success','Successfully deleted sport');

        return redirect()->route('sport.index');
    }
    public function fields($id)
    {
        //  return $id;
        try {
            $fieldOrStat = Field::find($id);

            if (!$fieldOrStat) {
                return redirect()->back()->with('error', 'Record not found');
            }

            $fieldOrStat->delete();

            return redirect()->back()->with('info', 'Record deleted successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while deleting the record: ' . $e->getMessage());
        }
    }
    public function stats($id)
    {
        // return $id;
        try {
            $fieldOrStat = Stats::find($id);

            if (!$fieldOrStat) {
                return redirect()->back()->with('error', 'Record not found');
            }

            $fieldOrStat->delete();

            return redirect()->back()->with('info', 'Record deleted successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while deleting the record: ' . $e->getMessage());
        }
    }
}
