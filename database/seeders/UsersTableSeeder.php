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
                'isAdmin' => $newUser == "admin" ? 1 : 0 ]);
        }
    }
}
