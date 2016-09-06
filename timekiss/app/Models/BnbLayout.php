<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BnbLayout extends Model
{
    protected $table = "bnb_layout";
    
    protected $fillable = [
        'bid','name','introduction'
    ];
    
}
