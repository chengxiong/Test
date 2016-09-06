<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * 账户基本信息
 */
class AccountModel extends Model {

  protected $table = 'account';
  protected $primaryKey = 'accountId';
  public $timestamps = false;
  protected $fillable = ['accountId',
    'telephone', 'username', 'password',
    'uuid', 'registerTime', 'lastLoginTime',
    'birthday', 'starSigns', 'profession',
    'email', 'avatar', 'slogan', 'gender', 'timezone','token','status'
  ];

}
