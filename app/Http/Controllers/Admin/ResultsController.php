<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\StoreResultsRequest;
use App\Participant;
use App\Result;
use App\Training;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class ResultsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $results = Result::all();

        return view('admin.results.index', compact('results'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $participants = \App\Participant::get()->pluck('first_name', 'id')->prepend(trans('quickadmin.qa_please_select'), '');
        $trainings = \App\Training::get()->pluck('type_of_training', 'id')->prepend(trans('quickadmin.qa_please_select'), '');
        return view('admin.results.create',compact('participants','trainings'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $result= Result::create($request->all());

        return redirect()->route('admin.results.index');
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
        if (! Gate::allows('designation_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Result::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }
}
