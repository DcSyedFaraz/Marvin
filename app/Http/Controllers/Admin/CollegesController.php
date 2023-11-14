<?php

namespace App\Http\Controllers\Admin;

use App\Models\coach_sport;
use App\Models\CoachData;
use App\Models\Colleges;
use App\Http\Controllers\Controller;
use App\Models\Sports;
use App\Models\User;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use League\Csv\Reader;
use League\Csv\Statement;
use Log;
use Spatie\Permission\Traits\HasRoles;

class CollegesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function uploadCsv(Request $request)
    {
        // dd('done');
        // $request->validate([
        //     'csv_file' => 'required|file|mimes:csv,txt',
        // ]);

        // Retrieve and parse the CSV file
        // $csv = Reader::createFromPath($request->file('csv_file')->getPathname(), 'r');
        // $csv->setHeaderOffset(0);
        // $headers = $csv->getHeader();
        // $records = Statement::create()->process($csv);
        // dd($csv);
        // Schema::create('dynamic_table', function (Blueprint $table) use ($headers) {
        //     $table->id();
        //     foreach ($headers as $header) {
        //         $table->string($header);
        //     }
        //     $table->timestamps(0);
        // });


        // foreach ($records as $record) {
        //     DB::table('dynamic_table')->insert($record);
        // }

        // return redirect()->back()->with('success', 'CSV data uploaded and table created.');

        try {
            $request->validate([
                'csv_file' => 'required|file|mimes:csv',
            ]);

            DB::beginTransaction();

            $csv = Reader::createFromPath($request->file('csv_file')->getPathname(), 'r');
            $csv->setHeaderOffset(0);
            $records = Statement::create()->process($csv);

            foreach ($records as $record) {
                DB::table('dynamic_table')->insert($record);
            }

            DB::commit();

            return redirect()->back()->with('success', 'CSV data uploaded.');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()->with('error', 'An error occurred while processing the CSV. Please try again.');
        }
    }
    public function data()
    {
        $data['data'] = CoachData::orderby('created_at', 'desc')->get();
        // dd($data);
        return view('admin.coachData.data', $data);
    }
    public function Editdata($id)
    {
        $data['conference'] = CoachData::find($id);
        return view('admin.coachData.edit', $data);
    }
    public function updatedata(Request $request, $id)
    {
        try {
            DB::beginTransaction();

            $coachData = CoachData::findOrFail($id); // Find the record by ID
            $coachData->update($request->all()); // Replace with the actual fields

            // $coachData->save();

            DB::commit();

            return redirect()->route('coach.data')->with('success', 'Data updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()->with('error', 'An error occurred while updating the data. Please try again.');
        }
    }
    public function Deletedata($id)
    {
        try {
            DB::beginTransaction();
            $coachData = CoachData::findOrFail($id);
            $coachData->delete();
            DB::commit();
            return redirect()->back()->with('success', 'Data Deleted Successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'An error occurred while deleting the data. Please try again.');
        }
    }
    public function index()
    {
        $data['colleges'] = Colleges::all();
        return view('admin.colleges.index', $data);
    }

    public function coaches($id)
    {
        $data['coachSport'] = coach_sport::get();
        $data['colleges'] = Colleges::find($id);
        $data['sports'] = $data['colleges']->sports;
        $data['coaches'] = User::whereHas(
            'roles',
            function ($q) {
                $q->where('name', 'coach');
            }
        )->get();
        // dd($coaches);

        return view('admin.colleges.coaches', $data);
    }

    public function adminCoachSave(Request $request)
    {
        DB::beginTransaction();

        try {
            $collegeId = $request->input('college_id');
            $sportsData = $request->input('sports');
            $coachSport = coach_sport::where('colleges_id', $collegeId)->get();

            if ($coachSport->count() > 0) {
                // Delete all the existing coach_sport records for the college
                foreach ($coachSport as $coachSportRecord) {
                    $coachSportRecord->delete();
                }
            }

            foreach ($sportsData as $sportId => $sportData) {
                // Get the coach IDs for this sport
                $coachIds = $sportData['coaches'];

                foreach ($coachIds as $coachId) {
                    // Create a new pivot record
                    coach_sport::create([
                        'user_id' => $coachId,
                        'sports_id' => $sportId,
                        'colleges_id' => $collegeId,
                    ]);
                }
            }

            DB::commit(); // Commit the transaction if everything is successful

            return redirect()->route('college.index')->with('success', 'Successfully Assigned Coaches');
        } catch (\Exception $e) {
            DB::rollback(); // Rollback the transaction if an error occurs

            return back()->with('error', 'An error occurred. Changes were not saved.');
        }
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sports = Sports::get();
        return view('admin.colleges.create', compact('sports'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    public function store(Request $request)
    {
        // Wrap the code in a try-catch block to handle exceptions
        try {
            // Start the database transaction
            DB::beginTransaction();

            $this->validate($request, [
                'title' => 'string|required|max:30',
                'type' => 'string|required|max:30',
                'country' => 'string|required|max:30',
                'location' => 'string|required',
                'website' => 'string|required',
                'instagram' => 'string|required',
                'facebook' => 'string|required',
                'twitter' => 'string|required',
                'locale' => 'string|required',
                'level' => 'string|required',
                'predominant_degree' => 'string|required',
                'fields_of_study' => 'string|required',
                'status' => 'required|in:active,inactive',
                'photo' => 'nullable|string',
            ]);

            $data = $request->all();

            $status = new Colleges();
            $status->title = $data['title'];
            $status->type = $data['type'];
            $status->country = $data['country'];
            $status->location = $data['location'];
            $status->website = $data['website'];
            $status->instagram = $data['instagram'];
            $status->facebook = $data['facebook'];
            $status->twitter = $data['twitter'];
            $status->locale = $data['locale'];
            $status->level = $data['level'];
            $status->predominant_degree = $data['predominant_degree'];
            $status->fields_of_study = $data['fields_of_study'];
            $status->status = $data['status'];
            $status->photo = $data['photo'];
            $status->save();

            if (isset($data['sports'])) {
                $status->sports()->sync($data['sports']);
            }

            // Commit the database transaction
            DB::commit();

            request()->session()->flash('success', 'Successfully added college');
        } catch (\Exception $e) {
            // If an error occurs, roll back the database transaction
            DB::rollBack();

            request()->session()->flash('error', 'Error occurred while adding college');

            // Log the exception for debugging (optional)
            Log::error($e->getMessage());

            // Handle the exception or re-throw it as needed
            throw $e;
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
    public function edit(Colleges $colleges, $id)
    {
        $data['college'] = $colleges::find($id);
        $data['allSports'] = Sports::get();

        return view('admin.colleges.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Colleges  $colleges
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Colleges $colleges, $id)
    {
        $data = $request->all();
        try {
            // Start the database transaction
            DB::beginTransaction();
            $this->validate(
                $request,
                [
                    'title' => 'string|required|max:30',
                    'type' => 'string|required|max:30',
                    'country' => 'string|required|max:30',
                    'location' => 'string|required',
                    'website' => 'string|required',
                    'instagram' => 'string|required',
                    'facebook' => 'string|required',
                    'twitter' => 'string|required',
                    'locale' => 'string|required',
                    'level' => 'string|required',
                    'predominant_degree' => 'string|required',
                    'fields_of_study' => 'string|required',
                    'status' => 'required|in:active,inactive',
                    'photo' => 'nullable|string',
                ]
            );

            $data = $request->all();
            $status = $colleges->find($id);
            $status->title = $data['title'];
            $status->type = $data['type'];
            $status->country = $data['country'];
            $status->location = $data['location'];
            $status->website = $data['website'];
            $status->instagram = $data['instagram'];
            $status->facebook = $data['facebook'];
            $status->twitter = $data['twitter'];
            $status->locale = $data['locale'];
            $status->level = $data['level'];
            $status->predominant_degree = $data['predominant_degree'];
            $status->fields_of_study = $data['fields_of_study'];
            $status->status = $data['status'];
            $status->photo = $data['photo'];
            $status->save();

            if (isset($data['sports'])) {
                $status->sports()->sync($data['sports']);
            }

            // Commit the database transaction
            DB::commit();

            request()->session()->flash('success', 'Successfully added college');
        } catch (\Exception $e) {
            // If an error occurs, roll back the database transaction
            DB::rollBack();

            request()->session()->flash('error', 'Error occurred while adding college');

            // Log the exception for debugging (optional)
            Log::error($e->getMessage());

            // Handle the exception or re-throw it as needed
            throw $e;
        }
        return redirect()->route('college.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Colleges  $colleges
     * @return \Illuminate\Http\Response
     */
    public function destroy(Colleges $colleges, $id)
    {
        $data = $colleges->find($id);
        $data->delete();
        request()->session()->flash('success', 'college deleted');
        return redirect()->route('college.index');

    }
}
