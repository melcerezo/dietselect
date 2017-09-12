@extends('foodie.layout')
@section('page_head')
    <link rel="stylesheet" href="/css/foodie/foodieRating.css">
    <script>
        from = '{{$from}}'
    </script>
    <script src="/js/foodie/rating.js" defer></script>
@endsection
@section('page_content')

    <div class="container" style="width: 85%; margin-top: 10px;">
       {{----}}
        {{--<div class="row">--}}
            {{--<span style="font-size: 20px;">Ratings</span>--}}
        {{--</div>--}}
        {{--</div>--}}

    <div class="row">
        <div id="pending" class="col s12 offset-m2 m2">
            <span class="pending tabRating">Pending</span>
        </div>
        <div id="finished" class="col s12 m2">
            <span class="finished tabRating">Finished</span>
        </div>
    </div>
    <div class="row">
        <div class="col s12 m2" style="padding: 0">
            <div class="row">
                <div>
                    EDIT PROFILE
                </div>
            </div>
            <div class="divider"></div>
            <div class="row" style="margin: 0;">
                <ul class="collection">
                    <li class="collection-item">
                        <a href="{{route("foodie.order.view", ['id'=> 0])}}">Order History</a>
                    </li>
                    <li class="collection-item">
                        <a href="{{route('foodie.plan.show')}}">Browse Plans</a>
                    </li>
                    <li class="collection-item">
                        <a href="{{route('foodie.profile')}}">Profile</a>
                    </li>
                    <li class="collection-item" style="border: 1px solid #f57c00;">
                        <a href="{{route('foodie.message.index')}}" style="color: #f57c00;">Messages</a>
                    </li>
                    <li class="collection-item">
                        <a href="{{route('chef.rating', ['id'=>1])}}">Ratings</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col s12 m10">
            <div id="pendingRating" class="row ratingTab">
                @if(count($ordersRatingChef)>0)
                    @foreach($ordersRatingChef as $key=>$order)
                        <div class="row">
                            <div class="card">
                                <div class="left col s12" style="margin: 10px 5px;">
                                    <span style="font-size: 20px;">{{ $order['plan'].' '.$order['type'] }}</span>
                                </div>
                                <div class="card-content">
                                    <div>Please Rate the Plan!</div>
                                    <form class="ratingForm" action="{{route('rate.chef', [$order['id'],$key])}}" method="post">
                                        {{csrf_field()}}

                                        <input type="hidden" name="rating" id="rate{{$key}}" data-error=".error{{$key}}" value=""/>
                                        <div id="rateYo{{$key}}"></div>
                                        <div class="error{{$key}} err">
                                        </div>
                                        <script>
                                            $(function () {
                                                $("#rateYo{{$key}}").rateYo({
                                                    rating: 1,
                                                    fullStar: true
                                                });

                                                $("#rateYo{{$key}}").rateYo()
                                                        .on("rateyo.set", function (e, data) {
                                                            var $rate = data.rating;

                                                            $('input#rate{{$key}}').val($rate);
                                                            window.alert("Its " + $('input#rate{{$key}}').val() + " Yo!");
                                                        });

                                            });
                                        </script>

                                        {{--<span class="starRating">--}}
                                            {{--<input name="rate{{$key}}" type="radio" id="test1{{$key}}" value="1" checked/>--}}
                                            {{--<label for="test1{{$key}}">1</label>--}}

                                            {{--<input name="rate{{$key}}" type="radio" id="test2{{$key}}" value="2"/>--}}
                                            {{--<label for="test2{{$key}}">2</label>--}}

                                            {{--<input class="with-gap" name="rate{{$key}}" type="radio" id="test3{{$key}}" value="3"/>--}}
                                            {{--<label for="test3{{$key}}">3</label>--}}

                                            {{--<input class="with-gap" name="rate{{$key}}" type="radio" id="test4{{$key}}" value="4"/>--}}
                                            {{--<label for="test4{{$key}}">4</label>--}}

                                            {{--<input class="with-gap" name="rate{{$key}}" type="radio" id="test5{{$key}}" value="5"/>--}}
                                            {{--<label for="test5{{$key}}">5</label>--}}
                                        {{--</span>--}}
                                        <div class="row">
                                            <div class="input-field col s12">
                                        <textarea id="textarea1{{$key}}" class="materialize-textarea" data-length="120"
                                                  name="feedback{{$key}}"></textarea>
                                                <label for="textarea1">Comment:</label>
                                            </div>
                                        </div>

                                        <input type="submit" value="Submit" class="btn waves-effect waves-light">
                                    </form>
                                    <div style="margin-top: 20px;">
                                        <span>Thank you for Rating!</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="row">
                        <div class="card-panel">
                            <p>No pending ratings!</p>
                        </div>
                    </div>
                @endif
            </div>
            <div id="finishedRating" class="row ratingTab">
                @if(count($ordersRatingsFinished)>0)
                    @foreach($ordersRatingsFinished as $key=>$order)
                        <div class="row">
                            <div class="card-panel">
                                <div style="margin: 10px 5px;">
                                    <span style="font-size: 20px;"><img style="width: 100px;" src="/img/{{ $order['picture'] }}"><span style="margin-left: 10px;">{{ $order['plan'].' '.$order['type'] }}</span></span>
                                </div>
                                <div>
                                    <span>Rating:</span>
                                </div>
                                <div id="rateYoFinish{{$key}}" style="margin-bottom: 60px;"></div>
                                <script>
                                    $(function () {
                                        $("#rateYoFinish{{$key}}").rateYo({
                                            rating: '{{$order['rating']}}',
                                            fullStar: true,
                                            readOnly: true
                                        });
                                    });
                                </script>
                                <div>
                                    @if($order['feedback']!=null)
                                        <p>Comment: {{$order['feedback']}}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="row">
                        <div class="card-panel">
                            <p>No Ratings!</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection