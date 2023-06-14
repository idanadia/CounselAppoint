<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    public $table = 'appointments';

    protected $fillable = [
        'appointmentDate',
        'method',
        'clientId',
        'timeslotId',
        'counselorId',
        'status',
    ];

    public function client()
    {
        return $this->belongsTo('App\Models\User', 'clientId');
    }
    public function timeslot()
    {
        return $this->belongsTo('App\Models\Timeslot', 'timeslotId');
    }
    public function counselor()
    {
        return $this->belongsTo('App\Models\User', 'counselorId');
    }

}
