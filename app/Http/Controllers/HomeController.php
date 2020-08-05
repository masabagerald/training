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

       //dd(Carbon::now()->month > 6); 
        $total_training= Training::all()->count();
        $total_parts = Participant::all()->count();



       // $mentorship = Mentorship::with('mentorship_category.name')->get();

        $mentorship = Mentorship::all()->load('mentorship_category');

        

        if(Carbon::now()->month > 6){
            

           // $from = new Carbon(date('Y').'-07-01');
            $from = '01-07-'.date('Y');
           // $to = new Carbon((date('Y')+1).'-06-31');
            $to =  '31-06-'.(date('Y') +1);            

        }else{

            $from = '01-07'.(date('Y')-1);
            $to =  '31-06'.date('Y');

        }

        

        

       

        $mentorship= Mentorship::whereBetween('srart_date', [$from, $to])->get();

        

  

        $trainings = Training::all();

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
    ->groupBy('category');


    $training_chart = Charts::database($trainings, 'pie', 'highcharts')
    ->title("Training per Type")
    ->elementLabel("Training Type")
    ->dimensions(1000, 500)
    ->responsive(true)
  
    ->groupBy('type_of_training');


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





   


        


        return view('home',compact('total_parts','participant_sex','participant_chart','total_training','chart3','chart4','mentorship','mentortorchip_chart','training_chart'));
    }
}
