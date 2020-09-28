<?php

namespace App\Http\Controllers\Admin;

use App\Facility;
use App\Http\Requests\Admin\StoreParticipantsRequest;
use App\Participant;
use App\PreviousTraining;
use App\Training;
use App\TrainingType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreTrainingsRequest;
use App\Http\Requests\Admin\UpdateTrainingsRequest;
use App\Http\Controllers\Traits\FileUploadTrait;
use App\Region;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;

class TrainingsController extends Controller
{
    use FileUploadTrait;

    /**
     * Display a listing of Training.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('training_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('training_delete')) {
                return abort(401);
            }
            $trainings = Training::onlyTrashed()->get();
        } else {
            $trainings = Training::all();
        }

        return view('admin.trainings.index', compact('trainings'));
    }

    /**
     * Show the form for creating new Training.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('training_create')) {
            return abort(401);
        }

        $job_titles = \App\Designation::get()->pluck('name', 'id')->prepend(trans('quickadmin.qa_please_select'), '');
        $enum_sex = Participant::$enum_sex;
        //$types = TrainingType::all();
        $types = TrainingType::get()->pluck('name', 'id')->prepend(trans('quickadmin.qa_please_select'), '');
        $regions = Region::get()->pluck('name', 'id')->prepend(trans('quickadmin.qa_please_select'), '');
        return view('admin.trainings.create',compact('enum_sex','job_titles','types','regions'));
    }

    /**
     * Store a newly created Training in storage.
     *
     * @param  \App\Http\Requests\StoreTrainingsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTrainingsRequest $request)
    {

        // dd($request->get('action_button'));

        if (!Gate::allows('training_create')) {
            return abort(401);
        }
        $request = $this->saveFiles($request);
        $training = Training::create($request->all());

        $training_id = $training->id;

        switch ($request->action_button) {

            case 'Save & exit':

                return redirect()->route('admin.trainings.index');

                break;

            case 'Save & Add participants':

                // $training_id = $training->id;
                $participants = Training::find($training_id)->participants;


                $job_titles = \App\Designation::get()->pluck('name', 'id')->prepend(trans('quickadmin.qa_please_select'), '');
                $enum_sex = Participant::$enum_sex;

                return redirect()->route('admin.trainings.show',[$training->id]);


                //return view('admin.trainings.participant_page', compact('participants', 'job_titles', 'enum_sex', 'training_id'));

                break;
        }
    }

        public function page($training){
           $participants = Training::find($training)->participants;


            $job_titles = \App\Designation::get()->pluck('name', 'id')->prepend(trans('quickadmin.qa_please_select'), '');
            $enum_sex = Participant::$enum_sex;

            return view('admin.trainings.participant_page',compact('job_titles','enum_sex','training','participants'));

    }

    /**
     * Show the form for editing Training.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('training_edit')) {
            return abort(401);
        }
        $training = Training::findOrFail($id);

        return view('admin.trainings.edit', compact('training'));
    }

    /**
     * Update Training in storage.
     *
     * @param  \App\Http\Requests\UpdateTrainingsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTrainingsRequest $request, $id)
    {
        if (! Gate::allows('training_edit')) {
            return abort(401);
        }
        $request = $this->saveFiles($request);
        $training = Training::findOrFail($id);
        $training->update($request->all());


        $media = [];
        foreach ($request->input('pictures_id', []) as $index => $id) {
            $model          = config('laravel-medialibrary.media_model');
            $file           = $model::find($id);
            $file->model_id = $training->id;
            $file->save();
            $media[] = $file->toArray();
        }
        $training->updateMedia($media, 'pictures');

        return redirect()->route('admin.trainings.index');
    }


    /**
     * Display Training.
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
        $training = Training::findOrFail($id);
        $participants = Training::find($id)->participants;
        $job_titles = \App\Designation::get()->pluck('name', 'id')->prepend(trans('quickadmin.qa_please_select'), '');

        $enum_sex = Participant::$enum_sex;

        $all_participants = \App\Participant::get()->pluck('first_name','id')->prepend(trans('quickadmin.qa_please_select'), '');
        $all_participants =  Participant::all();
        $facilities = Facility::get()->pluck('name','id')->prepend(trans('quickadmin.qa_please_select'), '');
        //dd($all_participants);


        return view('admin.trainings.show', compact('training','participants','enum_sex','job_titles','all_participants','facilities'));
    }


    /**
     * Remove Training from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('training_delete')) {
            return abort(401);
        }
        $training = Training::findOrFail($id);
        $training->deletePreservingMedia();

        return redirect()->route('admin.trainings.index');
    }

    /**
     * Delete all selected Training at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('training_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Training::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->deletePreservingMedia();
            }
        }
    }

    /**
     * Restore Training from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('training_delete')) {
            return abort(401);
        }
        $training = Training::onlyTrashed()->findOrFail($id);
        $training->restore();

        return redirect()->route('admin.trainings.index');
    }

    /**
     * Permanently delete Training from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('permanent_delete')) {
            return abort(401);
        }
        $training = Training::onlyTrashed()->findOrFail($id);
        $training->forceDelete();

        return redirect()->route('admin.trainings.index');
    }

    public function participant_page(){
        $participants = Participant::all();
        $job_titles = \App\Designation::get()->pluck('name', 'id')->prepend(trans('quickadmin.qa_please_select'), '');
        $enum_sex = Participant::$enum_sex;

        return view('admin.trainings.participant_page',compact('participants','job_titles','enum_sex'));
    }

    public function save_and_add(Request $request){

        $training = Training::create($request->all());


        $training_id = $training->id;
        $participants = Participant::all();
        $job_titles = \App\Designation::get()->pluck('name', 'id')->prepend(trans('quickadmin.qa_please_select'), '');
        $enum_sex = Participant::$enum_sex;

        return view('admin.trainings.participant_page',compact('training_id','participants','job_titles','enum_sex','training_id'));

    }

    public  function  saveParticipant(StoreParticipantsRequest $req){

        $participant = new Participant();

        $participant->pin = $req->pin;
        $participant->first_name = $req->first_name;
        $participant->middle_name = $req->middle_name;
        $participant->last_name = $req->last_name;
        $participant->sex = $req->sex;
        $participant->health_facility = $req->health_facility;
        $participant->postal_address = $req->postal_address;
        $participant->district = $req->district;
        $participant->subcounty = $req->subcounty;
        $participant->profession = $req->profession;
        $participant->education_level = $req->education_level;
        $participant->mobile = $req->mobile;
        $participant->comments = $req->comments;
        $participant->dob = $req->dob;


        $participant->save();

        foreach ($req->input('previous', []) as $data) {
            $participant->previousTraining()->create($data);
        }

        $training = Training::find($req->training_id);

        $training->participants()->attach($participant->id,['remarks'=>'training','comments'=>'training','pre_test'=>$req->prescore,'post_test'=>$req->postscore]);

        return response()->json($participant);

      }

//      public  function attachparts(Request $request){
//
//          $training = Training::find($request->id);
//          $training->participants()->attach($request->participant_id,['remarks'=>'training','comments'=>'training','pre_test'=>$request->a_pre,'post_test'=>$request->a_post,'position'=>$request->position]);
//
//        return response()->json($training);
//      }

      public function gradeparts(Request $request){
          $training = Training::find($request->training_id);
          $training->participants()->attach($request->participant_id,['remarks'=>'training','comments'=>'training','pre_test'=>$request->a_pre,'post_test'=>$request->a_post,'position'=>$request->position]);

          return response()->json($training);

      }



      public function updatepivot(Request $request)
      {

          $training = Training::find($request->training_id);

          $training->participants()->updateExistingPivot($request->participant_id,
              ['comments' => 'training', 'pre_test' => $request->edit_pre, 'post_test' => $request->edit_post,
                  'profession' => $request->edit_position,'facility'=>$request->edit_facility]);

          return response()->json($training);

      }

      public function deletepivot(Request $request){

          $training = Training::find($request->training_id);

          $training->participants()->detach([1, 2, 3]);

          $training->participants()->detach([$request->participant_id]);

        return back();
      }

      public function addParticipant(Request $request){

          $training = Training::find($request->id);
           
            $training->participants()->attach($request->students);

            if($training){

                Session::flash('message','Added Successfully');

            }else{
                Session::flash('message','something went wrong');
            }





    return back();

      }


}
