<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PriceTag extends Model
{
    protected $table = "pricetag";
    
    protected $fillable = [
        'rid','price','priceDate','source','actionUserId'
    ];
}
