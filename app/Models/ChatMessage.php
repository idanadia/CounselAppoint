<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class ChatMessage extends Model
{
    public $table = 'chatMessages';

    protected $fillable = [
        'senderId',
        'receiverId',
        'message',
        'isSeen',
    ];

    public function sender()
    {
        return $this->belongsTo(User::class, 'senderId');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiverId');
    }
}
