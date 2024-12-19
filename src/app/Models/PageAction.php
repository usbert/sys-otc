<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class PageAction extends Authenticatable
{
    use HasFactory;

    protected $fillable = [

    ];

    protected $hidden = [
        'is_activated'
    ];

    public function menu() {
        return $this->hasMany(Menu::class, 'id', 'menu_id' );
    }

    public function action() {
        return $this->hasMany(Action::class, 'id', 'action_id' );
    }


}
