@extends('chef.layout')

@section('page_head')

@endsection

@section('page_content')
    <div class="container">
        <form action="{{route('chef.message.send')}}" method="post" autocomplete="off">
            {{csrf_field()}}
            <div class="row">
                <div class="input-field col s6">
                    <input placeholder="message" id="chefMessage" name="chefMessage" type="text" class="validate">
                </div>
            </div>
            <label for="chefMessageSelect">Receiver</label>
            <div class="input-field col s12">
                <select id="chefMessageSelect" name="chefMessageSelect">
                    <option value="" disabled selected>Choose Receiver</option>
                    @foreach($foodies as $foodie)
                        <option value="{{$foodie->id}}">{{$foodie->username}}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <div><input type="submit" value="Submit" class="btn btn-primary"></div>
            </div>
        </form>
    </div>
@endsection