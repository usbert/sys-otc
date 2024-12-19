<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Menu extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    protected $hidden = [
        'order_by',
        'comment',
        'is_activated',

    ];

}
