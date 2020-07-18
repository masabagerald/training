<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Participant;

class Mentorship extends Model
{

    protected $fillable = ['title','srart_date','end_date','facility_name','category'];
    public static function boot()
    {
        parent::boot();

        Training::observe(new \App\Observers\UserActionsObserver);
    }


    public function participants()
    {
        return $this->belongsToMany(Participant::class,'mentorship_participant')
          ->withPivot('notes')
           ->withTimestamps();
    }

    public function mentorship_category(){

        return $this->belongsTo(MentorshipCategory::class,'category');
    }

    public function facility(){

        return $this->belongsTo(Facility::class,'facility_name');
    }


   
   
    // title, srart_date, end_date, facility_name, issues_arising, positive_findings, improvement_areas, recommendations, qi_started, notes,
}
