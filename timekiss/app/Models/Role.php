<?php

namespace App\Models;

use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole
{
    protected $fillable = [
        'name', 'display_name', 'description',
    ];

    public function permissions(){
        $has_perms = array();
        $permissions = $this->cachedPermissions();
        foreach($permissions as $perm){
            $has_perms[] = $perm->id;
        }

        return $has_perms;
    }
}
