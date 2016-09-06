<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hoster extends Model
{
  protected $table = "hoster";
  
  protected $primaryKey = 'hid';
  
  public $timestamps = false;
  
  protected $fillable = [
      'accountid', 'name', 'gender','telephone','weixin','age','maritalStatus','feature','image','photo','description','nickname'
  ];
  
  public function role(){
      return $this->hasMany('App\Models\BnbHoster','hid', 'hid');
  }
}
