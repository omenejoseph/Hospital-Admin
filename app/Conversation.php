<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    //
    protected $fillable = [
        'subject',
        'body',
        'sender_id',
        'receiver_id',
        'last_seen',
    ];
}
