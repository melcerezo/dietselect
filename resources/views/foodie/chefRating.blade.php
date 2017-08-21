@extends('foodie.layout')

@section('page_content')

    <div class="container" style="margin-top: 10px;">
        <div class="row">
            <nav class="light-green lighten-1 white-text">
                <div class="left col s12">
                    <ul>
                        <li>
                            <span style="font-size: 20px;">Ratings</span>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        @if(count($ordersRatingChef)>0)
            @foreach($ordersRatingChef as $key=>$order)
                <div class="row">
                    <div class="card">
                        <nav class="light-green lighten-1 white-text">
                            <div class="left col s12">
                                <ul>
                                    <li>
                                        <span style="font-size: 20px;">Rating: {{ $order['plan'].' '.$order['type'] }}</span>
                                    </li>
                                </ul>
                            </div>
                        </nav>
                        <div class="card-content">
                            <span>Please Rate the Plan!</span>
                            <form action="{{route('rate.chef', [$order['id'],$key])}}" method="post">
                                {{csrf_field()}}
                                <input name="rate{{$key}}" type="radio" id="test1{{$key}}" value="1" checked/>
                                <label for="test1{{$key}}">1</label>

                                <input name="rate{{$key}}" type="radio" id="test2{{$key}}" value="2"/>
                                <label for="test2{{$key}}">2</label>

                                <input class="with-gap" name="rate{{$key}}" type="radio" id="test3{{$key}}" value="3"/>
                                <label for="test3{{$key}}">3</label>

                                <input class="with-gap" name="rate{{$key}}" type="radio" id="test4{{$key}}" value="4"/>
                                <label for="test4{{$key}}">4</label>

                                <input class="with-gap" name="rate{{$key}}" type="radio" id="test5{{$key}}" value="5"/>
                                <label for="test5{{$key}}">5</label>

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

                                    {{--@else--}}
                                {{--@endif--}}

                    </div>
                </div>
            @endforeach
        @else
            <div class="row">
                <div class="card-panel">
                    <p>No ratings yet!</p>
                </div>
            </div>
        @endif
    </div>
@endsection