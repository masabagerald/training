<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Mentorship;
use App\MentorshipCategory;
use App\Participant;
use App\Training;
use App\TrainingType;
use Carbon\Carbon;
use ConsoleTVs\Charts\Facades\Charts;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

       


        $events = []; 

        foreach (\App\Mentorship::all() as $mentorship) {
         
           $crudFieldValue = $mentorship->getOriginal('srart_date'); 

           if (! $crudFieldValue) {
               continue;
           }

           $eventLabel     = $mentorship->mentorship_category->name or '';
           $prefix         = '';
           $suffix         = $mentorship->facility->name;
           $dataFieldValue = trim($prefix . " " . $eventLabel . " in " . $suffix);
           $events[]       = [ 
                'title' => $dataFieldValue, 
                'start' => $crudFieldValue, 
                'url'   => route('admin.mentorship.show', $mentorship->id)
           ]; 
        } 

   
        $total_training= Training::all()->count();
        $total_parts = Participant::all()->count();     

        $mentorship = Mentorship::all()->load('mentorship_category');
        

        if(Carbon::now()->month > 6){          

            $start = date('Y').'-07-01';  
            $end =  (date('Y') +1).'-06-31';            

        }else{

            $start= (date('Y')-1).'-07-01';
            $end =  date('Y').'-06-31';
        }
       // dd($end);

 
        switch ($x =Carbon::now()->month) {

            case ($x>=7) && ($x<=9) :

                $quarter = "First";
                $from = date('Y').'-07-01';  
                $to =  date('Y').'-09-31';   
                break;

            case ($x>=10) && ($x<=12) :
                $quarter = "Second";
                $from = date('Y').'-10-01';  
                $to =  date('Y').'-12-31';  
                break;

            case ($x>=1) && ($x<=3) :
                $quarter = "Third";
                $from = date('Y').'-01-01';  
                $to =  date('Y').'-03-31';  
                break;

            case ($x>=4) && ($x<=6) :
                $quarter = "Fourth";
                $from = date('Y').'-04-01';  
                $to =  date('Y').'-06-31';  
                break;                
            
        }

        

        $current_quarter = Mentorship::whereBetween('srart_date', [$from, $to])->get();

        $mentorship= Mentorship::whereBetween('srart_date', [$start, $end])->get();

      //  $trainings = Training::all();
  
    $trainings = DB::table('trainings')
    ->join('training_types','training_types.id' ,'=','trainings.type_of_training')
    ->select('trainings.*','training_types.name as tname')
    ->get();


        $chart3 = Charts::database($mentorship,'bar','highcharts')   
    
          ->dateColumn('created_at')
          ->elementLabel("Mentorhip per month")
          ->dimensions(1000, 500)
          ->responsive(true)
         

          ->title("Monthly Mentorship Report")
            ->GroupBYMonth(date('Y'),true);


        $chart4 = Charts::database($trainings,'bar','highcharts')   

        ->dateColumn('created_at')
        ->elementLabel("Total Training per month")
        ->dimensions(1000, 500)
        ->responsive(true)
        

        ->title("Monthly Training Report")
            ->GroupBYMonth(date('Y'),true);


    $mentortorchip_chart = Charts::database($mentorship, 'pie', 'highcharts')
    ->title("Total Mentorship per Category")
    ->elementLabel("Mentorship per Category")
    ->dimensions(1000, 500)
    ->labels($mentorship->load('mentorship_category'))
    ->responsive(true)
    ->groupBy($mentorship[0]->mentorship_category->name);


    $training_chart = Charts::database($trainings, 'pie', 'highcharts')
    ->title("Training per category")
    ->elementLabel("Training Type")
    ->dimensions(2000, 1000)
    ->responsive(true)
    ->groupBy('tname')
    ;
  
  


    $participant_chart = Charts::database(Participant::all(), 'pie', 'highcharts')
    ->title("Participant by Education level")
    ->elementLabel("Education Level")
    ->dimensions(1000, 500)
    ->responsive(true)
  
    ->groupBy('education_level');


    $participant_sex = Charts::database(Participant::all(), 'pie', 'highcharts')
    ->title("Participant by Gender")
    ->elementLabel("Participants Gender")
    ->dimensions(1000, 500)
    ->responsive(true)
  
    ->groupBy('sex');





   


        


        return view('home',compact('total_parts','current_quarter','events','participant_sex','participant_chart','total_training','chart3','chart4','mentorship','mentortorchip_chart','training_chart'));
    }
}
