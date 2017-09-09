@extends('layouts.app')
@section('head')
    <style>
        .picSection{ width:100%; height:100%; }
        .planGallery{ padding:0 15px; }
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
            <div class="col s12 m4">
                <div class="light-green picSection">
                    <img class="responsive-img" src="/img/loss.png">
                </div>
            </div>
            <div class="col s12 m6">
                <div>
                    <div>
                        <span style="font-size: 30px;">Plan Name</span>
                    </div>
                    <div class="divider"></div>
                    <div class="menu">
                        <div class="row">
                            <div class="col s12 m4">
                                <button class="btn orange waves-effect waves-light">Menu</button>
                            </div>
                            <div class="col s12 m4">
                                <button class="btn orange waves-effect waves-light">Menu</button>
                            </div>
                            <div class="col s12 m4">
                                <button class="btn orange waves-effect waves-light">Menu</button>
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
                    </div>
                </div>
                <div class="divider"></div>
                <div>

                </div>
            </div>
        </div>
    </div>
@endsection