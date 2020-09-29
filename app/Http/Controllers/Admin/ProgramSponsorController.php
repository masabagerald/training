<?php

namespace App\Http\Controllers\Admin;

use App\TrainingType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ProgramSponsor;
use Illuminate\Support\Facades\Gate;

class ProgramSponsorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if (! Gate::allows('training_access')) {
            return abort(401);
        }


        $projects = ProgramSponsor::all();

        return view('admin.program_sponsor.index', compact('projects'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('training_access')) {
            return abort(401);
        }
        return view('admin.program_sponsor.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (! Gate::allows('training_create')) {
            return abort(401);
        }
        $type = ProgramSponsor::create($request->all());



        return redirect()->route('admin.program_sponsors.index');
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
        //
    }
	public function massDestroy(Request $request)
    {
        if (! Gate::allows('training_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = TrainingType::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->deletePreservingMedia();
            }
        }
    }
}
