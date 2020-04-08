<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Participant;
use App\Training;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $total_training= Training::all()->count();
        $total_parts = Participant::all()->count();

        return view('home',compact('total_parts','total_training'));
    }
}
