<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    public $table = 'clients';

    protected $fillable = [
        'counselorId',
        'clientId',
    ];

    public function client()
    {
        return $this->belongsTo('App\Models\User', 'clientId');
    }

    public function counselor()
    {
        return $this->belongsTo('App\Models\User', 'counselorId');
    }

}
