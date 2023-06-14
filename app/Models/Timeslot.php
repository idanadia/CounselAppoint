<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Timeslot extends Model
{
    public $table = 'timeslots';

    protected $fillable = [
        'counselorId',
        'startTime',
        'endTime',
        'isActive',
    ];
    public function counselor()
    {
        return $this->belongsTo('App\Models\User', 'counselorId');
    }
}
