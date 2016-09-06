<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoomTkOwned extends Model
{
    protected $table = "rooms_tkOwned";
    
    protected $fillable = [
        'rid', 'tkTime'
    ];
}
