<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChefCustomizedIngredientMeal extends Model
{
    public function ingredient()
    {
        return $this->belongsTo(Ingredient::class);
    }

    public function chefCustomizedMeal()
    {
        return $this->belongsTo(ChefCustomizedMeal::class);
    }
}
