<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoomImage extends Model
{
    protected $table = "rooms_image";
    
    protected $fillable = [
        'rid','url',
    ];
}
