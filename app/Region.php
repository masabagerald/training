<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    //

    protected $fillable = ['name'];  
    
    
    public static function boot()
    {
        parent::boot();

        Region::observe(new \App\Observers\UserActionsObserver);
    }
}
