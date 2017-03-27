@extends('foodie.layout')

@section('page_head')

@endsection

@section('page_content')
    <div class="container">
        <form action="{{route('foodie.message.send')}}" method="post" autocomplete="off">
            {{csrf_field()}}
            <div class="row">
                <div class="input-field col s6">
                    <input placeholder="message" id="foodieMessage" name="foodieMessage" type="text" class="validate">
                </div>
            </div>
            <label for="foodieMessageSelect">Receiver</label>
            <div class="input-field col s12">
                <select id="foodieMessageSelect" name="foodieMessageSelect">
                    <option value="" disabled selected>Choose Receiver</option>
                    @foreach($chefs as $chef)
                        <option value="{{$chef->id}}">{{$chef->name}}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <div><input type="submit" value="Submit" class="btn btn-primary"></div>
            </div>
        </form>
    </div>
@endsection