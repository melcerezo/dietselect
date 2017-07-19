@extends('foodie.layout')
@section('page_head')
    <link rel="stylesheet" href="/css/foodie/foodieDash.css">
    <script src="/js/foodie/foodieDash.js" defer></script>
    <title>App - Diet Select PH | Treating yourself the right way!</title>
    <meta name="description" content="">
@endsection

@section('page_content')
    <div class="container dshMnCnt">
        <div class="row">
            <div class="col s12 m6 l4">
                <div class="card">
                    <div class="card-image grey lighten-1 dshPrfCrdCnt" style="position: relative">
                        @if($foodie->cover==null)
                            <a id="coverLinkPhoto" href="#addCover" class="modal-trigger">
                                <span class="fa fa-camera grey-text lighten-3" style="position: absolute; top:12px; left: 0; display: block; font-size: 8em; margin: 0.15em auto; width: 100%; text-align: center;"></span>
                                <div id="addCoverPhotoLink">
                                    <div style="padding-top:15%; margin: 0 auto; width: 50%;">
                                        <span class="orange-text" style="font-size: 40px;">+Add Photo</span>
                                    </div>
                                </div>
                            </a>
                        @else
                            <a href="#addCover" class="modal-trigger">
                                <img class="dshPrfCrdImgBan" src="/img/{{ $foodie->cover }}">
                                <div id="addCoverPhotoLink">
                                    <div style="padding-top:15%; margin: 0 auto; width: 50%;">
                                         <span class="orange-text" style="font-size: 40px;">+Add Photo</span>
                                    </div>
                                </div>
                            </a>
                        @endif
                    </div>
                    <div class="card-content">
                        <img src="/img/{{ $foodie->avatar }}" class="circle dshPrfCrdImgUs">
                        <span class="card-title">{{$foodie->first_name.' '.$foodie->last_name}}</span>
                        <div class="divider dshPrfCrdDvd"></div>
                        <div class="dshPrfCrdInf">
                            <p>Birthday: {{$foodie->birthday}}</p>
                            <p>Email: {{$foodie->email}}</p>
                            <p>Phone Number: {{$foodie->mobile_number}}</p>
                        </div>
                        <div>
                            <a href="{{route('foodie.profile')}}">Edit Profile</a>
                        </div>
                        {{--<p>I am a very simple card. I am good at containing small bits of information. I am convenient because I require little markup to use effectively.</p>--}}
                    </div>
                </div>
                @if($paidOrderUpcoming!=null)
                    <div class="card">
                            <div class="light-green lighten-1 white-text dshMnClTtl">
                                <span class="activator dshMnTtl">
                                    Upcoming Plans: {{$nextWeek}}
                                </span>
                            </div>
                            <table class="dshMlTbl">
                                <tr>
                                    <th>Name</th>
                                    <th>Chef</th>
                                    <th>Price</th>
                                </tr>

                                @foreach($orderItemArrayUpcoming as $orderItem)
                                    <tr>
                                        <td>{{$orderItem['plan']}}</td>
                                        <td>{{$orderItem['chef']}}</td>
                                        <td>{{$orderItem['price']}}</td>
                                    </tr>
                                @endforeach
                            </table>

                                {{--<tr>--}}
                                    {{--<th>Mo</th>--}}
                                    {{--<td>--}}
                                        {{--<div class="truncate">--}}
                                            {{--@foreach($mealPlansUpcoming as $id =>$mealPlan)--}}
                                                {{--@if($mealPlan->day == 'MO' && $mealPlan->meal_type == 'Breakfast')--}}
                                                    {{--<span>{{$mealPlan->chefcustomize->description}}</span>--}}
                                                {{--@endif--}}
                                            {{--@endforeach--}}
                                        {{--</div>--}}
                                    {{--</td>--}}
                                    {{--<td>--}}
                                        {{--<div class="truncate">--}}
                                            {{--@foreach($mealPlansUpcoming as $id =>$mealPlan)--}}
                                                {{--@if($mealPlan->day == 'MO' && $mealPlan->meal_type == 'MorningSnack')--}}
                                                    {{--<span>{{$mealPlan->chefcustomize->description}}</span>--}}
                                                {{--@endif--}}
                                            {{--@endforeach--}}
                                        {{--</div>--}}
                                    {{--</td>--}}
                                    {{--<td>--}}
                                        {{--<div class="truncate">--}}
                                            {{--@foreach($mealPlansUpcoming as $id =>$mealPlan)--}}
                                                {{--@if($mealPlan->day == 'MO' && $mealPlan->meal_type == 'Lunch')--}}
                                                    {{--<span>{{$mealPlan->chefcustomize->description}}</span>--}}
                                                {{--@endif--}}
                                            {{--@endforeach--}}
                                        {{--</div>--}}
                                    {{--</td>--}}
                                    {{--<td>--}}
                                        {{--<div class="truncate">--}}
                                            {{--@foreach($mealPlansUpcoming as $id =>$mealPlan)--}}
                                                {{--@if($mealPlan->day == 'MO' && $mealPlan->meal_type == 'AfternoonSnack')--}}
                                                    {{--<span>{{$mealPlan->chefcustomize->description}}</span>--}}
                                                {{--@endif--}}
                                            {{--@endforeach--}}
                                        {{--</div>--}}
                                    {{--</td>--}}
                                    {{--<td>--}}
                                        {{--<div class="truncate">--}}
                                            {{--@foreach($mealPlansUpcoming as $id =>$mealPlan)--}}
                                                {{--@if($mealPlan->day == 'MO' && $mealPlan->meal_type == 'Dinner')--}}
                                                    {{--<span>{{$mealPlan->chefcustomize->description}}</span>--}}
                                                {{--@endif--}}
                                            {{--@endforeach--}}
                                        {{--</div>--}}
                                    {{--</td>--}}
                                {{--</tr>--}}
                                {{--<tr>--}}
                                    {{--<th>Tu</th>--}}
                                    {{--<td>--}}
                                        {{--<div class="truncate">--}}
                                            {{--@foreach($mealPlansUpcoming as $id =>$mealPlan)--}}
                                                {{--@if($mealPlan->day == 'TU' && $mealPlan->meal_type == 'Breakfast')--}}
                                                    {{--<span>{{$mealPlan->chefcustomize->description}}</span>--}}
                                                {{--@endif--}}
                                            {{--@endforeach--}}
                                        {{--</div>--}}
                                    {{--</td>--}}
                                    {{--<td>--}}
                                        {{--<div class="truncate">--}}
                                            {{--@foreach($mealPlansUpcoming as $id =>$mealPlan)--}}
                                                {{--@if($mealPlan->day == 'TU' && $mealPlan->meal_type == 'MorningSnack')--}}
                                                    {{--<span>{{$mealPlan->chefcustomize->description}}</span>--}}
                                                {{--@endif--}}
                                            {{--@endforeach--}}
                                        {{--</div>--}}
                                    {{--</td>--}}
                                    {{--<td>--}}
                                        {{--<div class="truncate">--}}
                                            {{--@foreach($mealPlansUpcoming as $id =>$mealPlan)--}}
                                                {{--@if($mealPlan->day == 'TU' && $mealPlan->meal_type == 'Lunch')--}}
                                                    {{--<span>{{$mealPlan->chefcustomize->description}}</span>--}}
                                                {{--@endif--}}
                                            {{--@endforeach--}}
                                        {{--</div>--}}
                                    {{--</td>--}}
                                    {{--<td>--}}
                                        {{--<div class="truncate">--}}
                                            {{--@foreach($mealPlansUpcoming as $id =>$mealPlan)--}}
                                                {{--@if($mealPlan->day == 'TU' && $mealPlan->meal_type == 'AfternoonSnack')--}}
                                                    {{--<span>{{$mealPlan->chefcustomize->description}}</span>--}}
                                                {{--@endif--}}
                                            {{--@endforeach--}}
                                        {{--</div>--}}
                                    {{--</td>--}}
                                    {{--<td>--}}
                                        {{--<div class="truncate">--}}
                                            {{--@foreach($mealPlansUpcoming as $id =>$mealPlan)--}}
                                                {{--@if($mealPlan->day == 'TU' && $mealPlan->meal_type == 'Dinner')--}}
                                                    {{--<span>{{$mealPlan->chefcustomize->description}}</span>--}}
                                                {{--@endif--}}
                                            {{--@endforeach--}}
                                        {{--</div>--}}
                                    {{--</td>--}}
                                {{--</tr>--}}
                                {{--<tr>--}}
                                    {{--<th>We</th>--}}
                                    {{--<td>--}}
                                        {{--<div class="truncate">--}}
                                            {{--@foreach($mealPlansUpcoming as $id =>$mealPlan)--}}
                                                {{--@if($mealPlan->day == 'WE' && $mealPlan->meal_type == 'Breakfast')--}}
                                                    {{--<span>{{$mealPlan->chefcustomize->description}}</span>--}}
                                                {{--@endif--}}
                                            {{--@endforeach--}}
                                        {{--</div>--}}
                                    {{--</td>--}}
                                    {{--<td>--}}
                                        {{--<div class="truncate">--}}
                                            {{--@foreach($mealPlansUpcoming as $id =>$mealPlan)--}}
                                                {{--@if($mealPlan->day == 'WE' && $mealPlan->meal_type == 'MorningSnack')--}}
                                                    {{--<span>{{$mealPlan->chefcustomize->description}}</span>--}}
                                                {{--@endif--}}
                                            {{--@endforeach--}}
                                        {{--</div>--}}
                                    {{--</td>--}}
                                    {{--<td>--}}
                                        {{--<div class="truncate">--}}
                                            {{--@foreach($mealPlansUpcoming as $id =>$mealPlan)--}}
                                                {{--@if($mealPlan->day == 'WE' && $mealPlan->meal_type == 'Lunch')--}}
                                                    {{--<span>{{$mealPlan->chefcustomize->description}}</span>--}}
                                                {{--@endif--}}
                                            {{--@endforeach--}}
                                        {{--</div>--}}
                                    {{--</td>--}}
                                    {{--<td>--}}
                                        {{--<div class="truncate">--}}
                                            {{--@foreach($mealPlansUpcoming as $id =>$mealPlan)--}}
                                                {{--@if($mealPlan->day == 'WE' && $mealPlan->meal_type == 'AfternoonSnack')--}}
                                                    {{--<span>{{$mealPlan->chefcustomize->description}}</span>--}}
                                                {{--@endif--}}
                                            {{--@endforeach--}}
                                        {{--</div>--}}
                                    {{--</td>--}}
                                    {{--<td>--}}
                                        {{--<div class="truncate">--}}
                                            {{--@foreach($mealPlansUpcoming as $id =>$mealPlan)--}}
                                                {{--@if($mealPlan->day == 'WE' && $mealPlan->meal_type == 'Dinner')--}}
                                                    {{--<span>{{$mealPlan->chefcustomize->description}}</span>--}}
                                                {{--@endif--}}
                                            {{--@endforeach--}}
                                        {{--</div>--}}
                                    {{--</td>--}}
                                {{--</tr>--}}
                                {{--<tr>--}}
                                    {{--<th>Th</th>--}}
                                    {{--<td>--}}
                                        {{--<div class="truncate">--}}
                                            {{--@foreach($mealPlansUpcoming as $id =>$mealPlan)--}}
                                                {{--@if($mealPlan->day == 'TH' && $mealPlan->meal_type == 'Breakfast')--}}
                                                    {{--<span>{{$mealPlan->chefcustomize->description}}</span>--}}
                                                {{--@endif--}}
                                            {{--@endforeach--}}
                                        {{--</div>--}}
                                    {{--</td>--}}
                                    {{--<td>--}}
                                        {{--<div class="truncate">--}}
                                            {{--@foreach($mealPlansUpcoming as $id =>$mealPlan)--}}
                                                {{--@if($mealPlan->day == 'TH' && $mealPlan->meal_type == 'MorningSnack')--}}
                                                    {{--<span>{{$mealPlan->chefcustomize->description}}</span>--}}
                                                {{--@endif--}}
                                            {{--@endforeach--}}
                                        {{--</div>--}}
                                    {{--</td>--}}
                                    {{--<td>--}}
                                        {{--<div class="truncate">--}}
                                            {{--@foreach($mealPlansUpcoming as $id =>$mealPlan)--}}
                                                {{--@if($mealPlan->day == 'TH' && $mealPlan->meal_type == 'Lunch')--}}
                                                    {{--<span>{{$mealPlan->chefcustomize->description}}</span>--}}
                                                {{--@endif--}}
                                            {{--@endforeach--}}
                                        {{--</div>--}}
                                    {{--</td>--}}
                                    {{--<td>--}}
                                        {{--<div class="truncate">--}}
                                            {{--@foreach($mealPlansUpcoming as $id =>$mealPlan)--}}
                                                {{--@if($mealPlan->day == 'TH' && $mealPlan->meal_type == 'AfternoonSnack')--}}
                                                    {{--<span>{{$mealPlan->chefcustomize->description}}</span>--}}
                                                {{--@endif--}}
                                            {{--@endforeach--}}
                                        {{--</div>--}}
                                    {{--</td>--}}
                                    {{--<td>--}}
                                        {{--<div class="truncate">--}}
                                            {{--@foreach($mealPlansUpcoming as $id =>$mealPlan)--}}
                                                {{--@if($mealPlan->day == 'TH' && $mealPlan->meal_type == 'Dinner')--}}
                                                    {{--<span>{{$mealPlan->chefcustomize->description}}</span>--}}
                                                {{--@endif--}}
                                            {{--@endforeach--}}
                                        {{--</div>--}}
                                    {{--</td>--}}
                                {{--</tr>--}}
                                {{--<tr>--}}
                                    {{--<th>Fr</th>--}}
                                    {{--<td>--}}
                                        {{--<div class="truncate">--}}
                                            {{--@foreach($mealPlansUpcoming as $id =>$mealPlan)--}}
                                                {{--@if($mealPlan->day == 'FR' && $mealPlan->meal_type == 'Breakfast')--}}
                                                    {{--<span>{{$mealPlan->chefcustomize->description}}</span>--}}
                                                {{--@endif--}}
                                            {{--@endforeach--}}
                                        {{--</div>--}}
                                    {{--</td>--}}
                                    {{--<td>--}}
                                        {{--<div class="truncate">--}}
                                            {{--@foreach($mealPlansUpcoming as $id =>$mealPlan)--}}
                                                {{--@if($mealPlan->day == 'FR' && $mealPlan->meal_type == 'MorningSnack')--}}
                                                    {{--<span>{{$mealPlan->chefcustomize->description}}</span>--}}
                                                {{--@endif--}}
                                            {{--@endforeach--}}
                                        {{--</div>--}}
                                    {{--</td>--}}
                                    {{--<td>--}}
                                        {{--<div class="truncate">--}}
                                            {{--@foreach($mealPlansUpcoming as $id =>$mealPlan)--}}
                                                {{--@if($mealPlan->day == 'FR' && $mealPlan->meal_type == 'Lunch')--}}
                                                    {{--<span>{{$mealPlan->chefcustomize->description}}</span>--}}
                                                {{--@endif--}}
                                            {{--@endforeach--}}
                                        {{--</div>--}}
                                    {{--</td>--}}
                                    {{--<td>--}}
                                        {{--<div class="truncate">--}}
                                            {{--@foreach($mealPlansUpcoming as $id =>$mealPlan)--}}
                                                {{--@if($mealPlan->day == 'FR' && $mealPlan->meal_type == 'AfternoonSnack')--}}
                                                    {{--<span>{{$mealPlan->chefcustomize->description}}</span>--}}
                                                {{--@endif--}}
                                            {{--@endforeach--}}
                                        {{--</div>--}}
                                    {{--</td>--}}
                                    {{--<td>--}}
                                        {{--<div class="truncate">--}}
                                            {{--@foreach($mealPlansUpcoming as $id =>$mealPlan)--}}
                                                {{--@if($mealPlan->day == 'FR' && $mealPlan->meal_type == 'Dinner')--}}
                                                    {{--<span>{{$mealPlan->chefcustomize->description}}</span>--}}
                                                {{--@endif--}}
                                            {{--@endforeach--}}
                                        {{--</div>--}}
                                    {{--</td>--}}
                                {{--</tr>--}}
                                {{--<tr>--}}
                                    {{--<th>Sa</th>--}}
                                    {{--<td>--}}
                                        {{--<div class="truncate">--}}
                                            {{--@foreach($mealPlansUpcoming as $id =>$mealPlan)--}}
                                                {{--@if($mealPlan->day == 'SA' && $mealPlan->meal_type == 'Breakfast')--}}
                                                    {{--<span>{{$mealPlan->meal->description}}</span>--}}
                                                {{--@endif--}}
                                            {{--@endforeach--}}
                                        {{--</div>--}}
                                    {{--</td>--}}
                                    {{--<td>--}}
                                        {{--<div class="truncate">--}}
                                            {{--@foreach($mealPlansUpcoming as $id =>$mealPlan)--}}
                                                {{--@if($mealPlan->day == 'SA' && $mealPlan->meal_type == 'MorningSnack')--}}
                                                    {{--<span>{{$mealPlan->chefcustomize->description}}</span>--}}
                                                {{--@endif--}}
                                            {{--@endforeach--}}
                                        {{--</div>--}}
                                    {{--</td>--}}
                                    {{--<td>--}}
                                        {{--<div class="truncate">--}}
                                            {{--@foreach($mealPlansUpcoming as $id =>$mealPlan)--}}
                                                {{--@if($mealPlan->day == 'SA' && $mealPlan->meal_type == 'Lunch')--}}
                                                    {{--<span>{{$mealPlan->chefcustomize->description}}</span>--}}
                                                {{--@endif--}}
                                            {{--@endforeach--}}
                                        {{--</div>--}}
                                    {{--</td>--}}
                                    {{--<td>--}}
                                        {{--<div class="truncate">--}}
                                            {{--@foreach($mealPlansUpcoming as $id =>$mealPlan)--}}
                                                {{--@if($mealPlan->day == 'SA' && $mealPlan->meal_type == 'AfternoonSnack')--}}
                                                    {{--<span>{{$mealPlan->chefcustomize->description}}</span>--}}
                                                {{--@endif--}}
                                            {{--@endforeach--}}
                                        {{--</div>--}}
                                    {{--</td>--}}
                                    {{--<td>--}}
                                        {{--<div class="truncate">--}}
                                            {{--@foreach($mealPlansUpcoming as $id =>$mealPlan)--}}
                                                {{--@if($mealPlan->day == 'SA' && $mealPlan->meal_type == 'Dinner')--}}
                                                    {{--<span>{{$mealPlan->chefcustomize->description}}</span>--}}
                                                {{--@endif--}}
                                            {{--@endforeach--}}
                                        {{--</div>--}}
                                    {{--</td>--}}
                                {{--</tr>--}}
                            {{--<p style="margin-left: 10px;">*Please click calendar title to see meal legend</p>--}}

                            {{--<div class="card-reveal">--}}
                                {{--<span class="card-title grey-text text-darken-4"><i class="material-icons right">close</i></span>--}}
                                {{--<ul class="collection">--}}
                                    {{--<li class="collection-item light-green lighten-1 white-text">--}}
                                        {{--<span class="collection-header">Meal Legend</span>--}}
                                    {{--</li>--}}
                                    {{--<li class="collection-item" style="margin-left: 10px;">--}}
                                        {{--Bre: Breakfast--}}
                                    {{--</li>--}}
                                    {{--<li class="collection-item" style="margin-left: 10px;">--}}
                                        {{--Sna: Snack--}}
                                    {{--</li>--}}
                                    {{--<li class="collection-item" style="margin-left: 10px;">--}}
                                        {{--Lun: Lunch--}}
                                    {{--</li>--}}
                                    {{--<li class="collection-item" style="margin-left: 10px;">--}}
                                        {{--Din: Dinner--}}
                                    {{--</li>--}}
                                {{--</ul>--}}
                            {{--</div>--}}
                    </div>
                @endif
                <div class="card">
                    @if($paidOrder!=null)
                    <div class="light-green lighten-1 white-text dshMnClTtl">
                            <span class="activator dshMnTtl">
                                Order for Week of: {{$thisWeek}}
                            </span>
                    </div>
                        <table class="dshMlTbl">
                            <tr>
                                <th>Name</th>
                                <th>Chef</th>
                                <th>Price</th>
                            </tr>

                            @foreach($orderItemArray as $orderItem)
                                <tr>
                                    <td>{{$orderItem['plan']}}</td>
                                    <td>{{$orderItem['chef']}}</td>
                                    <td>{{$orderItem['price']}}</td>
                                </tr>
                            @endforeach
                        </table>

                        {{--<tr>--}}
                            {{--<th>Mo</th>--}}
                            {{--<td>--}}
                                {{--<div class="truncate">--}}
                                    {{--@foreach($mealPlans as $id =>$mealPlan)--}}
                                        {{--@if($mealPlan->day == 'MO' && $mealPlan->meal_type == 'Breakfast')--}}
                                            {{--<span>{{$mealPlan->meal->description}}</span>--}}
                                        {{--@endif--}}
                                    {{--@endforeach--}}
                                {{--</div>--}}
                            {{--</td>--}}
                            {{--<td>--}}
                                {{--<div class="truncate">--}}
                                    {{--@foreach($mealPlans as $id =>$mealPlan)--}}
                                        {{--@if($mealPlan->day == 'MO' && $mealPlan->meal_type == 'MorningSnack')--}}
                                            {{--<span>{{$mealPlan->meal->description}}</span>--}}
                                        {{--@endif--}}
                                    {{--@endforeach--}}
                                {{--</div>--}}
                            {{--</td>--}}
                            {{--<td>--}}
                                {{--<div class="truncate">--}}
                                    {{--@foreach($mealPlans as $id =>$mealPlan)--}}
                                        {{--@if($mealPlan->day == 'MO' && $mealPlan->meal_type == 'Lunch')--}}
                                            {{--<span>{{$mealPlan->meal->description}}</span>--}}
                                        {{--@endif--}}
                                    {{--@endforeach--}}
                                {{--</div>--}}
                            {{--</td>--}}
                            {{--<td>--}}
                                {{--<div class="truncate">--}}
                                    {{--@foreach($mealPlans as $id =>$mealPlan)--}}
                                        {{--@if($mealPlan->day == 'MO' && $mealPlan->meal_type == 'AfternoonSnack')--}}
                                            {{--<span>{{$mealPlan->meal->description}}</span>--}}
                                        {{--@endif--}}
                                    {{--@endforeach--}}
                                {{--</div>--}}
                            {{--</td>--}}
                            {{--<td>--}}
                                {{--<div class="truncate">--}}
                                    {{--@foreach($mealPlans as $id =>$mealPlan)--}}
                                        {{--@if($mealPlan->day == 'MO' && $mealPlan->meal_type == 'Dinner')--}}
                                            {{--<span>{{$mealPlan->meal->description}}</span>--}}
                                        {{--@endif--}}
                                    {{--@endforeach--}}
                                {{--</div>--}}
                            {{--</td>--}}
                        {{--</tr>--}}
                        {{--<tr>--}}
                            {{--<th>Tu</th>--}}
                            {{--<td>--}}
                                {{--<div class="truncate">--}}
                                    {{--@foreach($mealPlans as $id =>$mealPlan)--}}
                                        {{--@if($mealPlan->day == 'TU' && $mealPlan->meal_type == 'Breakfast')--}}
                                            {{--<span>{{$mealPlan->meal->description}}</span>--}}
                                        {{--@endif--}}
                                    {{--@endforeach--}}
                                {{--</div>--}}
                            {{--</td>--}}
                            {{--<td>--}}
                                {{--<div class="truncate">--}}
                                    {{--@foreach($mealPlans as $id =>$mealPlan)--}}
                                        {{--@if($mealPlan->day == 'TU' && $mealPlan->meal_type == 'MorningSnack')--}}
                                            {{--<span>{{$mealPlan->meal->description}}</span>--}}
                                        {{--@endif--}}
                                    {{--@endforeach--}}
                                {{--</div>--}}
                            {{--</td>--}}
                            {{--<td>--}}
                                {{--<div class="truncate">--}}
                                    {{--@foreach($mealPlans as $id =>$mealPlan)--}}
                                        {{--@if($mealPlan->day == 'TU' && $mealPlan->meal_type == 'Lunch')--}}
                                            {{--<span>{{$mealPlan->meal->description}}</span>--}}
                                        {{--@endif--}}
                                    {{--@endforeach--}}
                                {{--</div>--}}
                            {{--</td>--}}
                            {{--<td>--}}
                                {{--<div class="truncate">--}}
                                    {{--@foreach($mealPlans as $id =>$mealPlan)--}}
                                        {{--@if($mealPlan->day == 'TU' && $mealPlan->meal_type == 'AfternoonSnack')--}}
                                            {{--<span>{{$mealPlan->meal->description}}</span>--}}
                                        {{--@endif--}}
                                    {{--@endforeach--}}
                                {{--</div>--}}
                            {{--</td>--}}
                            {{--<td>--}}
                                {{--<div class="truncate">--}}
                                    {{--@foreach($mealPlans as $id =>$mealPlan)--}}
                                        {{--@if($mealPlan->day == 'TU' && $mealPlan->meal_type == 'Dinner')--}}
                                            {{--<span>{{$mealPlan->meal->description}}</span>--}}
                                        {{--@endif--}}
                                    {{--@endforeach--}}
                                {{--</div>--}}
                            {{--</td>--}}
                        {{--</tr>--}}
                        {{--<tr>--}}
                            {{--<th>We</th>--}}
                            {{--<td>--}}
                                {{--<div class="truncate">--}}
                                    {{--@foreach($mealPlans as $id =>$mealPlan)--}}
                                        {{--@if($mealPlan->day == 'WE' && $mealPlan->meal_type == 'Breakfast')--}}
                                            {{--<span>{{$mealPlan->meal->description}}</span>--}}
                                        {{--@endif--}}
                                    {{--@endforeach--}}
                                {{--</div>--}}
                            {{--</td>--}}
                            {{--<td>--}}
                                {{--<div class="truncate">--}}
                                    {{--@foreach($mealPlans as $id =>$mealPlan)--}}
                                        {{--@if($mealPlan->day == 'WE' && $mealPlan->meal_type == 'MorningSnack')--}}
                                            {{--<span>{{$mealPlan->meal->description}}</span>--}}
                                        {{--@endif--}}
                                    {{--@endforeach--}}
                                {{--</div>--}}
                            {{--</td>--}}
                            {{--<td>--}}
                                {{--<div class="truncate">--}}
                                    {{--@foreach($mealPlans as $id =>$mealPlan)--}}
                                        {{--@if($mealPlan->day == 'WE' && $mealPlan->meal_type == 'Lunch')--}}
                                            {{--<span>{{$mealPlan->meal->description}}</span>--}}
                                        {{--@endif--}}
                                    {{--@endforeach--}}
                                {{--</div>--}}
                            {{--</td>--}}
                            {{--<td>--}}
                                {{--<div class="truncate">--}}
                                    {{--@foreach($mealPlans as $id =>$mealPlan)--}}
                                        {{--@if($mealPlan->day == 'WE' && $mealPlan->meal_type == 'AfternoonSnack')--}}
                                            {{--<span>{{$mealPlan->meal->description}}</span>--}}
                                        {{--@endif--}}
                                    {{--@endforeach--}}
                                {{--</div>--}}
                            {{--</td>--}}
                            {{--<td>--}}
                                {{--<div class="truncate">--}}
                                    {{--@foreach($mealPlans as $id =>$mealPlan)--}}
                                        {{--@if($mealPlan->day == 'WE' && $mealPlan->meal_type == 'Dinner')--}}
                                            {{--<span>{{$mealPlan->meal->description}}</span>--}}
                                        {{--@endif--}}
                                    {{--@endforeach--}}
                                {{--</div>--}}
                            {{--</td>--}}
                        {{--</tr>--}}
                        {{--<tr>--}}
                            {{--<th>Th</th>--}}
                            {{--<td>--}}
                                {{--<div class="truncate">--}}
                                    {{--@foreach($mealPlans as $id =>$mealPlan)--}}
                                        {{--@if($mealPlan->day == 'TH' && $mealPlan->meal_type == 'Breakfast')--}}
                                            {{--<span>{{$mealPlan->meal->description}}</span>--}}
                                        {{--@endif--}}
                                    {{--@endforeach--}}
                                {{--</div>--}}
                            {{--</td>--}}
                            {{--<td>--}}
                                {{--<div class="truncate">--}}
                                    {{--@foreach($mealPlans as $id =>$mealPlan)--}}
                                        {{--@if($mealPlan->day == 'TH' && $mealPlan->meal_type == 'MorningSnack')--}}
                                            {{--<span>{{$mealPlan->meal->description}}</span>--}}
                                        {{--@endif--}}
                                    {{--@endforeach--}}
                                {{--</div>--}}
                            {{--</td>--}}
                            {{--<td>--}}
                                {{--<div class="truncate">--}}
                                    {{--@foreach($mealPlans as $id =>$mealPlan)--}}
                                        {{--@if($mealPlan->day == 'TH' && $mealPlan->meal_type == 'Lunch')--}}
                                            {{--<span>{{$mealPlan->meal->description}}</span>--}}
                                        {{--@endif--}}
                                    {{--@endforeach--}}
                                {{--</div>--}}
                            {{--</td>--}}
                            {{--<td>--}}
                                {{--<div class="truncate">--}}
                                    {{--@foreach($mealPlans as $id =>$mealPlan)--}}
                                        {{--@if($mealPlan->day == 'TH' && $mealPlan->meal_type == 'AfternoonSnack')--}}
                                            {{--<span>{{$mealPlan->meal->description}}</span>--}}
                                        {{--@endif--}}
                                    {{--@endforeach--}}
                                {{--</div>--}}
                            {{--</td>--}}
                            {{--<td>--}}
                                {{--<div class="truncate">--}}
                                    {{--@foreach($mealPlans as $id =>$mealPlan)--}}
                                        {{--@if($mealPlan->day == 'TH' && $mealPlan->meal_type == 'Dinner')--}}
                                            {{--<span>{{$mealPlan->meal->description}}</span>--}}
                                        {{--@endif--}}
                                    {{--@endforeach--}}
                                {{--</div>--}}
                            {{--</td>--}}
                        {{--</tr>--}}
                        {{--<tr>--}}
                            {{--<th>Fr</th>--}}
                            {{--<td>--}}
                                {{--<div class="truncate">--}}
                                    {{--@foreach($mealPlans as $id =>$mealPlan)--}}
                                        {{--@if($mealPlan->day == 'FR' && $mealPlan->meal_type == 'Breakfast')--}}
                                            {{--<span>{{$mealPlan->meal->description}}</span>--}}
                                        {{--@endif--}}
                                    {{--@endforeach--}}
                                {{--</div>--}}
                            {{--</td>--}}
                            {{--<td>--}}
                                {{--<div class="truncate">--}}
                                    {{--@foreach($mealPlans as $id =>$mealPlan)--}}
                                        {{--@if($mealPlan->day == 'FR' && $mealPlan->meal_type == 'MorningSnack')--}}
                                            {{--<span>{{$mealPlan->meal->description}}</span>--}}
                                        {{--@endif--}}
                                    {{--@endforeach--}}
                                {{--</div>--}}
                            {{--</td>--}}
                            {{--<td>--}}
                                {{--<div class="truncate">--}}
                                    {{--@foreach($mealPlans as $id =>$mealPlan)--}}
                                        {{--@if($mealPlan->day == 'FR' && $mealPlan->meal_type == 'Lunch')--}}
                                            {{--<span>{{$mealPlan->meal->description}}</span>--}}
                                        {{--@endif--}}
                                    {{--@endforeach--}}
                                {{--</div>--}}
                            {{--</td>--}}
                            {{--<td>--}}
                                {{--<div class="truncate">--}}
                                    {{--@foreach($mealPlans as $id =>$mealPlan)--}}
                                        {{--@if($mealPlan->day == 'FR' && $mealPlan->meal_type == 'AfternoonSnack')--}}
                                            {{--<span>{{$mealPlan->meal->description}}</span>--}}
                                        {{--@endif--}}
                                    {{--@endforeach--}}
                                {{--</div>--}}
                            {{--</td>--}}
                            {{--<td>--}}
                                {{--<div class="truncate">--}}
                                    {{--@foreach($mealPlans as $id =>$mealPlan)--}}
                                        {{--@if($mealPlan->day == 'FR' && $mealPlan->meal_type == 'Dinner')--}}
                                            {{--<span>{{$mealPlan->meal->description}}</span>--}}
                                        {{--@endif--}}
                                    {{--@endforeach--}}
                                {{--</div>--}}
                            {{--</td>--}}
                        {{--</tr>--}}
                        {{--<tr>--}}
                            {{--<th>Sa</th>--}}
                            {{--<td>--}}
                                {{--<div class="truncate">--}}
                                    {{--@foreach($mealPlans as $id =>$mealPlan)--}}
                                        {{--@if($mealPlan->day == 'SA' && $mealPlan->meal_type == 'Breakfast')--}}
                                            {{--<span>{{$mealPlan->meal->description}}</span>--}}
                                        {{--@endif--}}
                                    {{--@endforeach--}}
                                {{--</div>--}}
                            {{--</td>--}}
                            {{--<td>--}}
                                {{--<div class="truncate">--}}
                                    {{--@foreach($mealPlans as $id =>$mealPlan)--}}
                                        {{--@if($mealPlan->day == 'SA' && $mealPlan->meal_type == 'MorningSnack')--}}
                                            {{--<span>{{$mealPlan->meal->description}}</span>--}}
                                        {{--@endif--}}
                                    {{--@endforeach--}}
                                {{--</div>--}}
                            {{--</td>--}}
                            {{--<td>--}}
                                {{--<div class="truncate">--}}
                                    {{--@foreach($mealPlans as $id =>$mealPlan)--}}
                                        {{--@if($mealPlan->day == 'SA' && $mealPlan->meal_type == 'Lunch')--}}
                                            {{--<span>{{$mealPlan->meal->description}}</span>--}}
                                        {{--@endif--}}
                                    {{--@endforeach--}}
                                {{--</div>--}}
                            {{--</td>--}}
                            {{--<td>--}}
                                {{--<div class="truncate">--}}
                                    {{--@foreach($mealPlans as $id =>$mealPlan)--}}
                                        {{--@if($mealPlan->day == 'SA' && $mealPlan->meal_type == 'AfternoonSnack')--}}
                                            {{--<span>{{$mealPlan->meal->description}}</span>--}}
                                        {{--@endif--}}
                                    {{--@endforeach--}}
                                {{--</div>--}}
                            {{--</td>--}}
                            {{--<td>--}}
                                {{--<div class="truncate">--}}
                                    {{--@foreach($mealPlans as $id =>$mealPlan)--}}
                                        {{--@if($mealPlan->day == 'SA' && $mealPlan->meal_type == 'Dinner')--}}
                                            {{--<span>{{$mealPlan->meal->description}}</span>--}}
                                        {{--@endif--}}
                                    {{--@endforeach--}}
                                {{--</div>--}}
                            {{--</td>--}}
                        {{--</tr>--}}

                    {{--<p style="margin-left: 10px;">*Please click calendar title to see meal legend</p>--}}

                    {{--<div class="card-reveal">--}}
                        {{--<span class="card-title grey-text text-darken-4"><i class="material-icons right">close</i></span>--}}
                        {{--<ul class="collection">--}}
                            {{--<li class="collection-item light-green lighten-1 white-text">--}}
                                {{--<span class="collection-header">Meal Legend</span>--}}
                            {{--</li>--}}
                            {{--<li class="collection-item" style="margin-left: 10px;">--}}
                                {{--Bre: Breakfast--}}
                            {{--</li>--}}
                            {{--<li class="collection-item" style="margin-left: 10px;">--}}
                                {{--Sna: Snack--}}
                            {{--</li>--}}
                            {{--<li class="collection-item" style="margin-left: 10px;">--}}
                                {{--Lun: Lunch--}}
                            {{--</li>--}}
                            {{--<li class="collection-item" style="margin-left: 10px;">--}}
                                {{--Din: Dinner--}}
                            {{--</li>--}}
                        {{--</ul>--}}
                    {{--</div>--}}
                    @else
                        <div class="light-green lighten-1 white-text activator dshMnClTtl">
                            <span>Nothing Ordered for this week</span>
                        </div>
                        <div class="dshNoOrd">
                            <a href="{{route('foodie.plan.show')}}"> Take a Look at our available plans!</a>
                        </div>
                    @endif
                </div>
                <ul class="collection">
                    <li class="collection-item light-green lighten-1 white-text">
                        <span class="collection-header">Messages From Chef</span>
                    </li>
                    @if($messages->count()>0)
                        @foreach($chats->take(3) as $chat)
                            @if($chat->message->where('is_read',0)->where('receiver_type','f')->count()>0)
                                <li class="collection-item">
                                    @foreach($chefs as $chef)
                                        @if($chef->id == $chat->chef_id)
                                                <i class="material-icons">message</i>
                                                Message From: {{$chef->name}}<br>
                                                <a href="{{route('foodie.message.message', $chat->id)}}">
                                                    <h6>Message:</h6>
                                                    <p class="truncate">{{$chat->message()->latest()->first()->subject}}</p>
                                                </a>
                                        @endif
                                    @endforeach
                                </li>
                            @endif
                        @endforeach
                    @else
                        <li class="collection-item">
                            <span>No new messages!</span>
                        </li>
                    @endif
                </ul>
                <ul class="collection">
                    <li class="collection-item light-green lighten-1 white-text">
                        <span class="collection-header">Suggested Meal Plans</span>
                    </li>
                    @if(count($suggested)>0)
                        @foreach($suggested as $sug)
                            <li class="collection-item">
                                <a href="{{route('foodie.plan.standard', $sug['id'])}}">{{$sug['name']}}</a>
                            </li>
                        @endforeach
                    @else
                        <li class="collection-item">
                            <span>No Plans!</span>
                        </li>
                    @endif
                </ul>
            </div>
            <div class="col s12 m6 l6">
                <div>
                    <ul class="collection">
                        <li class="collection-item light-green lighten-1 white-text">
                            <div class="collection-header">Pending Orders</div>
                        </li>
                        @if($orders->count()>0)
                            @foreach($orderArray as $order)

                                <li class="collection-item">
                                    <a href="{{route('order.show',$order['id'])}}">
                                        <p>Order Address: {{$order['address']}}</p>
                                        <div class="divider"></div>
                                        <p>Number of Items: {{$order['quantity']}}</p>
                                        <div class="divider"></div>
                                        <p>Week: {{$order['week']}}</p>
                                        <div class="divider"></div>
                                        <p>Total: {{$order['total']}}</p>
                                    </a>
                                </li>
                            @endforeach
                        @else
                            <li class="collection-item">
                                <span>No Pending Orders</span>
                                {{--<div>--}}
                                    {{--<a href="{{route('foodie.chef.show')}}"> Take a Look at our chefs and plans!</a>--}}
                                {{--</div>--}}
                            </li>
                        @endif
                    </ul>
                </div>
                <div class="col s12 m6 l6" style="padding: 0;">
                    <ul class="collection">
                        <li class="collection-item light-green lighten-1 white-text">
                            <div class="collection-header">Pending Ratings</div>
                        </li>
                        @if(count($ordersChefs)>0)
                                @foreach($ordersChefs as $rating)
                                    <li class="collection-item">
                                        <a href="{{route('chef.rating')}}">
                                            <i class="material-icons">stars</i>
                                            {{$rating['chef']}}<br>
                                        </a>
                                    </li>
                                @endforeach
                            @else
                            <li class="collection-item">
                                <span>No Pending Ratings!</span>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div id="addCover" class="modal">
        <div class="modal-content">
            <form id="coverPhoto" method="post" action="{{route('foodie.profile.coverPhoto')}}" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="row">
                    <div class="file-field input-field">
                        <label for="planPic" class="active">Picture Upload:</label>
                        <div style="padding-top: 10px;">
                            <div class="btn">
                                <span>File</span>
                                <input type="file" data-error=".error-pic" id="cover" name="cover">
                            </div>
                            <div class="file-path-wrapper">
                                <input class="file-path validate" type="text" >
                            </div>
                            <div class="error-pic err"></div>
                        </div>
                    </div>
                </div>
                <div>
                    <input type="submit" value="Submit" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>


