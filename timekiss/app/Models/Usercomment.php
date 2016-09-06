<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * 用户评论
 */
class SleepSign extends Model {

  protected $table = "usercomment";
  protected $primaryKey = 'id';
  public $timestamps = false;
  protected $fillable = ['id',
    'accountid',
    'username',
    'bid',
    'type',
    'module',
    'source',
    'status',
    'content',
    'createTime',
  ];

}
