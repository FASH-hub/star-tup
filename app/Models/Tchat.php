<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tchat extends Model
{
    use HasFactory;
    protected $tchat = 'tchats';

    public function tchatByUser()
    {
        return $this->belongsToMany(Users::class, 'tchats_Users');
    }
}
