<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ResultController extends Controller
{
    public function index()
    {
        if (! Gate::allows('designation_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('designation_delete')) {
                return abort(401);
            }
            $results = Result::onlyTrashed()->get();
        } else {
            $results  = Result::all();
        }

        return view('admin.results.index', compact('results'));
    }
}
