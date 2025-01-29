<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FileRfi extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'uuid',
        'name',
        'original_name',
        'path',
        'type_document_id',
        'project_id',
        'user_id',
        'rfi_id',
        'file_comment',
    ];

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
