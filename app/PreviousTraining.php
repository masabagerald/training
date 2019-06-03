<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PreviousTraining extends Model
{
    //
    protected $fillable = ['participant_id', 'training', 'date', 'organization'];
}
