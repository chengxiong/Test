<?php


namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * 用户收藏
 */
class SleepSign extends Model {

  protected $table = "userlike";
  protected $primaryKey = 'id';
  public $timestamps = false;
  protected $fillable = ['id',
    'accountid',
    'type',
    'likeid',
    'createTime',
  ];

}
