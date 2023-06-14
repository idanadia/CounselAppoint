<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    public $table = 'reports';

    protected $fillable = [
        'appointmentId',
        'report',
        'counselorId',
        'clientId',
        'attachment',
    ];
    public function appointment()
    {
        return $this->belongsTo('App\Models\Appointment', 'appointmentId');
    }
    public function client()
    {
        return $this->belongsTo('App\Models\User', 'clientId');
    }

    public function counselor()
    {
        return $this->belongsTo('App\Models\User', 'counselorId');
    }

}
