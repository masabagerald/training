<?php

namespace App\Http\Controllers\Admin;

use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreRolesRequest;
use App\Http\Requests\Admin\UpdateRolesRequest;
use App\Region;

class RegionsController extends Controller
{
    /**
     * Display a listing of Role.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('training_access')) {
            return abort(401);
        }


        $regions = Region::all();

        return view('admin.regions.index', compact('regions'));
    }

    /**
     * Show the form for creating new Role.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('training_create')) {
            return abort(401);
        }
        return view('admin.regions.create');
    }

    /**
     * Store a newly created Role in storage.
     *
     * @param  \App\Http\Requests\StoreRolesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (! Gate::allows('training_create')) {
            return abort(401);
        }
        $region = Region::create($request->all());

        return redirect()->route('admin.regions.index');
    }


    /**
     * Show the form for editing Role.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('training_edit')) {
            return abort(401);
        }
   

        $region = Region::findOrFail($id);

        return view('admin.regions.edit', compact('region'));
    }

  

    public function update(Request $request, $id)
    {
        if (! Gate::allows('training_edit')) {
            return abort(401);
        }
      
        $region = Region::findOrFail($id);
        $region->update($request->all());



        return redirect()->route('admin.regions.index');
    }


    /**
     * Display Role.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('training_view')) {
            return abort(401);
        }
      
        $regions = Region::findOrFail($id);

        return view('admin.regions.show', compact('regions'));
    }


    /**
     * Remove Role from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('training_delete')) {
            return abort(401);
        }
        $region = Region::findOrFail($id);
        $region->delete();

        return redirect()->route('admin.regions.index');
    }

    /**
     * Delete all selected Role at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
       if (! Gate::allows('training_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Region::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

}
