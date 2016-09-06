<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * 睡签
 */
class Appupgrade extends Model {

  protected $table = "appupgrade";
  protected $primaryKey = 'id';
  public $timestamps = false;
  protected $fillable = ['id',
    'upgradeflag',
    'version',
    'platform',
    'url',
    'title',
    'description',
    'userId',
    'userName',
    'createDate',
  ];

}
