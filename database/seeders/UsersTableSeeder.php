<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    private $defaultUsersList = ['admin', 'user'];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('users')->delete();
        foreach($this->defaultUsersList as $newUser) {
            DB::table('users')->insert([
                'pseudo' => $newUser,
                'email' => $newUser . '@gmx.ch',
                'password' => Hash::make($newUser),
                'avatar' => "http://gravatar.com/avatar/" . md5(strtolower(trim($newUser . '@gmx.ch'))) . "?size=64&d=identicon",
                'isAdmin' => $newUser == "admin" ? 1 : 0 ]);
        }
    }
}
