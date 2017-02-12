<?php

use Illuminate\Database\Seeder;

class MealTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        for ($i = 0; $i < 30; $i++){
            \Illuminate\Support\Facades\DB::table('meals')->insert([
                'chef_id' => rand(1,30),
                'description' => $faker->text(50),
                'main_ingredient' => $faker->text(50),
                'calories' => $faker->randomFloat(),
                'carbohydrates' => $faker->randomFloat(),
                'protein' => $faker->randomFloat(),
                'fat' => $faker->randomFloat(),
            ]);
        }
    }
}
