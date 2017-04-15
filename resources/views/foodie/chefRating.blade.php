@extends('foodie.layout')

@section('page_content')

    <div class="container">
        <div class="row">
            <div class="card">
                <div class="card-panel">
                            @if($ratings->is_rated == 0)
                                {{$orders->chef->name}}
                                <form action="{{route('rate.chef', $orders->id)}}" method="post">
                                    {{csrf_field()}}
                                    <input name="rate" type="radio" id="test1" value="1"/>
                                    <label for="test1">1</label>

                                    <input name="rate" type="radio" id="test2" value="2"/>
                                    <label for="test2">2</label>

                                    <input class="with-gap" name="rate" type="radio" id="test3" value="3"/>
                                    <label for="test3">3</label>

                                    <input class="with-gap" name="rate" type="radio" id="test4" value="4"/>
                                    <label for="test4">4</label>

                                    <input class="with-gap" name="rate" type="radio" id="test5" value="5"/>
                                    <label for="test5">5</label>

                                    <div class="row">
                                        <div class="input-field col s12">
                                    <textarea id="textarea1" class="materialize-textarea" data-length="120"
                                              name="feedback"></textarea>
                                            <label for="textarea1">Comment:</label>
                                        </div>
                                    </div>

                                    <input type="submit" value="Submit">
                                </form>

                                @else
                                    <div><h3>Thank you for Rating!</h3></div>
                            @endif


                </div>
            </div>
        </div>
    </div>
@endsection