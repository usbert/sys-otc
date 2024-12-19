<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TypeDocument extends Model
{
    use HasFactory, SoftDeletes;

    public const ACTIVATED = 1;

    protected $fillable = [
        'id',
        'name',
        'code',
    ];

    protected $hidden = [
        'is_activated',

    ];

}
