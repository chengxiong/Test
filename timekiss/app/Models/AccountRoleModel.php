<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AccountRoleModel extends Model {

    protected $table = 'account_role';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'accountId', 'role'];

    /**
     * 获得用户拥有角色
     * 
     * @param int $basicId
     * @return 
     */
    public function getRole($basicId) {
        $result = DB::table($this->table)
                ->where('accountId', $basicId)
                ->get();
        return $result;
    }

}
