@extends('layouts.app')
@section('content')
    <style>
        .buyBtn{ display: none;}

    </style>
    <script>
        $(document).ready(function () {
            $('div.buyCard').on('mouseenter',function () {
                $(this).children('.buyBtn').show();
                console.log($(this).children('.buyBtn'));
            });
            $('div.buyCard').on('mouseleave',function () {
                $(this).children('.buyBtn').hide();
                console.log('stuff');
            });
        });
    </script>
    <div class="container">
        <div class="row">
            <div class="col s12 m4" >
                <div class="light-green" style="height: 200px;">
                </div>
            </div>
            <div class="col s12 m4">
                <div class="light-green" style="height: 200px;">
                </div>
            </div>
            <div class="col s12 m4">
                <div class="light-green" style="height: 200px;">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col s12 m2">
                Delicious Diet
            </div>
            <div class="col s12 m2">
                Wellness Getaway
            </div>
            <div class="col s12 m2">
                Gourmet Kusina
            </div>
        </div>
        <div class="row">
            <div class="col s12 m3">
                <div class="card buyCard">
                    <div class="card-image">
                        <img src="img/bg.jpg">
                        <div class="orange white-text" style="position: absolute; left: 5px; top: 5px;">
                            PHP 1,800.00
                        </div>
                    </div>
                    <div class="card-content">
                        <div>
                            Diet 1
                        </div>
                        <div>
                            Description about this diet.
                        </div>
                        <div class="buyBtn center-align">
                            <button class="orange btn btn-primary waves-effect waves-light">Buy Now</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col s12 m3">
                <div class="card buyCard">
                    <div class="card-image">
                        <img src="img/bg.jpg">
                        <div class="orange white-text" style="position: absolute; left: 5px; top: 5px;">
                            PHP 1,800.00
                        </div>
                    </div>
                    <div class="card-content">
                        <div>
                            Diet 2
                        </div>
                        <div>
                            Description about this diet.
                        </div>
                        <div class="buyBtn center-align">
                            <button class="orange btn btn-primary waves-effect waves-light">Buy Now</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col s12 m3">
                <div class="card buyCard">
                    <div class="card-image">
                        <img src="img/bg.jpg">
                        <div class="orange white-text" style="position: absolute; left: 5px; top: 5px;">
                            PHP 1,800.00
                        </div>
                    </div>
                    <div class="card-content">
                        <div>
                            Diet 3
                        </div>
                        <div>
                            Description about this diet.
                        </div>
                        <div class="buyBtn center-align">
                            <button class="orange btn btn-primary waves-effect waves-light">Buy Now</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col s12 m3">
                <div class="card buyCard">
                    <div class="card-image">
                        <img src="img/bg.jpg">
                        <div class="orange white-text" style="position: absolute; left: 5px; top: 5px;">
                            PHP 1,800.00
                        </div>
                    </div>
                    <div class="card-content">
                        <div>
                            Diet 4
                        </div>
                        <div>
                            Description about this diet.
                        </div>
                        <div class="buyBtn center-align">
                            <button class="orange btn btn-primary waves-effect waves-light">Buy Now</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
