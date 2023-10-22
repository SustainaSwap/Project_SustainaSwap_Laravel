<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    // use HasFactory;
    protected $fillable = ['user_id', 'message', 'name'];


    
    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

}
