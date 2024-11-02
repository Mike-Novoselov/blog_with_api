<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class user extends Model
{
    use HasFactory;

    /**
    $fillable: Этот массив определяет, какие поля можно массово заполнять (например, при использовании метода create()).
     **/
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    public function user_avatar()
    {
        return $this->hasOne(user_avatar::class);
    }

    public function user_gallery()
    {
        return $this->hasMany(user_gallerie::class);
    }
}
