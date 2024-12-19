<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;

class MobilizationHistoric extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'vehicle_id',
        'cd_veic_status',
        'cd_projeto_requested',             // Projeto solicitado para transferência
        'project_id',                       // Projeto (aprovado)
        'mobilization_date_requested',      // Data de mobilização solicitada
        'mobilization_date',                // Data de mobilização (aprovado)
        'demobilization_date_requested',    // Data de desmobilização solicitada
        'demobilization_date',              // Data de desmobilização (aprovado)
        'status_id',
        'km_control_requested',             // Km de Atual/Transferência solicitado
        'km_control',                       // Km de Atual/Transferência (aprovado)
        'km_return_requested',              // Km de Devolução
        'km_return',                        // Km de Devolução  (aprovado)
        'hour_control_requested',           // horímetro de Atual/Transferência solicitado
        'hour_control',                     // horímetro de Atual/Transferência (aprovado)
        'hour_control_return_requested',    // Horímetro Devolução (aprovado)
        'hour_control_return',              // Horímetro Devolução
        'user_id_return_requested',         // Usuário que solicitou desmobilização
        'user_id_return',                   // Usuário que desmobilizou
        'request_status',                   // Status Aguardando Desmobilização ou Aguardando Transferência (AD / AT)
        'user_id_approver',                 // Usuário que aprovou
        'demobilization_date_created',
        'demobilization_approval_date',
        'user_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'is_activated',
        'created_at',
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
