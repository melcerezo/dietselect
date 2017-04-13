@extends('foodie.layout')

@section('page_content')

    <div class="container">
        <div class="row">
            <div class="card">
                <div class="card-panel">
                    @foreach($orders as $order)
                        @foreach($order->ratings as $rating)
                            @if($rating->foodie_id == $order->foodie_id)
                                @if($rating->is_rated == 0)
                                    {{date('Y-m-d @  g:i A', strtotime($order->created_at))}}<br>
                                    {{$order->chef->name}}<br>
                                    {{$order->plan->price}}<br>
                                    <a role="button" data-target="rate-chef" class="modal-trigger">Rate Chef <i
                                                class="fa fa-star"></i></a>
                                    <br><br>
                                    <div id="rate-chef" class="modal">
                                        <form action="{{route('rate.chef', $order->id)}}" method="post">
                                            {{csrf_field()}}
                                            <p>
                                                <input name="rate" type="radio" id="test1" value="1"/>
                                                <label for="test1">1</label>
                                            </p>
                                            <p>
                                                <input name="rate" type="radio" id="test2" value="2"/>
                                                <label for="test2">2</label>
                                            </p>
                                            <p>
                                                <input class="with-gap" name="rate" type="radio" id="test3" value="3"/>
                                                <label for="test3">3</label>
                                            </p>
                                            <p>
                                                <input class="with-gap" name="rate" type="radio" id="test4" value="4"/>
                                                <label for="test4">4</label>
                                            </p>
                                            <p>
                                                <input class="with-gap" name="rate" type="radio" id="test5" value="5"/>
                                                <label for="test5">5</label>
                                            </p>

                                            <div class="row">
                                                <div class="input-field col s12">
        <textarea id="textarea1" class="materialize-textarea" data-length="120"
                  name="feedback"></textarea>
                                                    <label for="textarea1">Comment:</label>
                                                </div>
                                            </div>

                                            <input type="submit" value="Submit">
                                        </form>
                                    </div>
                                @endif
                            @endif
                        @endforeach
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection