<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IngredientMeal extends Model
{
    protected $table = 'ingredient_meal';

    protected $fillable = ['grams', 'meal_id', 'ingredient_id'];

    public function ingredient()
    {
        return $this->belongsTo(Ingredient::class);
    }

    public function meal()
    {
        return $this->belongsTo(Meal::class);
    }
}
