<?php

namespace App\Http\Controllers\Admin;

use App\Designation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreDesignationsRequest;
use App\Http\Requests\Admin\UpdateDesignationsRequest;

class DesignationsController extends Controller
{
    /**
     * Display a listing of Designation.
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
            $designations = Designation::onlyTrashed()->get();
        } else {
            $designations = Designation::all();
        }

        return view('admin.designations.index', compact('designations'));
    }

    /**
     * Show the form for creating new Designation.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('designation_create')) {
            return abort(401);
        }
        return view('admin.designations.create');
    }

    /**
     * Store a newly created Designation in storage.
     *
     * @param  \App\Http\Requests\StoreDesignationsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDesignationsRequest $request)
    {
        if (! Gate::allows('designation_create')) {
            return abort(401);
        }
        $designation = Designation::create($request->all());

        foreach ($request->input('participants', []) as $data) {
            $designation->participants()->create($data);
        }


        return redirect()->route('admin.designations.index');
    }


    /**
     * Show the form for editing Designation.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('designation_edit')) {
            return abort(401);
        }
        $designation = Designation::findOrFail($id);

        return view('admin.designations.edit', compact('designation'));
    }

    /**
     * Update Designation in storage.
     *
     * @param  \App\Http\Requests\UpdateDesignationsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDesignationsRequest $request, $id)
    {
        if (! Gate::allows('designation_edit')) {
            return abort(401);
        }
        $designation = Designation::findOrFail($id);
        $designation->update($request->all());

        $participants           = $designation->participants;
        $currentParticipantData = [];
        foreach ($request->input('participants', []) as $index => $data) {
            if (is_integer($index)) {
                $designation->participants()->create($data);
            } else {
                $id                          = explode('-', $index)[1];
                $currentParticipantData[$id] = $data;
            }
        }
        foreach ($participants as $item) {
            if (isset($currentParticipantData[$item->id])) {
                $item->update($currentParticipantData[$item->id]);
            } else {
                $item->delete();
            }
        }


        return redirect()->route('admin.designations.index');
    }


    /**
     * Display Designation.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('designation_view')) {
            return abort(401);
        }
        $participants = \App\Participant::where('job_title_id', $id)->get();

        $designation = Designation::findOrFail($id);

        return view('admin.designations.show', compact('designation', 'participants'));
    }


    /**
     * Remove Designation from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('designation_delete')) {
            return abort(401);
        }
        $designation = Designation::findOrFail($id);
        $designation->delete();

        return redirect()->route('admin.designations.index');
    }

    /**
     * Delete all selected Designation at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('designation_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Designation::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Designation from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('designation_delete')) {
            return abort(401);
        }
        $designation = Designation::onlyTrashed()->findOrFail($id);
        $designation->restore();

        return redirect()->route('admin.designations.index');
    }

    /**
     * Permanently delete Designation from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('designation_delete')) {
            return abort(401);
        }
        $designation = Designation::onlyTrashed()->findOrFail($id);
        $designation->forceDelete();

        return redirect()->route('admin.designations.index');
    }
}
