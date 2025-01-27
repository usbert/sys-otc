<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RfiOverview extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'rfi_id',
        'user_id',
        'question',
        'sugestion',
        'client_answear',
        'cost_impact',
        'schedule_impact',
        'deadline',
        'status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [

    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [

    ];

}
