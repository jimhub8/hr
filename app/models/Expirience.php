<?php

namespace App\models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Expirience extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
