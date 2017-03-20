<?php

use Illuminate\Database\Seeder;

class PlanTableSeeder extends Seeder
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
            \Illuminate\Support\Facades\DB::table('plans')->insert([
                'chef_id' => $faker->numberBetween(1,30),
                'plan_name' => $faker->text(60),
                'calories' => $faker->randomFloat(),
                'price' => rand(2,8)
            ]);
        }
    }
}
