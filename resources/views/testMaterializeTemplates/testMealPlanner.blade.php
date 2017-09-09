@extends('layouts.app')
@section('head')
    <style>
        .picSection{ width:100%; height:100%; }
        .planGallery{ padding:0 15px; }
        .planName,.planPrice { margin: 10px 0; }
        .planName { font-size: 30px; }
        .actionMenu { margin:0; }
        .menu { padding: 10px 0; }
        .chef,.category,.description { margin-bottom: 10px; }
        .infoSection{ margin:10px 0; }
        .galleryItem{ width:100%; height:100%; margin-bottom: 10px; }
    </style>
    <script>

    </script>
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col s12 m2">
                <div class="planGallery">
                    <div class="galleryItem light-green">
                        <img class="responsive-img" src="/img/loss.png">
                    </div>
                    <div class="galleryItem light-green">
                        <img class="responsive-img" src="/img/loss.png">
                    </div>
                    <div class="galleryItem light-green">
                        <img class="responsive-img" src="/img/loss.png">
                    </div>
                </div>
            </div>
            <div class="col s12 m3">
                <div class="light-green picSection">
                    <img class="responsive-img" src="/img/loss.png">
                </div>
            </div>
            <div class="col s12 m7">
                <div>
                    <div class="planName">
                        <span>Plan Name</span>
                    </div>
                    <div class="divider"></div>
                    <div class="planPrice">
                        <span>Price</span>
                    </div>
                    <div class="divider"></div>
                    <div class="menu">
                        <div class="row actionMenu">
                            <div class="col s12 m4 bookingWeek">
                                Week of: September 21
                            </div>
                            <div class="col s12 m5">
                                <button class="btn orange waves-effect waves-light">Customize</button>
                            </div>
                            <div class="col s12 m3">
                                <button class="btn orange waves-effect waves-light">Cart</button>
                            </div>
                        </div>
                    </div>
                    <div class="divider"></div>
                    <div class="infoSection">
                        <div class="chef">
                            Chef Name
                        </div>
                        <div class="category">
                            Category
                        </div>
                        <div class="description">
                            Description of this Item.
                        </div>
                        <div class="menu">
                            <button class="btn orange waves-effect waves-light">Menu</button>
                        </div>
                    </div>
                </div>
                <div class="divider"></div>
                <div>

                </div>
            </div>
        </div>
    </div>
@endsection