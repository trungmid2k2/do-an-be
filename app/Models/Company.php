<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'logo',
        'url',
        'industry',
        'twitter',
        'bio',
        
    ];

    protected $table = 'companies';

    // Define any relationships if needed, for example:
    // public function employees() {
    //     return $this->hasMany(Employee::class);
    // }
}
