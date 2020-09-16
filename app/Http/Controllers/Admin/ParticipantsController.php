<?php

namespace App\Http\Controllers\Admin;

use App\Facility;
use App\Imports\ParticipantImport;
use App\Imports\ParticipantsImport;
use App\Participant;
use App\Training;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreParticipantsRequest;
use App\Http\Requests\Admin\UpdateParticipantsRequest;
use App\Http\Controllers\Traits\FileUploadTrait;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;


class ParticipantsController extends Controller
{
    use FileUploadTrait;

    /**
     * Display a listing of Participant.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        if (! Gate::allows('participant_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('participant_delete')) {
                return abort(401);
            }
            $participants = Participant::onlyTrashed()->get();
        } else {
            $participants = Participant::all();
        }

        return view('admin.participants.index', compact('participants'));
    }

    /**
     * Show the form for creating new Participant.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('participant_create')) {
            return abort(401);
        }
        
        $job_titles = \App\Designation::get()->pluck('name', 'id')->prepend(trans('quickadmin.qa_please_select'), '');
        $enum_sex = Participant::$enum_sex;
        $facilities = Facility::get()->pluck('name','id')->prepend(trans('quickadmin.qa_please_select'), '');
            
        return view('admin.participants.create', compact('enum_sex', 'job_titles','facilities'));
    }

    /**
     * Store a newly created Participant in storage.
     *
     * @param  \App\Http\Requests\StoreParticipantsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreParticipantsRequest $request)
    {
        if (! Gate::allows('participant_create')) {
            return abort(401);
        }
        $request = $this->saveFiles($request);
        $participant = Participant::create($request->all());


        foreach ($request->input('documents_id', []) as $index => $id) {
            $model          = config('laravel-medialibrary.media_model');
            $file           = $model::find($id);
            $file->model_id = $participant->id;
            $file->save();
        }

        foreach ($request->input('previous', []) as $data) {
            $participant->previousTraining()->create($data);
        }

        return redirect()->route('admin.participants.index');
    }


    /**
     * Show the form for editing Participant.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('participant_edit')) {
            return abort(401);
        }
        
        $job_titles = \App\Designation::get()->pluck('name', 'id')->prepend(trans('quickadmin.qa_please_select'), '');
        $enum_sex = Participant::$enum_sex;
        $facilities = Facility::get()->pluck('name','id')->prepend(trans('quickadmin.qa_please_select'), '');
            
        $participant = Participant::findOrFail($id);

        return view('admin.participants.edit', compact('participant', 'enum_sex', 'job_titles','facilities'));
    }

    /**
     * Update Participant in storage.
     *
     * @param  \App\Http\Requests\UpdateParticipantsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateParticipantsRequest $request, $id)
    {
        if (! Gate::allows('participant_edit')) {
            return abort(401);
        }
        $request = $this->saveFiles($request);
        $participant = Participant::findOrFail($id);
        $participant->update($request->all());


        $media = [];
        foreach ($request->input('documents_id', []) as $index => $id) {
            $model          = config('laravel-medialibrary.media_model');
            $file           = $model::find($id);
            $file->model_id = $participant->id;
            $file->save();
            $media[] = $file->toArray();
        }
        $participant->updateMedia($media, 'documents');

        return redirect()->route('admin.participants.index');
    }


    /**
     * Display Participant.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('participant_view')) {
            return abort(401);
        }
        $participant = Participant::findOrFail($id);

        return view('admin.participants.show', compact('participant'));
    }


    /**
     * Remove Participant from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('participant_delete')) {
            return abort(401);
        }
        $participant = Participant::findOrFail($id);
        $participant->deletePreservingMedia();

        return redirect()->route('admin.participants.index');
    }

    /**
     * Delete all selected Participant at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('participant_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Participant::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->deletePreservingMedia();
            }
        }
    }


    /**
     * Restore Participant from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('participant_delete')) {
            return abort(401);
        }
        $participant = Participant::onlyTrashed()->findOrFail($id);
        $participant->restore();

        return redirect()->route('admin.participants.index');
    }

    /**
     * Permanently delete Participant from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('permanent_delete')) {
            return abort(401);
        }
        $participant = Participant::onlyTrashed()->findOrFail($id);
        $participant->forceDelete();

        return redirect()->route('admin.participants.index');
    }

    public function search(Request $req)
    {



        if(isset($req->first_name) && !isset($req->pin)){

            $participants = Participant::where('first_name',$req->first_name)->get();

        }elseif ( isset($req->pin) && ! isset($req->first_name)){

            $participants = Participant::where('pin',$req->pin)->get();

        }else{

            $participants = Participant::where('first_name',$req->first_name)
                ->where('pin',$req->pin)
                ->get();

        }

        $participants = Participant::where('pin',$req->pin)->get();

        return view('admin.participants.search_results', compact('participants'));

    }

    public function uploadExcel(Request $request)
    {

        $records = (new ParticipantImport)->toArray($request->file('participants'));



        $training_id = $request->training_id;
        $data = [
            'training_id'=>$training_id
        ];

      $excell=  Excel::import(new ParticipantImport, $request->file('participants'));




      if ($excell){


          foreach (current($records) as $record){

              $pin = ($record['pin']);

              $participant = Participant::where('pin',"$pin")->first();

              dd($participant);


              if($participant) {
                  Training::find($request->training_id)->participants()->attach($participant->id, ['remarks' => 'fair test results', 'comments' => 'good', 'pre_test' => $record->prescore, 'post_test' => $record->postscore]);
              }
          }

          Session::flash('message','Your data was successfully imported');


      }else{

          Session::flash('error','Error importing excell');

      }

        /*$participants = Participant::all('pin')->toArray();

        if ($request->file('participants')) {
            $path = $request->file('participants')->getRealPath();





            $data = Excel::import($path, function ($reader) {
            })->get();

            if (!empty($data) && $data->count()) {
                $insert = array();

                foreach ($data as $key => $value) {

                    if (in_array($value->pin, $participants))
                        continue;
                    $insert[] = ['pin' => $value->pin, 'first_name' => $value->Fname,'middle_name'=>$value->mname,'last_name'=>$value->lname,'mobile'=>$value->phone];

                    // Add new title to array
                   // $titles[] = $value->title;
                }
                if (!empty($insert)) {
                    $insertData = DB::table('participants')->insert($insert);

                    if ($insertData){
                       Session::flash('success','Your data was successfully imported');
                    }else{

                        Session::flash('error','Error importing excell');

                        return back();


                    }

                }
            }


        }*/
        return back();
    }

    public function check_userpin(){
        // can get last_name, superior like first_name below
        $participant_pin = Input::get('participant_pin');
        $data = Participant::where('pin',$participant_pin)->first();


        return $data;
    }

    public function import(Request $request)
    {
        $excell=  Excel::import(new ParticipantsImport, $request->file('participants'));

        if ($excell){
            Session::flash('message','Your data was successfully imported');
        }else{
            Session::flash('error','Error importing excell');
        }

        return back();
    }


}
