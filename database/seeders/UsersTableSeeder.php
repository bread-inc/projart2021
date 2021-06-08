<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('users')->delete();

        // Creating admin
        DB::table('users')->insert([
            'pseudo' => 'admin',
            'email' => 'admin@gmx.ch',
            'password' => Hash::make('admin'),
            'avatar' => "http://gravatar.com/avatar/" . md5(strtolower(trim('admin@gmx.ch'))) . "?size=64&d=identicon",
            'isAdmin' => 1]
        );

        // Creating 4 other users
        for ($i=2; $i <= 5; $i++) { 
            DB::table('users')->insert([
                'pseudo' => 'user' . $i,
                'email' => 'user' . $i . '@gmx.ch',
                'password' => Hash::make('user' . $i),
                'avatar' => "http://gravatar.com/avatar/" . md5(strtolower(trim('user' . $i . '@gmx.ch'))) . "?size=64&d=identicon",
                'isAdmin' => 0 ]
            );
        }
    }
}
