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
        $this->call(AgeConseilTableSeeder::class);
        $this->call(AgesTableSeeder::class);
        $this->call(AnimalEnvironmentTableSeeder::class);
        $this->call(AnimalFoodTableSeeder::class);
        $this->call(AnimalRaceTableSeeder::class);
        $this->call(AnimalRdvTableSeeder::class);
        $this->call(AnimalsTableSeeder::class);
        $this->call(ConseilConseiltagTableSeeder::class);
        $this->call(ConseilEnvironmentTableSeeder::class);
        $this->call(ConseilEspeceTableSeeder::class);
        $this->call(ConseilFoodTableSeeder::class);
        $this->call(ConseilGenderTableSeeder::class);
        $this->call(ConseilRaceTableSeeder::class);
        $this->call(ConseilSportTableSeeder::class);
        $this->call(ConseilsTableSeeder::class);
        $this->call(ConseilSterilizationTableSeeder::class);
        $this->call(ConseiltagsTableSeeder::class);
        $this->call(ConseilWeightTableSeeder::class);
        $this->call(EnvironmentsTableSeeder::class);
        $this->call(EspecesTableSeeder::class);
        $this->call(FoodsTableSeeder::class);
        $this->call(GendersTableSeeder::class);
        $this->call(ImagesTableSeeder::class);
        $this->call(ProduitProduittagTableSeeder::class);
        $this->call(ProduitReservationTableSeeder::class);
        $this->call(ProduitsTableSeeder::class);
        $this->call(ProduittagsTableSeeder::class);
        $this->call(RacesTableSeeder::class);
        $this->call(RdvsTableSeeder::class);
        $this->call(ReservationsTableSeeder::class);
        $this->call(SportsTableSeeder::class);
        $this->call(SterilizationsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(VetsTableSeeder::class);
        $this->call(WeightsTableSeeder::class);
    }
}
