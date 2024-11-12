<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    // Этот массив определяет, какие поля можно массово заполнять (например, при использовании метода create()).
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    public function userAvatar()
    {
        return $this->hasOne(UserAvatar::class);
    }

    public function gallery()
    {
        return $this->hasMany(Gallery::class);
    }
}
