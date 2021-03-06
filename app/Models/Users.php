<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    use HasFactory;
    protected $table = 'users';

    public function userTchat()
    {
        return $this->belongsToMany(Tchat::class, 'tchat_users');
    }
}
