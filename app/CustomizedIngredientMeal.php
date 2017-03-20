<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomizedIngredientMeal extends Model
{
//    protected $table = 'ingredient_meal';

    protected $primaryKey = 'meal_id';

    protected $fillable = ['grams', 'meal_id', 'ingredient_id'];

    public function ingredient()
    {
        return $this->belongsTo(Ingredient::class);
    }

    public function customizedMeal()
    {
        return $this->belongsTo(CustomizedMeal::class);
    }
}
