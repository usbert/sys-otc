<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{
    use HasFactory, SoftDeletes;

    public const ACTIVATED = 1;

    protected $fillable = [
        'id',
        'name',
        'client_id',
        'employee_role_id',
		'phone',
		'email',
    ];

    protected $hidden = [
        'is_activated',

    ];

}
