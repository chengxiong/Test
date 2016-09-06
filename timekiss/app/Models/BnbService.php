<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class BnbService extends Model
{
     protected $table = 'bnb_service';
 
     protected $fillable = [
         'bid', 'name', 'imgs', 'createDate',
     ];
 
     public function bnb(){
         return $this->hasOne('App\Models\Bnb','bid','bid');
     }
     
     public function service(){
         return $this->hasOne('App\Models\Service','sid','id');
     }
     
}
