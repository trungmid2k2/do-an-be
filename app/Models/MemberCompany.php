<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemberCompany extends Model
{

    protected $table = 'members_companies';

    protected $fillable = [
        'userId',
        'companyId',
        'role',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'userId'); 
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'companyId');
    }
}
