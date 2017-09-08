@extends('layouts.app')
@section('content')
    <style>
        .buyBtn{ display: none;}
        .row.products .col { padding:0; }
        div.buyCard { box-shadow: none !important; }
        div.buyCard:hover{ border: 1px solid #d1d1d1; }
    </style>
    <script>
        $(document).ready(function () {
            $('div.buyCard').hover(function () {
                $(this).find('.card-content').find('.buyBtn').stop().fadeIn();
            }, function () {
                $(this).find('.card-content').find('.buyBtn').stop().fadeOut();
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
            <div class="col s12 m4">
                Delicious Diet
            </div>
            <div class="col s12 m4">
                Wellness Getaway
            </div>
            <div class="col s12 m4">
                Gourmet Kusina
            </div>
        </div>
        <div class="row products">
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
