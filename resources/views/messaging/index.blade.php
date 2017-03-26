@extends('chef.layout')

@section('page_content')
    <form action="" method="post">
        <div class="row">
            <div class="input-field col s6">
                <input placeholder="message" id="firs t_name" name="message" type="text" class="validate">
            </div>
        </div>

        <div class="input-field col s12">
            <select>
                <option value="" disabled selected>Choose your option</option>
                <option value="1">Option 1</option>
                <option value="2">Option 2</option>
                <option value="3">Option 3</option>
            </select>
            <label>Materialize Select</label>
        </div>

    </form>
@endsection