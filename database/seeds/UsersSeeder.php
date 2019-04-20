<?php

use Illuminate\Database\Seeder;

use\App\Role;
use\App\User;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $adminRole = new Role();
        $adminRole->name = "pemilik";
        $adminRole->display_name = "Pemilik Toko";
        $adminRole->save();
        //Membuat role member
        $memberRole = new Role();
        $memberRole->name = "penjaga";
        $memberRole->display_name = "Penjaga Toko";
        $memberRole->save();
        //Membuat sample admin
        $admin = new User();
        $admin->name = 'Administrator';
        $admin->email = 'admin@aisyah.com';
        $admin->password = bcrypt('AdminAi123');
        $admin->save();
        $admin->attachRole($adminRole);
        //Membuat sample user
        $member = new User();
        $member->name = "Member Aisyah";
        $member->email = "member@aisyah.com";
        $member->password = bcrypt('member123');
        $member->save();
        $member->attachRole($memberRole);
    }
}
