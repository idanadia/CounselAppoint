<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inspection extends Model
{
    public $table = 'inspections';

    protected $fillable = [
        'user_id',
        'symptom1',
        'symptom2',
        'symptom3',
        'symptom4',
        'symptom5',
        'symptom6',
        'symptom7',
        'symptom8',
        'symptom9',
        'symptom10',
        'symptom11',
        'symptom12',
        'symptom13',
        'symptom14',
        'noOfSymptoms',
        'result',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    // public function subject(){
    //     return $this->belongsTo('App\Subject', 'subject_id');
    // }

    // public function day(){
    //     return $this->belongsTo('App\Day', 'day_id');
    // }

}
