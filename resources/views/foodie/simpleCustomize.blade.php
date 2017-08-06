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
                        <input type="checkbox" id="pork" name="pork"/>
                        <label for="pork">NO Pork</label>
                    </div>
                    <div>
                        <input type="checkbox" id="beef" name="beef"/>
                        <label for="beef">NO Beef</label>
                    </div>
                    <div>
                        <input type="checkbox" id="chicken" name="chicken"/>
                        <label for="chicken">NO Chicken</label>
                    </div>
                    <div>
                        <input type="checkbox" id="seafood" name="seafood"/>
                        <label for="seafood">NO Seafood</label>
                    </div>
                    <div>
                        <input type="checkbox" id="eggs" name="eggs"/>
                        <label for="eggs">NO Eggs</label>
                    </div>
                    <div>
                        <input type="checkbox" id="dairy" name="dairy"/>
                        <label for="dairy">NO Dairy</label>
                    </div>
                </div>
                <div class="col s12 m6">
                    <div class="secTtl">
                        <span>Taste</span>
                    </div>
                    <div>
                        <input type="checkbox" id="sweet" name="sweet"/>
                        <label for="sweet">NO Sweet Foods</label>
                    </div>
                    <div>
                        <input type="checkbox" id="salty" name="salty"/>
                        <label for="salty">NO Salty Foods</label>
                    </div>
                    <div>
                        <input type="checkbox" id="spicy" name="spicy"/>
                        <label for="spicy">NO Spicy Foods</label>
                    </div>
                    <div>
                        <input type="checkbox" id="bitter" name="bitter"/>
                        <label for="bitter">NO Bitter Foods</label>
                    </div>
                    <div>
                        <input type="checkbox" id="savory" name="savory"/>
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
                        <input type="checkbox" id="fruit" name="fruit">
                        <label for="fruit">NO Fruits</label>
                    </div>
                    <div>
                        <input type="checkbox" id="citrus" name="citrus">
                        <label for="citrus">NO Citrus Fruits</label>
                    </div>
                </div>
                <div class="col s12 m6">
                    <div class="secTtl">
                        <span>Cooking Method</span>
                    </div>
                    <div>
                        <input type="checkbox" id="fried" name="fried">
                        <label for="fried">NO Fried Foods</label>
                    </div>
                    <div>
                        <input type="checkbox" id="grilled" name="grilled">
                        <label for="grilled">NO Grilled Foods</label>
                    </div>
                    <div>
                        <input type="checkbox" id="steamed" name="steamed">
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
                        <input type="checkbox" id="cumin" name="cumin">
                        <label for="cumin">NO Cumin</label>
                    </div>
                    <div>
                        <input type="checkbox" id="curry" name="curry">
                        <label for="curry">NO Curry</label>
                    </div>
                    <div>
                        <input type="checkbox" id="preservatives" name="preservatives">
                        <label for="preservatives">NO Preservatives</label>
                    </div>
                    <div>
                        <input type="checkbox" id="salt" name="salt">
                        <label for="salt">NO Salt</label>
                    </div>
                    <div>
                        <input type="checkbox" id="sweeteners" name="sweeteners">
                        <label for="sweeteners">NO Sweeteners</label>
                    </div>
                </div>
                <div class="col s12 m6">
                    <div class="secTtl">
                        <span>Fats and Oils</span>
                    </div>
                    <div>
                        <input type="checkbox" id="coconutOil" name="coconutOil">
                        <label for="coconutOil">NO Coconut Oil</label>
                    </div>
                    <div>
                        <input type="checkbox" id="oliveOil" name="oliveOil">
                        <label for="oliveOil">NO Olive Oil</label>
                    </div>
                    <div>
                        <input type="checkbox" id="butter" name="butter">
                        <label for="butter">NO Butter</label>
                    </div>
                    <div>
                        <input type="checkbox" id="meatFat" name="meatFat">
                        <label for="meatFat">NO Visible Meat Fat</label>
                    </div>
                    <div>
                        <input type="checkbox" id="baconFat" name="baconFat">
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