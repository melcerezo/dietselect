<?php

use Illuminate\Database\Seeder;

class FoodiePreferenceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 30; $i++){
            \Illuminate\Support\Facades\DB::table('foodie_preferences')->insert([
                'foodie_id' => rand(1,30),
                'ingredient_id' => rand(1,30),
            ]);
        }
    }
}
