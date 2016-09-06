<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Models\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create(array(
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('abc123'),
        ));

        $role = Role::create(array(
            'name'    => 'administrators',
            'display_name'    => '系统管理员',
        ));

        $user->roles()->attach($role->id);
    }
}
