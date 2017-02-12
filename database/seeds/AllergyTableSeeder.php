<?php

use Illuminate\Database\Seeder;

class AllergyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

//        for ($i = 0; $i < 30; $i++){
//            \Illuminate\Support\Facades\DB::table('allergies')->insert([
//                'foodie_id' => rand(1,30),
//                'ingredient_id' => rand(1,30)
//            ]);
//        }
    }
}
