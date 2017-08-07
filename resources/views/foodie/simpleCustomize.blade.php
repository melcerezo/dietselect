@extends('foodie.layout')
@section('page_head')
    <link rel="stylesheet" href="/css/foodie/foodieSimpleCustomize.css">
    <script src="/js/foodie/foodieSimpleCustomize.js" defer></script>
@endsection
@section('page_content')
    <div class="container">
        <div class="row">
            <div class="col s12">
            </div>
        </div>
        <form action="{{route('foodie.simple.custom', $plan->id)}}" method="post">
            {{ csrf_field() }}
            <div class="row">
                <div class="col s12 m6">
                    <div class="secTtl">
                        <span>Meat and Poultry</span>
                    </div>
                    <div>
                        <input type="hidden" name="pork" value="0"/>
                        <input type="checkbox" id="pork" name="pork" value="1"/>
                        <label for="pork">NO Pork</label>
                    </div>
                    <div>
                        <input type="hidden" name="beef" value="0"/>
                        <input type="checkbox" id="beef" name="beef" value="1"/>
                        <label for="beef">NO Beef</label>
                    </div>
                    <div>
                        <input type="hidden" name="chicken" value="0"/>
                        <input type="checkbox" id="chicken" name="chicken" value="1"/>
                        <label for="chicken">NO Chicken</label>
                    </div>
                    <div>
                        <input type="hidden" name="seafood" value="0"/>
                        <input type="checkbox" id="seafood" name="seafood" value="1"/>
                        <label for="seafood">NO Seafood</label>
                    </div>
                    <div>
                        <input type="hidden" name="eggs" value="0"/>
                        <input type="checkbox" id="eggs" name="eggs" value="1"/>
                        <label for="eggs">NO Eggs</label>
                    </div>
                    <div>
                        <input type="hidden" name="dairy" value="0"/>
                        <input type="checkbox" id="dairy" name="dairy" value="1"/>
                        <label for="dairy">NO Dairy</label>
                    </div>
                </div>
                <div class="col s12 m6">
                    <div class="secTtl">
                        <span>Taste</span>
                    </div>
                    <div>
                        <input type="hidden" name="dairy" value="0"/>
                        <input type="checkbox" id="sweet" name="sweet" value="1"/>
                        <label for="sweet">NO Sweet Foods</label>
                    </div>
                    <div>
                        <input type="hidden" name="salty" value="0"/>
                        <input type="checkbox" id="salty" name="salty" value="1"/>
                        <label for="salty">NO Salty Foods</label>
                    </div>
                    <div>
                        <input type="hidden" name="spicy" value="0"/>
                        <input type="checkbox" id="spicy" name="spicy" value="1"/>
                        <label for="spicy">NO Spicy Foods</label>
                    </div>
                    <div>
                        <input type="hidden" name="bitter" value="0"/>
                        <input type="checkbox" id="bitter" name="bitter" value="1"/>
                        <label for="bitter">NO Bitter Foods</label>
                    </div>
                    <div>
                        <input type="hidden" name="savory" value="0"/>
                        <input type="checkbox" id="savory" name="savory" value="1"/>
                        <label for="savory">NO Savory Foods</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col s12 m6">
                    <div class="secTtl">
                        <span>Produce</span>
                    </div>
                    <div>
                        <input type="hidden" name="fruit" value="0"/>
                        <input type="checkbox" id="fruit" name="fruit" value="1">
                        <label for="fruit">NO Fruits</label>
                    </div>
                    <div>
                        <input type="hidden" name="citrus" value="0"/>
                        <input type="checkbox" id="citrus" name="citrus" value="1">
                        <label for="citrus">NO Citrus Fruits</label>
                    </div>
                </div>
                <div class="col s12 m6">
                    <div class="secTtl">
                        <span>Cooking Method</span>
                    </div>
                    <div>
                        <input type="hidden" name="fried" value="0"/>
                        <input type="checkbox" id="fried" name="fried" value="1">
                        <label for="fried">NO Fried Foods</label>
                    </div>
                    <div>
                        <input type="hidden" name="grilled" value="0"/>
                        <input type="checkbox" id="grilled" name="grilled" value="1">
                        <label for="grilled">NO Grilled Foods</label>
                    </div>
                    <div>
                        <input type="hidden" name="steamed" value="0"/>
                        <input type="checkbox" id="steamed" name="steamed" value="1">
                        <label for="steamed">NO Steamed Foods</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col s12 m6">
                    <div class="secTtl">
                        <span>Dry Goods/Condiments</span>
                    </div>
                    <div>
                        <input type="hidden" name="cumin" value="0"/>
                        <input type="checkbox" id="cumin" name="cumin" value="1">
                        <label for="cumin">NO Cumin</label>
                    </div>
                    <div>
                        <input type="hidden" name="curry" value="0"/>
                        <input type="checkbox" id="curry" name="curry" value="1">
                        <label for="curry">NO Curry</label>
                    </div>
                    <div>
                        <input type="hidden" name="preservatives" value="0"/>
                        <input type="checkbox" id="preservatives" name="preservatives" value="1">
                        <label for="preservatives">NO Preservatives</label>
                    </div>
                    <div>
                        <input type="hidden" name="salt" value="0"/>
                        <input type="checkbox" id="salt" name="salt" value="1">
                        <label for="salt">NO Salt</label>
                    </div>
                    <div>
                        <input type="hidden" name="sweeteners" value="0"/>
                        <input type="checkbox" id="sweeteners" name="sweeteners" value="1">
                        <label for="sweeteners">NO Sweeteners</label>
                    </div>
                </div>
                <div class="col s12 m6">
                    <div class="secTtl">
                        <span>Fats and Oils</span>
                    </div>
                    <div>
                        <input type="hidden" name="coconutOil" value="0"/>
                        <input type="checkbox" id="coconutOil" name="coconutOil" value="1">
                        <label for="coconutOil">NO Coconut Oil</label>
                    </div>
                    <div>
                        <input type="hidden" name="oliveOil" value="0"/>
                        <input type="checkbox" id="oliveOil" name="oliveOil" value="1">
                        <label for="oliveOil">NO Olive Oil</label>
                    </div>
                    <div>
                        <input type="hidden" name="butter" value="0"/>
                        <input type="checkbox" id="butter" name="butter" value="1">
                        <label for="butter">NO Butter</label>
                    </div>
                    <div>
                        <input type="hidden" name="meatFat" value="0"/>
                        <input type="checkbox" id="meatFat" name="meatFat" value="1">
                        <label for="meatFat">NO Visible Meat Fat</label>
                    </div>
                    <div>
                        <input type="hidden" name="baconFat" value="0"/>
                        <input type="checkbox" id="baconFat" name="baconFat" value="1">
                        <label for="baconFat">NO Bacon Fat</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <button type="submit" class="btn btn-primary waves-effect waves-light">Submit</button>
            </div>
        </form>
    </div>
@endsection