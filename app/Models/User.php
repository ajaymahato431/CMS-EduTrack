<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'profile_photo_path',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id', 'id');
    }

    public function isAdmin(): bool
    {
        return (int)$this->role_id === 1 || strtolower($this->role?->role_name ?? '') === 'admin';
    }

    public function isTeacher(): bool
    {
        return (int)$this->role_id === 2 || strtolower($this->role?->role_name ?? '') === 'teacher';
    }

    public function isStudent(): bool
    {
        return (int)$this->role_id === 3 || strtolower($this->role?->role_name ?? '') === 'student';
    }

    public function getAvatarUrlAttribute(): string
    {
        if (!empty($this->profile_photo_path)) {
            return asset('storage/' . $this->profile_photo_path);
        }
        return 'https://ui-avatars.com/api/?name=' . urlencode($this->name ?? 'User') . '&background=4f46e5&color=fff&bold=true';
    }
}
