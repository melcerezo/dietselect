<?php

use Illuminate\Database\Seeder;

class ChefTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        $password = bcrypt('chef');

        for ($i = 0; $i < 30; $i++){
            \Illuminate\Support\Facades\DB::table('chefs')->insert([
               'name' => $faker->name,
                'email' => $faker->unique()->email,
                'mobile_number' => $faker->phoneNumber,
                'website' => $faker->text(30),
                'url_name' => $faker->url,
                'password' => bcrypt('password'),
            ]);
        }
    }
}
