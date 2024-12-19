<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vehicle extends Model
{
    use SoftDeletes;

    public const ACTIVATED = 1;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'company_id',
        'model_id',
        'tank_capacity',
        'prefix',
        'sequencial',

        'tag',
        'renavam',
        'vin_number',
        'manufacture_year',
        'model_year',

        'supplyer_id',
        'fuel_id',
        'unit_measure',
        'project_id',
        'client_id',
        'driver_id',
        // 'waiting_driver',
        'activity_id',
        'unit_measure',
        'has_km',
        'has_hr',
        'status_id',
        'user_id',
        'km_control',       // VALOR
        'hour_control',     // VALOR

        // NA APROVAÇÃO
        'has_kpi_report',
        'has_implement',
        'implement_value',
        'body_value',
        // 'have_radio',
        'telemetry_number',
        'telemetry_install_date',
        'telemetry_uninstall_date',
        'comment',
        // 'auto_created_at',
        'is_approved',
        'sent_for_approval',
        'released_for_rental',
        'conversion_factor',
        'has_daily_control',
        'created_at',
        //

    ];

    public function Project()
    {
        return $this->belongsTo(Project::class, 'project_id', 'id');
    }
    public function Supplyer()
    {
        return $this->belongsTo(Supplyer::class, 'supplyer_id', 'id');
    }
    public function Model()
    {
        return $this->belongsTo(EquipmentModel::class, 'equipment_model_id', 'id');
    }


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'is_activated',
        'deleted_at',
        'updated_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [

    ];

}
