<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PasswordReset extends Model
{
    public $table = "forgot_password"; // "forgot_password
    protected $fillable = [
        'email',
        'token',
    ];
}
