<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    
    protected $fillable = ['training_name','training_type', 'training_objectives', 'training_venue', 'start_date', 'end_date', 'expected_outcome', 'challenges', 'recommendation', 'participants_list', 'facilitators_list','captured_by'];
}
