<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserAvatar extends Model
{
    protected $fillable = [
        'user_id',
        'avatar_path'
    ];
}
