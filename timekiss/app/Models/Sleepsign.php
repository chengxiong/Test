<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * 睡签
 */
class Sleepsign extends Model {

  protected $table = "sleepsign";
  protected $primaryKey = 'id';
  public $timestamps = false;
  protected $fillable = ['id',
    'url',
    'createTime',
    'crmUserid',
    'crmUserName',
  ];

}
