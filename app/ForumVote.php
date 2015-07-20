<?php

namespace CF;

use Illuminate\Database\Eloquent\Model;

class ForumVote extends Model
{
    protected $fillable = ['user_id', 'message_id', 'vote'];
}
