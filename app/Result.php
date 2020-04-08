<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    //
    protected $table = 'participant_training';

    protected $fillable = ['participant_id', 'training_id', 'prescore', 'postscore','remarks','comments'];

    public function participant(){

    $this->belongsTo(Participant::class,'participant_id');
    }

    public function training(){

        $this->belongsTo(Training::class,'training_id');
    }

}
