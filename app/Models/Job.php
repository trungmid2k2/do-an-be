<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Job extends Model
{
    protected $table = 'jobs';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'id',
        'title',
        'slug',
        'description',
        'requirements',
        'applicationLink',
        'skills',
        'deadline',
        'eligibility',
        'references',
        'status',
        'isActive',
        'isArchived',
        'isPublished',
        'isFeatured',
        'token',
        'rewardAmount',
        'rewards',
        'companyId',
        'pocSocials',
        'pocId',
        'source',
        'sourceDetails',
        'type',
        'applicationType',
        'totalWinnersSelected',
        'region',
        'totalPaymentsMade',
        'isWinnersAnnounced',
        'templateId',
        'timeToComplete',
        'hackathonprize',
    ];

    protected $casts = [
        'eligibility' => 'json',
        'references' => 'json',
        'status' => 'string',
        'skills' => 'json',
        'isActive' => 'boolean',
        'isArchived' => 'boolean',
        'isPublished' => 'boolean',
        'isFeatured' => 'boolean',
        'rewards' => 'json',
        'hackathonprize' => 'boolean',
    ];
    protected $dates = ['deadline'];
    public function setDeadlineAttribute($value)
    {
        $this->attributes['deadline'] = Carbon::parse($value)->toDateTimeString();
    }
    public function company()
    {
        return $this->belongsTo(Company::class, 'companyId');
    }
    public function poc()
    {
        return $this->belongsTo(User::class, 'userId');
    }
    public function subscribes() {
        return $this->hasMany(JobSubcrible::class, 'jobId', 'id');
    }
}
