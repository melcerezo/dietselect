<?php

use Illuminate\Database\Seeder;

class FoodieTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        $gender = array('M', 'F');
        $g = array_rand($gender);

        $password = bcrypt('foodie');

        for ($i = 0; $i < 30; $i++){
            \Illuminate\Support\Facades\DB::table('foodies')->insert([
                'last_name' => $faker->lastName,
                'first_name' => $faker->firstName,
                'gender' => ($gender[$g]),
                'birthday' => $faker->date('Y-m-d'),
                'email' => $faker->unique()->email,
                'mobile_number' => $faker->numberBetween(1234567),
                'username' => $faker->text(20),
                'joined_newsletter' => rand(0,1),
                'password' => bcrypt('foodie'),
            ]);
        }
    }
}
