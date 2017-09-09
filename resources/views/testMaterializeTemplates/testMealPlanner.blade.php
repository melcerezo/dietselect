@extends('layouts.app')
@section('head')
    <style>
        .picSection{ width:400px; height:400px; }
        .galleryItem{ width:50px; height:50px; margin-bottom: 10px; }
    </style>
    <script>

    </script>
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <span style="font-size: 30px;">Plan Name</span>
        </div>
        <div class="row">
            <div class="col s12 m2">
                <div class="planGallery valign-wrapper">
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
            <div class="col s12 m6">
                <div class="light-green picSection">
                    <img class="responsive-img" src="/img/loss.png">
                </div>
                <div>
                    <div class="chef">
                    </div>
                    <div class="section">
                    </div>
                    <div class="Description">
                    </div>
                    <div class="menu">
                    </div>
                </div>
            </div>
            <div class="col s12 m4">
                <div>

                </div>
                <div>

                </div>
            </div>
        </div>
    </div>
@endsection