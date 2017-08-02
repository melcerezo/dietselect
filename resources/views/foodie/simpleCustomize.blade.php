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
        <form action="" method="post">
            <div class="row">
                <div class="col s12 m6">
                    <div class="secTtl">
                        <span>Meat and Poultry</span>
                    </div>
                    <div>
                        <input type="checkbox" id="pork"/>
                        <label for="pork">NO Pork</label>
                    </div>
                    <div>
                        <input type="checkbox" id="beef"/>
                        <label for="beef">NO Beef</label>
                    </div>
                    <div>
                        <input type="checkbox" id="chicken"/>
                        <label for="chicken">NO Chicken</label>
                    </div>
                    <div>
                        <input type="checkbox" id="seafood"/>
                        <label for="seafood">NO Seafood</label>
                    </div>
                    <div>
                        <input type="checkbox" id="eggs"/>
                        <label for="eggs">NO Eggs</label>
                    </div>
                    <div>
                        <input type="checkbox" id="dairy"/>
                        <label for="dairy">NO Dairy</label>
                    </div>
                </div>
                <div class="col s12 m6">
                    <div class="secTtl">
                        <span>Taste</span>
                    </div>
                    <div>
                        <input type="checkbox" id="sweet"/>
                        <label for="sweet">NO Sweet Foods</label>
                    </div>
                    <div>
                        <input type="checkbox" id="salty"/>
                        <label for="salty">NO Salty Foods</label>
                    </div>
                    <div>
                        <input type="checkbox" id="spicy"/>
                        <label for="spicy">NO Spicy Foods</label>
                    </div>
                    <div>
                        <input type="checkbox" id="bitter"/>
                        <label for="bitter">NO Bitter Foods</label>
                    </div>
                    <div>
                        <input type="checkbox" id="savory"/>
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
                        <input type="checkbox" id="fruit">
                        <label for="fruit">NO Fruits</label>
                    </div>
                    <div>
                        <input type="checkbox" id="citrus">
                        <label for="citrus">NO Citrus Fruits</label>
                    </div>
                </div>
                <div class="col s12 m6">
                    <div class="secTtl">
                        <span>Cooking Method</span>
                    </div>
                    <div>
                        <input type="checkbox" id="fried">
                        <label for="fried">NO Fried Foods</label>
                    </div>
                    <div>
                        <input type="checkbox" id="grilled">
                        <label for="grilled">NO Grilled Foods</label>
                    </div>
                    <div>
                        <input type="checkbox" id="steamed">
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
                        <input type="checkbox" id="cumin">
                        <label for="cumin">NO Cumin</label>
                    </div>
                    <div>
                        <input type="checkbox" id="curry">
                        <label for="curry">NO Curry</label>
                    </div>
                    <div>
                        <input type="checkbox" id="preservatives">
                        <label for="preservatives">NO Preservatives</label>
                    </div>
                    <div>
                        <input type="checkbox" id="salt">
                        <label for="salt">NO Salt</label>
                    </div>
                    <div>
                        <input type="checkbox" id="sweeteners">
                        <label for="sweeteners">NO Sweeteners</label>
                    </div>
                </div>
                <div class="col s12 m6">
                    <div class="secTtl">
                        <span>Fats and Oils</span>
                    </div>
                    <div>
                        <input type="checkbox" id="coconutOil">
                        <label for="coconutOil">NO Coconut Oil</label>
                    </div>
                    <div>
                        <input type="checkbox" id="oliveOil">
                        <label for="oliveOil">NO Olive Oil</label>
                    </div>
                    <div>
                        <input type="checkbox" id="butter">
                        <label for="butter">NO Butter</label>
                    </div>
                    <div>
                        <input type="checkbox" id="meatFat">
                        <label for="meatFat">NO Visible Meat Fat</label>
                    </div>
                    <div>
                        <input type="checkbox" id="baconFat">
                        <label for="baconFat">NO Bacon Fat</label>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection