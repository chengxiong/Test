<?php

/*
 *  相似民宿
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

class BnbSimilar extends Model {

  protected $table = "bnb_similar";
  protected $primaryKey = 'bid';
  public $timestamps = false;
  protected $fillable = [
    'bid',
    'sbid'];

}
