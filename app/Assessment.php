<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Assessment extends Model 
{

    protected $table = 'assessments';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array('date', 'department', 'challenges', 'recommendation');

    public function interviewee()
    {
        return $this->belongsTo('App\Interviewee', 'interviewee_id');
    }

    public function category()
    {
        return $this->belongsToMany(Subcategory::class)
            ->withPivot('how_often','previous_attendance','mentorship','better_quality','recommend_others')
            ->withTimestamps();
    }

}