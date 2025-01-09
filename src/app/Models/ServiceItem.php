<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class ServiceItem extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'user_id',
        'pco_id',
        'level_01',
        'level_02',
        'level_03',
        'identification_level',
        'item_number',
        'item_description',
        'item_cost',

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'is_activated',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [

    ];

}
