<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Imports\TrainingParticipantImport;
use App\Report;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        if (! Gate::allows('designation_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('designation_delete')) {
                return abort(401);
            }
            $reports = Report::onlyTrashed()->get();
        } else {
            $reports  = Report::all();
        }

        return view('admin.reports.index', compact('reports'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('participant_create')) {
            return abort(401);
        }
        
      
            
        return view('admin.reports.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (! Gate::allows('participant_create')) {
            return abort(401);
        }

        
        $data = $request->all();
        $data['captured_by']= Auth()->user()->name;
    
        $Report = Report::create($data);

        

        Excel::import(new TrainingParticipantImport, request()->file('participants_list'));

        Excel::import(new TrainingParticipantImport, request()->file('facilitators_list'));



        // foreach ($request->input('previous', []) as $data) {
        //     $participant->previousTraining()->create($data);
        // }

        return redirect()->route('admin.reports.index');
    }

    /**
     * Display the specified resource.
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('user_edit')) {
            return abort(401);
        }
        
        $roles = \App\Role::get()->pluck('title', 'id')->prepend(trans('quickadmin.qa_please_select'), '');

        $user = User::findOrFail($id);

        return view('admin.users.edit', compact('user', 'roles'));
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
        if (! Gate::allows('role_edit')) {
            return abort(401);
        }
        $role = Role::findOrFail($id);
        $role->update($request->all());



        return redirect()->route('admin.roles.index');
    }

    /**
     * Remove the specified resource from storage.
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
        if (! Gate::allows('participant_delete')) {
            return abort(401);
        }
        $participant = Participant::onlyTrashed()->findOrFail($id);
        $participant->forceDelete();

        return redirect()->route('admin.participants.index');
    }

}
