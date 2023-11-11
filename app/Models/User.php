<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject, MustVerifyEmail
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'publicKey',
        'email',
        'username',
        'password',
        'photo',
        'firstname',
        'lastname',
        'isVerified',
        'role',
        'totalEarned',
        'isTalentFilled',
        'interests',
        'bio',
        'twitter',
        'discord',
        'github',
        'linkedin',
        'website',
        'telegram',
        'experience',
        'level',
        'location',
        'workPrefernce',
        'currentEmployer',
        'notifications',
        'private',
        'skills',
        'currentCompanyId',
    ];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'isVerified'=>'boolean',
        'isTalentFilled'=>'boolean',
        'private'=>'boolean',
        'interests'=> 'json',
        'skills'=>'json',
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Get the JWT identifier.
     */
    public function getJWTIdentifier(): mixed
    {
        return $this->getKey();
    }

    /**
     * Get the JWT custom claims.
     */
    public function getJWTCustomClaims(): array
    {
        return [];
    }
    public function currentCompany()
    {
        return $this->belongsTo(Company::class, 'id');
    }
}