@endsection
    {{--<div class="container">--}}
        {{--<div class="row">--}}
            {{--<div class="col m8 offset-m2">--}}
                {{--<h1 class="center white-text">Dashboard</h1>--}}
                {{--<h3 class="center full-width white-text" style="font-size: 1.5em">You are logged in! Welcome--}}
                    {{--back, {{ $foodie->first_name }}!</h3>--}}
                {{--<div class="card papaya-whip">--}}
                    {{--<div class="card-content">--}}
                        {{--<h4 class="mustard-text">Pending Orders:</h4>--}}
                        {{--<div>--}}
                            {{--@if($ordersCount>0)--}}
                                {{--@foreach($orders as $order)--}}
                                    {{--<a href="{{route('order.show',$order->id)}}">--}}
                                        {{--<div>--}}
                                            {{--<div>Chef: {{$order->chef->name}}</div>--}}
                                            {{--<div>Plan Name: {{$order->plan->plan_name}}</div>--}}
                                            {{--<div>Plan Price: {{$order->plan->price}}</div>--}}
                                        {{--</div>--}}
                                    {{--</a>--}}
                                    {{--<hr>--}}
                                {{--@endforeach--}}
                            {{--@else--}}
                                {{--<div>--}}
                                    {{--<h5>No Pending Orders!</h5>--}}
                                {{--</div>--}}

                            {{--@endif--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
            {{--<div class="row">--}}
                {{--<div class="col m8 offset-m2">--}}
                    {{--<div class="card papaya-whip">--}}
                        {{--<div class="card-content">--}}
                            {{--<h4 class="mustard-text">Pending Ratings:</h4>--}}
                            {{--<div>--}}
                                {{--@if($ratingsCount>0)--}}
                                    {{--<div>--}}
                                        {{--<div><a href="{{route('chef.rating')}}">Chef Name: {{$ordersRating->chef->name}}</a></div>--}}
                                    {{--</div>--}}
                                {{--@else--}}
                                    {{--<div>--}}
                                        {{--<h5>No Pending Ratings!</h5>--}}
                                    {{--</div>--}}
                                {{--@endif--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
                {{--<div class="card papaya-whip">--}}
                    {{--<div class="card-content">--}}
                        {{--<h4 class="mustard-text">Suggested Meal Plans:</h4>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class="card papaya-whip">--}}
                {{--<div class="card-content">--}}
                {{--<h4 class="mustard-text">Meal Plans:</h4>--}}
                {{--</div>--}}
                {{--</div>--}}

                {{--<form id="logout" method="post" action="{{ route('foodie.logout') }}">--}}
                {{--{{ csrf_field() }}--}}
                {{--<a id="logout-link" href="#">--}}
                {{--Logout--}}
                {{--</a>--}}
                {{--</form>--}}
