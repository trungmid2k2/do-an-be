<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemberInvite extends Model
{
    protected $table = 'members_invites'; // Specify the table name if it differs from the model's name

    protected $fillable = [
        'email',
        'senderId',
        'companyId',
        'memberType',
    ];
    public function sender()
    {
        return $this->belongsTo(User::class, 'senderId', 'id');
    }
    public function company()
    {
        return $this->belongsTo(Company::class, 'companyId', 'id');
    }
}
