<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Designation
 *
 * @package App
 * @property string $name
*/
class Designation extends Model
{
    use SoftDeletes;

    protected $fillable = ['name'];
    protected $hidden = [];
    
    
    public static function boot()
    {
        parent::boot();

        Designation::observe(new \App\Observers\UserActionsObserver);
    }
    
    public function participants() {
        return $this->hasMany(Participant::class, 'job_title_id');
    }
}
