<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    private $users = [
        "GuyParleAMaMain",
        "LaureDinateur",
        "kmi",
        "al1Beret",
        "yvanDesPatates",
        "Xx_d4rkSasuk3_xX",
        "Mart1Teb1",
        "mikk3l-nick3l",
        "AlbertLeVert",
        "Kev1LePainPerdu",
        "MaikelBridge",
        "PaulineBoite",
        "V1centTim"
    ];

    /**
     * Create the admin user and 14 other users.
     *
     * @return void
     */
    public function run() {
        DB::table('users')->delete();

        
        DB::table('users')->insert([
            'pseudo' => 'admin',
            'email' => 'admin@gmx.ch',
            'password' => Hash::make('admin'),
            'avatar' => "http://gravatar.com/avatar/" . md5(strtolower(trim('admin@gmx.ch'))) . "?size=256&d=robohash",
            'isAdmin' => 1]
        );

        // Creating default user
        DB::table('users')->insert([
            'pseudo' => 'user',
            'email' => 'user@gmx.ch',
            'password' => Hash::make('user'),
            'avatar' => "http://gravatar.com/avatar/" . md5(strtolower(trim('user@gmx.ch'))) . "?size=256&d=robohash",
            'isAdmin' => 0]
        );

        // Creating 13 other users
        foreach ($this->users as $user) {
            DB::table('users')->insert([
                'pseudo' => $user,
                'email' => $user . '@gmx.ch',
                'password' => Hash::make($user),
                'avatar' => "http://gravatar.com/avatar/" . md5(strtolower(trim($user . '@gmx.ch'))) . "?size=256&d=robohash",
                'isAdmin' => 0 ]
            );
        }
    }
}
