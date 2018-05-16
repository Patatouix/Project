<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(TagTableSeeder::class);
        $this->call(CommandTableSeeder::class);
        $this->call(ArticleTableSeeder::class);
        $this->call(SpeciesTableSeeder::class);
        $this->call(RaceTableSeeder::class);
        $this->call(AnimalTableSeeder::class);
        $this->call(FoodTableSeeder::class);
        $this->call(SportTableSeeder::class);
        $this->call(EnvironmentTableSeeder::class);
        $this->call(VetTableSeeder::class);
        $this->call(RdvTableSeeder::class);
    }
}
