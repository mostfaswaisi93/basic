<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes, HasRoles;

    protected $table    = 'users';
    protected $fillable = [
        'first_name', 'last_name', 'email', 'image', 'enabled', 'password',
        'last_login_at', 'last_login_ip'
    ];
    protected $appends  = ['image_path', 'full_name', 'last_login', 'created_date', 'deleted_date'];
    protected $hidden   = ['password', 'remember_token'];
    protected $casts    = [
        'email_verified_at' => 'datetime', 'created_at' => 'date:Y-m-d - H:i A',
        'updated_at' => 'date:Y-m-d - H:i A', 'deleted_at' => 'date:Y-m-d - H:i A', 'last_login_at' => 'date:Y-m-d - H:i A'
    ];
    protected $dates    = ['created_at', 'updated_at', 'deleted_at', 'last_login_at'];

    public function getFullNameAttribute()
    {
        return ucfirst($this->first_name) . ' ' . ucfirst($this->last_name);
    }

    public function getImagePathAttribute()
    {
        return asset('images/users/' . $this->image);
    }

    public function getCreatedDateAttribute()
    {
        return Carbon::parse($this->created_at)->diffForHumans(Carbon::now());
    }

    public function getDeletedDateAttribute()
    {
        return Carbon::parse($this->deleted_at)->diffForHumans(Carbon::now());
    }

    public function getLastLoginAttribute()
    {
        return Carbon::parse($this->last_login_at)->diffForHumans(Carbon::now());
    }
}
