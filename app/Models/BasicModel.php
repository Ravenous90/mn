<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class BasicModel extends Model
{
    protected $fillable
        = [
            'title',
            'date',
            'sum',
            'user_id'
        ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'users');
    }
}
