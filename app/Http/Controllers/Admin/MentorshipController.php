<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mentorship;
use App\Participant;
use App\MentorshipCategory;
use App\User;
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
        $venues= \App\Facility::get()->pluck('name','id')->prepend(trans('quickadmin.qa_please_select'), '');

        $mentors = User::all();
        $categories = \App\MentorshipCategory::get()->pluck('name','id')->prepend(trans('quickadmin.qa_please_select'), '');

        $training_mentors = Mentorship::find($id)->tutors;;
        //dd($all_participants);


        return view('admin.mentorships.show', compact('training','venues','categories','participants','enum_sex','job_titles','all_participants','training_mentors','mentors'));
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
        $mentorship = Mentorship::findOrFail($id);

       

        $mentorship->update($request->all());

        return back();
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

    public function attachMentors(Request $request){

        $mentorship = Mentorship::find($request->id);    

        $mentorship->tutors()->attach($request->mentors);

        if($mentorship){

            Session::flash('message','Added Successfully');

        }else{
            Session::flash('message','something went wrong');
        }

    return back();

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

    public  function  saveParticipant(Request $req){

        $participant = new Participant();
     
        $participant->first_name = $req->first_name;
        $participant->middle_name = $req->middle_name;
        $participant->last_name = $req->last_name;
        $participant->sex = $req->sex;
        $participant->health_facility = $req->health_facility;
        $participant->postal_address = $req->postal_address;
        $participant->district = $req->district;
        $participant->subcounty = $req->subcounty;
        $participant->profession = $req->profession;      
        $participant->mobile = $req->mobile;     
        $participant->dob = $req->dob;
        $participant->job_title_id = $req->job_title_id;     

        $participant->save();

        $mentorship = Mentorship::find($req->mentorship_id);

        $mentorship->participants()->attach($participant->id,['notes'=>'']);

        return response()->json($participant);

      }
}
