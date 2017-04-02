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
        $this->call(ChefTableSeeder::class);
        $this->call(FoodieTableSeeder::class);
        $this->call(PlanTableSeeder::class);
        $this->call(MealTableSeeder::class);
        $this->call(MealPlanTableSeeder::class);
//        $this->call(AllergyTableSeeder::class);
//        $this->call(FoodieAddressTableSeeder::class);
//        $this->call(FoodiePreferenceTableSeeder::class);
//        $this->call(MealIngredientTableSeeder::class);
    }
}
