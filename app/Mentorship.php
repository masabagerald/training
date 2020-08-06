<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Participant;
use Carbon\Carbon;

class Mentorship extends Model
{

    protected $fillable = ['title','srart_date','end_date',
    'facility_name','category','issues_arising','positive_findings',
    'improvement_areas','recommendations','qi_started','notes'];
    public static function boot()
    {
        parent::boot();

        Mentorship::observe(new \App\Observers\UserActionsObserver);
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

    public function tutors(){

        return $this->belongsToMany(User::class,'mentorship_tutors')
          ->withPivot('notes')
           ->withTimestamps();
    }

    public function setSrartDateAttribute($input)
    {
        if ($input != null && $input != '') {
            $this->attributes['srart_date'] = Carbon::createFromFormat(config('app.date_format'), $input)->format('Y-m-d');
        } else {
            $this->attributes['srart_date'] = null;
        }
    }

    /**
     * Get attribute from date format
     * @param $input
     *
     * @return string
     */
    public function getSrartDateAttribute($input)
    {
        $zeroDate = str_replace(['Y', 'm', 'd'], ['0000', '00', '00'], config('app.date_format'));

        if ($input != $zeroDate && $input != null) {
            return Carbon::createFromFormat('Y-m-d', $input)->format(config('app.date_format'));
        } else {
            return '';
        }
    }

    /**
     * Set attribute to date format
     * @param $input
     */
    public function setEndDateAttribute($input)
    {
        if ($input != null && $input != '') {
            $this->attributes['end_date'] = Carbon::createFromFormat(config('app.date_format'), $input)->format('Y-m-d');
        } else {
            $this->attributes['end_date'] = null;
        }
    }

    /**
     * Get attribute from date format
     * @param $input
     *
     * @return string
     */
    public function getEndDateAttribute($input)
    {
        $zeroDate = str_replace(['Y', 'm', 'd'], ['0000', '00', '00'], config('app.date_format'));

        if ($input != $zeroDate && $input != null) {
            return Carbon::createFromFormat('Y-m-d', $input)->format(config('app.date_format'));
        } else {
            return '';
        }
    }

   
  
}
