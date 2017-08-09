@extends('foodie.layout')
@section('page_head')
    {{--<link rel="stylesheet" href="/css/foodie/foodieMealCustomize.css">--}}
    {{--<script src="/js/foodie/foodieIngredientAutocomplete.js"></script>--}}
@endsection

@section('page_content')
    <div class="container" style="width: 85%; margin-top: 0.5rem;">
        <div class="row">
            <div class="col s12 light-green lighten-1 white-text" style="min-height: 40px; font-size: 20px;">
                <span>Simple Customization for: {{$plan->plan->plan_name}}</span>
            </div>
        </div>
        <div class="row">
            <div class="col s12">
                @foreach($simpCusts as $simpCust)
                <div>
                    <span>{{"NO ".$simpCust->detail}}</span>
                </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection