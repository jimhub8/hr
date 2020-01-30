<?php

namespace App\models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Personal extends Model
{
    public function user()
    {
        return $this->hasOne(User::class);
    }
}
