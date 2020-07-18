<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mentorship;
use App\Participant;
use App\MentorshipCategory;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;

class MentorshipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mentorships = Mentorship::all();

        return view('admin.mentorships.index', compact('mentorships'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
        $categories = \App\MentorshipCategory::get()->pluck('name', 'id')->prepend(trans('quickadmin.qa_please_select'), '');
        $facilities = \App\Facility::get()->pluck('name','id')->prepend(trans('quickadmin.qa_please_select'), '');
        return view('admin.mentorships.create', compact('categories','facilities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!Gate::allows('training_create')) {
            return abort(401);
        }
   
        $mentorship =\App\Mentorship::create($request->all());

        $mentorship_id = $mentorship->id;

        switch ($request->action_button) {

            case 'Save & exit':

                return redirect()->route('admin.mentorship.index');

                break;

            case 'Save & Add participants':

                // $training_id = $training->id;
               // $participants = Training::find($training_id)->participants;


               // $job_titles = \App\Designation::get()->pluck('name', 'id')->prepend(trans('quickadmin.qa_please_select'), '');
               // $enum_sex = Participant::$enum_sex;

                return redirect()->route('admin.mentorship.show',[$mentorship->id]);


                //return view('admin.trainings.participant_page', compact('participants', 'job_titles', 'enum_sex', 'training_id'));

                break;
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
         // $data = Crypt::decrypt($id);
         if (! Gate::allows('training_view')) {
            return abort(401);
        }
        $training = Mentorship::findOrFail($id);
        $participants = Mentorship::find($id)->participants;
        $job_titles = \App\Designation::get()->pluck('name', 'id')->prepend(trans('quickadmin.qa_please_select'), '');

        $enum_sex = Participant::$enum_sex;

        $all_participants = \App\Participant::get()->pluck('first_name','id')->prepend(trans('quickadmin.qa_please_select'), '');
        $all_participants =  Participant::all();
        //dd($all_participants);


        return view('admin.mentorships.show', compact('training','participants','enum_sex','job_titles','all_participants'));
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

    public function addParticipant(Request $request){

        $mentorship = Mentorship::find($request->id);    

        $mentorship->participants()->attach($request->students);

        if($mentorship){

            Session::flash('message','Added Successfully');

        }else{
            Session::flash('message','something went wrong');
        }

    return back();

    }
}
