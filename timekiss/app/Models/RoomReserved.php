<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoomReserved extends Model
{
    protected $table = "room_reserved";
    
    protected $fillable = [
        'bid', 'tid', 'rid', 'oid', 'reservedDate', 'status', 'source',
    ];
}
