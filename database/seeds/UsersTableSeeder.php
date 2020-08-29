<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder {

	private function randDate()
	{
		return Carbon::createFromDate(rand(2015, 2018), rand(1, 12), rand(1, 28));
    }

	/**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
	{
		DB::table('users')->delete();

		for($i = 1; $i < 11; ++$i)
		{
			$date = $this->randDate();
			DB::table('users')->insert([
                'name' => 'Nom ' . $i,
                'prenom' => 'Prenom '. $i,
				'email' => 'email' . $i . '@gmail.com',
				'password' => bcrypt('password' . $i),
				'admin' => 0,
				'created_at' => $date,
				'updated_at' => $date,
			]);
        }

        $date = $this->randDate();
        DB::table('users')->insert([
            'name' => 'admins',
            'prenom' => 'admins',
            'email' => 'admins@gmail.com',
            'password' => bcrypt('admins'),
            'admin' => 1,
            'created_at' => $date,
            'updated_at' => $date,
        ]);

        $date = $this->randDate();
        DB::table('users')->insert([
            'name' => 'clients',
            'prenom' => 'clients',
            'email' => 'clients@gmail.com',
            'password' => bcrypt('clients'),
            'admin' => 0,
            'created_at' => $date,
            'updated_at' => $date,
        ]);
	}
}