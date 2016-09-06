<?php

/*
 * 原有账户旧数据
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AccountPreviousModel extends Model {

    protected $table = 'account_previous';
    protected $primaryKey = 'id';
    protected $fillable = [];

}
