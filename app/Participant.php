<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMedia;

/**
 * Class Participant
 *
 * @package App
 * @property string $first_name
 * @property string $middle_name
 * @property string $last_name
 * @property string $mobile
 * @property enum $sex
 * @property string $dob
 * @property string $health_facility
 * @property string $postal_address
 * @property string $physical_addr
 * @property string $district
 * @property string $subcounty
 * @property string $parish
 * @property string $job_title
 * @property string $profession
 * @property string $previous_training
 * @property string $education_level
 * @property text $comments
 * @property string $photo
*/
class Participant extends Model implements HasMedia
{
    use SoftDeletes, HasMediaTrait;

    protected $fillable = ['first_name', 'middle_name', 'last_name', 'mobile',
        'sex', 'dob', 'health_facility', 'postal_address', 'district', 'subcounty', 'parish',
        'profession', 'previous_training', 'education_level', 'comments', 'photo',
        'physical_addr_address', 'physical_addr_latitude', 'physical_addr_longitude', 'job_title_id','pin'];
    protected $hidden = [];
    
    
    public static function boot()
    {
        parent::boot();

        Participant::observe(new \App\Observers\UserActionsObserver);
    }

    public static $enum_sex = ["male" => "Male", "female" => "Female"];

    /**
     * Set attribute to date format
     * @param $input
     */
    public function setDobAttribute($input)
    {
        if ($input != null && $input != '') {
            $this->attributes['dob'] = Carbon::createFromFormat(config('app.date_format'), $input)->format('Y-m-d');
        } else {
            $this->attributes['dob'] = null;
        }
    }

    /**
     * Get attribute from date format
     * @param $input
     *
     * @return string
     */
    public function getDobAttribute($input)
    {
        $zeroDate = str_replace(['Y', 'm', 'd'], ['0000', '00', '00'], config('app.date_format'));

        if ($input != $zeroDate && $input != null) {
            return Carbon::createFromFormat('Y-m-d', $input)->format(config('app.date_format'));
        } else {
            return '';
        }
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setJobTitleIdAttribute($input)
    {
        $this->attributes['job_title_id'] = $input ? $input : null;
    }
    
    public function job_title()
    {
        return $this->belongsTo(Designation::class, 'job_title_id')->withTrashed();
    }

    public function trainings()
    {
        return $this->belongsToMany(Participant::class,'participant_training')
            ->withPivot('remarks','comments','pre_test','post_test','position','facility')
            ->withTimestamps();


    }
    public function previousTraining()
    {
        return $this->hasMany(PreviousTraining::class);
    }
    
}
