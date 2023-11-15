<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobSubcrible extends Model
{
    protected $table = 'subscribejobs'; // Đảm bảo Eloquent biết bảng mà model này tham chiếu đến

    protected $fillable = [
        'email',
        'phoneNumber',
        'otherInfo',
        'userId',
        'jobId',
        'isChosen',
        'isActive'
    ];
    protected $casts = [
        'isChosen' => 'boolean',
        'isActive' => 'boolean',
    ];
    // Khai báo mối quan hệ với bảng 'users'
    public function user()
    {
        return $this->belongsTo(User::class, 'userId', 'id');
    }

    // Khai báo mối quan hệ với bảng 'jobs'
    public function job()
    {
        return $this->belongsTo(Job::class, 'jobId', 'id');
    }
}
