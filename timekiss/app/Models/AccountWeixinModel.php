<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AccountWeixinModel extends Model {

    protected $table = 'account_weixin';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'accountId',
        'WXopenid', 'WXnickname', 'WXsex',
        'WXprovince', 'WXcity', 'WXcountry',
        'WXheadimgurl', 'WXprivilege', 'WXunionid',
        'createAt'
    ];
}
