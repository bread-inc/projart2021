<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database. Are created by the seeders :
     * 
     * - 1 admin & 14 users
     * 
     * - 6 regions
     * - 8 quizzes
     * - 30 questions
     * - 90 clues
     * 
     * - 50 random scores for random quizzes and users
     * - 8 random assignations of quizzes to users, as favorites
     * 
     * - 8 badges
     * - 1 random assignation of each badge to 1 user
     *
     * @return void
     */
    public function run()
    {

        $this->call(UsersTableSeeder::class);
        $this->call(RegionsTableSeeder::class);
        $this->call(QuizzesTableGlobalSeeder::class);
        /*
        $this->call(QuizzesTableSeeder::class);
        $this->call(QuestionsTableSeeder::class);
        $this->call(CluesTableSeeder::class);
        */
        $this->call(ScoresTableSeeder::class);
        $this->call(BadgesTableSeeder::class);
        $this->call(BadgeUserTableSeeder::class);
        $this->call(FavoritesTableSeeder::class);
    }
}