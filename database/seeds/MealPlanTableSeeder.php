<?php

use Illuminate\Database\Seeder;

class MealPlanTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $meal = new \App\MealPlan();
        $meal->plan_id = 1;
        $meal->meal_id = 1;
        $meal->day = 'MO';
        $meal->meal_type = 'Breakfast';
        $meal->save();

        $meal = new \App\MealPlan();
        $meal->plan_id = 2;
        $meal->meal_id = 2;
        $meal->day = 'TU';
        $meal->meal_type = 'Lunch';
        $meal->save();

        $meal = new \App\MealPlan();
        $meal->plan_id = 3;
        $meal->meal_id = 3;
        $meal->day = 'WED';
        $meal->meal_type = 'Snack';
        $meal->save();

        $meal = new \App\MealPlan();
        $meal->plan_id = 4;
        $meal->meal_id = 4;
        $meal->day = 'TH';
        $meal->meal_type = 'Dinner';
        $meal->save();

        $meal = new \App\MealPlan();
        $meal->plan_id = 5;
        $meal->meal_id = 5;
        $meal->day = 'FR';
        $meal->meal_type = 'Snack';
        $meal->save();

        $meal = new \App\MealPlan();
        $meal->plan_id = 6;
        $meal->meal_id = 6;
        $meal->day = 'MO';
        $meal->meal_type = 'Breakfast';
        $meal->save();

        $meal = new \App\MealPlan();
        $meal->plan_id = 7;
        $meal->meal_id = 7;
        $meal->day = 'TU';
        $meal->meal_type = 'Lunch';
        $meal->save();

        $meal = new \App\MealPlan();
        $meal->plan_id = 8;
        $meal->meal_id = 8;
        $meal->day = 'WE';
        $meal->meal_type = 'Lunch';
        $meal->save();

        $meal = new \App\MealPlan();
        $meal->plan_id = 9;
        $meal->meal_id = 9;
        $meal->day = 'TH';
        $meal->meal_type = 'Breakfast';
        $meal->save();

        $meal = new \App\MealPlan();
        $meal->plan_id = 10;
        $meal->meal_id = 10;
        $meal->day = 'FR';
        $meal->meal_type = 'Dinner';
        $meal->save();
    }
}
