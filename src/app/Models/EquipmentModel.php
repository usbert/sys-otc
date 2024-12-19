<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;

class EquipmentModel extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $fillable = [
        'id',
        'equipment_prefix_id',
        'prefix',
        'equipment_brand_id',
        'equipment_family_id',
        'name',
        'weight_measurment',
        'unit1',
        'capacity_measurment',
        'unit2',
        'power_measurment',
        'unit3',
        'tank_capacity',
        'type'
    ];

    public function EquipmentPrefix() {
        return $this->belongsTo(EquipmentPrefix::class, 'equipment_prefix_id', 'id');
    }
    public function Brand() {
        return $this->belongsTo(Brand::class, 'equipment_brand_id', 'id');
    }
    public function EquipmentFamily() {
        return $this->belongsTo(EquipmentFamily::class, 'equipment_family_id', 'id');
    }



    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'equipment_family_id',
        'user_id_created',
        'user_id_deleted',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [

    ];

}
