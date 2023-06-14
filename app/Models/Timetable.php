<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Timetable extends Model
{
    public $table = 'student_timetables';

    protected $fillable = [
        'user_id','subject_id',
        'day_id',
        'lecture_hall_id',
        'group_id',
        'time_from',
        'time_to',
    ];

    public function hall(){
        return $this->belongsTo('App\Hall', 'lecture_hall_id');
    }
    
    public function subject(){
        return $this->belongsTo('App\Subject', 'subject_id');
    }

    public function day(){
        return $this->belongsTo('App\Day', 'day_id');
    }

    
}

