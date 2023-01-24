<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Symfony\Component\HttpKernel\Profiler\Profile;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, Uuid;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'uuid',
        'email',
        'password',
        'role'
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
        'email_verified_at' => 'datetime',
    ];

    public function operator()
    {
        return $this->hasOne(Operator::class);
    }

    public function awardee()
    {
        return $this->hasOne(Awardee::class);
    }

    public function document()
    {
        return $this->hasMany(Document::class);
    }

    public function routeNotificationForWhatsApp()
    {
        return $this->awardee->phone;
    }

    public function routeNotificationForOrangTua()
    {
        return $this->awardee->parent->phone;
    }

    public function hasRole($role)
    {
        if (is_array($role)) {
            foreach ($role as $r) {
                if ($this->role == $r) {
                    return true;
                }
            }
        } else {
            return $this->role == $role;
        }

        return false;
    }
}
