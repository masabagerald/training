<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class SystemCalendarController extends Controller
{
    public function index() 
    {
        $events = []; 

        foreach (\App\Training::all() as $training) { 
           $crudFieldValue = $training->getOriginal('start_date'); 

           if (! $crudFieldValue) {
               continue;
           }

           $eventLabel     = $training->type->name or '';
           $prefix         = '';
           $suffix         = $training->venue;
           $dataFieldValue = trim($prefix . " " . $eventLabel . " in " . $suffix);
           $events[]       = [ 
                'title' => $dataFieldValue, 
                'start' => $crudFieldValue, 
                'url'   => route('admin.trainings.show', $training->id)
           ]; 
        } 


       return view('admin.calendar' , compact('events')); 
    }

}
