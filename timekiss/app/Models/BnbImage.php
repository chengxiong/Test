<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BnbImage extends Model {

  protected $table = "bnb_image";
  protected $primaryKey = 'id';
  public $timestamps = false;

  protected $fillable=[
      'bid', 'url', 'type'
  ];
    public function bnb(){
         return $this->hasOne('App\Models\Bnb','bid','bid');
     }
}
