<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BnbContent extends Model {

  protected $table = 'bnb_content';
  protected $primaryKey = 'id';
  public $timestamps = false;
  
  protected $fillable=[
      'bid', 'content'
  ];
    public function bnb(){
         return $this->hasOne('App\Models\Bnb','bid','bid');
     }
}
