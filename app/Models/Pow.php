<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pow extends Model
{

    protected $fillable = ['userId', 'title', 'description', 'skills', 'subSkills', 'link'];

    protected $casts = [
        'skills' => 'json',
        'subSkills' => 'json',
    ];
}
