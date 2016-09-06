<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BnbHoster extends Model {

    protected $table = 'bnb_hoster';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'bid', 'hid', 'role','createTime'
    ];

}
