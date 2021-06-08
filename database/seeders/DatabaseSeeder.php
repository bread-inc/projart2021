<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database. Are created by the seeders :
     * 
     * - 1 admin & 4 users
     * 
     * - 3 regions (Yverdon, Genève, Neuchâtel)
     * - 5 quizzes
     * - 15 randomly assigned questions
     * - 45 randomly assigned clues
     * 
     * - 50 random scores for random quizzes and users
     * - 10 random assignations of quizzes to users, as favorites
     * 
     * - 15 badges
     * - 15 random assignations of badges to users
     * 
     * 
     *
     * @return void
     */
    public function run()
    {

        $this->call(UsersTableSeeder::class);
        $this->call(RegionsTableSeeder::class);
        $this->call(QuizzesTableSeeder::class);
        $this->call(QuestionsTableSeeder::class);
        $this->call(CluesTableSeeder::class);
        $this->call(ScoresTableSeeder::class);
        $this->call(BadgesTableSeeder::class);
        $this->call(BadgeUserTableSeeder::class);
        $this->call(FavoritesTableSeeder::class);
    }
}