<?php

use Illuminate\Database\Seeder;

class FoodieAddressTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        $type = array('residential', 'business');
        $key = array_rand($type, 2);

        for ($i = 0; $i < 30; $i++){
            \Illuminate\Support\Facades\DB::table('foodie_address')->insert([
                'city' => $faker->city,
                'unit' => rand(101, 401),
                'bldg' => $faker->buildingNumber,
                'street' => $faker->streetName,
                'brgy' => rand(123, 501),
                'type' => rand(0,1),
                'company' => $faker->company,
                'landmark' => $faker->address,
                'remarks' => $faker->text(50),
                'foodie_id' => rand(1,30)
            ]);
        }
    }
}
