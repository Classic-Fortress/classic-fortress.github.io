<?php

namespace CF;

use Illuminate\Database\Eloquent\Model;

class Ping extends Model
{
    protected $fillable = ['reciever_id', 'pinger_id', 'message_id'];
}
