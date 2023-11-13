<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments'; // Set the table name explicitly (optional if following Laravel naming conventions)

    protected $fillable = [
        'message',
        'authorId',
        'jobId',
        'isActive',
        'isArchived',
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'authorId'); // Assuming 'User' is the model representing users
    }

    public function job()
    {
        return $this->belongsTo(Job::class, 'jobId'); // Assuming 'Job' is the model representing jobs
    }
}
