@extends('layouts.app')
@section('content')

    <nav>
        <div class="nav-wrapper light-green lighten-1">
            <div style="margin-left: 10px;">
                <a href="#!" class="brand-logo">Diet Select</a>
            </div>
            <ul id="nav-mobile" class="right hide-on-med-and-down">
                <li>
                    <a>
                        <span class="valign-wrapper" style="position: relative;">
                            <i class="material-icons" style="display: inline">email</i>
                            <span style="margin-left: 2px;">
                                Messages
                                <span class="new badge red">4</span>
                            </span>
                        </span>
                    </a>
                </li>
                <li>
                    <a>
                        <span class="valign-wrapper">
                            <i class="material-icons" style="display: inline">announcement</i>
                            <span style="margin-left: 2px;">
                                Notifications
                                <span class="new badge red">2</span>
                            </span>
                        </span>
                    </a>
                </li>
                <li>
                    <a>
                        <img class="circle" src="/img/user.jpg" style="width: 40px; height: 40px; position: relative;">
                        <span style="margin-left: 2px;">Profile</span>
                    </a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container" style="width:85%;">
        <div class="row">
            <div class="col s12 m6 l4">
                <div class="card">
                    <div class="card-image" style="height:200px;">
                       <img src="img/diet-meal-1.jpg" style="height: 100%">
                    </div>
                    <div class="card-content">
                        <img src="img/user.jpg" class="circle" style="
                        width: 70px;
                        position: absolute;
                        right:20px;
                        bottom:183px;
                        ">
                        <span class="card-title">Melchor Cerezo</span>
                        <div class="divider" style="margin-bottom:10px;"></div>
                        <div style="margin: 10px 0;">
                            <p>Birthday: 10-03-89</p>
                            <p>Email: melcerezo@gmail.com</p>
                            <p>Phone Number:09273656642</p>
                            <p class="truncate">Address: Unit 2636, Tower D, SM Jazz Residences, N. Garcia Cor. Jupiter St., Bel-Air, Makati</p>
                        </div>
                        <div>
                            <a href="#!">Edit Profile</a>
                        </div>
                        {{--<p>I am a very simple card. I am good at containing small bits of information. I am convenient because I require little markup to use effectively.</p>--}}
                    </div>
                </div>
                <div class="card">
                    <div class="light-green lighten-1 white-text activator" style="line-height: 1.5rem;
                                padding: 10px 20px;
                                margin: 0;">
                            <span>
                                Plan for Week of: April 1-7
                            </span>
                    </div>
                    <table style="table-layout: fixed;">
                        <tr>
                            <th></th>
                            <th>Bre</th>
                            <th>Sna</th>
                            <th>Lun</th>
                            <th>Sna</th>
                            <th>Din</th>
                        </tr>
                        <tr>
                            <th>Mo</th>
                            <td><div class="truncate">Meal 1</div><i class="material-icons">done</i></td>
                            <td><div class="truncate">Meal 2</div><i class="material-icons">done</i></td>
                            <td><div class="truncate">Meal 3</div><i class="material-icons">done</i></td>
                            <td><div class="truncate">Meal 4</div></td>
                            <td><div class="truncate">Meal 5</div></td>
                        </tr>
                        <tr>
                            <th>Tu</th>
                            <td><div class="truncate">Meal 6</div></td>
                            <td><div class="truncate">Meal 7</div></td>
                            <td><div class="truncate">Meal 8</div></td>
                            <td><div class="truncate">Meal 9</div></td>
                            <td><div class="truncate">Meal 10</div></td>
                        </tr>
                        <tr>
                            <th>We</th>
                            <td><div class="truncate">Meal 11</div></td>
                            <td><div class="truncate">Meal 12</div></td>
                            <td><div class="truncate">Meal 13</div></td>
                            <td><div class="truncate">Meal 14</div></td>
                            <td><div class="truncate">Meal 15</div></td>
                        </tr>
                        <tr>
                            <th>Th</th>
                            <td><div class="truncate">Meal 16</div></td>
                            <td><div class="truncate">Meal 17</div></td>
                            <td><div class="truncate">Meal 18</div></td>
                            <td><div class="truncate">Meal 19</div></td>
                            <td><div class="truncate">Meal 20</div></td>
                        </tr>
                        <tr>
                            <th>Fr</th>
                            <td><div class="truncate">Meal 21</div></td>
                            <td><div class="truncate">Meal 22</div></td>
                            <td><div class="truncate">Meal 23</div></td>
                            <td><div class="truncate">Meal 24</div></td>
                            <td><div class="truncate">Meal 25</div></td>
                        </tr>
                        <tr>
                            <th>Sa</th>
                            <td><div class="truncate"></div></td>
                            <td><div class="truncate"></div></td>
                            <td><div class="truncate"></div></td>
                            <td><div class="truncate"></div></td>
                            <td><div class="truncate"></div></td>
                        </tr>
                    </table>
                    <p style="margin-left: 10px;">*Please click calendar title to see meal legend</p>

                    <div class="card-reveal">
                        <span class="card-title grey-text text-darken-4"><i class="material-icons right">close</i></span>
                        <ul class="collection">
                            <li class="collection-item light-green lighten-1 white-text">
                                <span class="collection-header">Meal Legend</span>
                            </li>
                            <li class="collection-item" style="margin-left: 10px;">
                                Bre: Breakfast
                            </li>
                            <li class="collection-item" style="margin-left: 10px;">
                                Sna: Snack
                            </li>
                            <li class="collection-item" style="margin-left: 10px;">
                                Lun: Lunch
                            </li>
                            <li class="collection-item" style="margin-left: 10px;">
                                Din: Dinner
                            </li>
                        </ul>
                    </div>
                </div>
                <ul class="collection">
                    <li class="collection-item light-green lighten-1 white-text">
                        <span class="collection-header">Messages From Chef</span>
                    </li>
                    <li class="collection-item">
                        <i class="material-icons">message</i>
                        Message From: Chef 1<br>
                        <h6>Message:</h6>
                        <p>I have received your payment. Reservation confirmed!</p>
                    </li>
                    <li class="collection-item">
                        <i class="material-icons">message</i>
                        Message From: Chef 2<br>
                        <h6>Message:</h6>
                        <p>Please pay your payment!</p>
                    </li>
                    <li class="collection-item">
                        <i class="material-icons">message</i>
                        Message From: Chef 3<br>
                        <h6>Message:</h6>
                        <p>No Payments!</p>
                    </li>
                </ul>
                <ul class="collection">
                    <li class="collection-item light-green lighten-1 white-text">
                        <span class="collection-header">Suggested Meal Plans</span>
                    </li>
                    <li class="collection-item">
                        Chef Plan 3
                    </li>

                </ul>
            </div>
            <div class="col s12 m6 l6">
                <div>
                    <ul class="collection">
                        <li class="collection-item light-green lighten-1 white-text">
                            <div class="collection-header">Pending Order</div>
                        </li>
                        <li class="collection-item">
                            <p>Chef Plan 1</p>
                            <div class="divider"></div>
                            <p>Total Calories: 1200</p>
                            <div class="divider"></div>
                            <p>Price: Php 5000</p>
                        </li>
                    </ul>
                </div>
                <div class="col s12 m6 l6" style="padding: 0;">
                    <ul class="collection">
                        <li class="collection-item light-green lighten-1 white-text">
                            <div class="collection-header">Pending Ratings</div>
                        </li>
                        <li class="collection-item">
                            <i class="material-icons">stars</i>
                            Chef 2 Plan<br>
                        </li>
                    </ul>
                </div>
            </div>
            </div>
        </div>

@endsection
            {{--<div class="row">--}}
                {{--<div class="col s12 m6 l4">--}}

                {{--</div>--}}
                {{--<div class="col s12 m6 l4">--}}
                    {{----}}
                {{--</div>--}}
                {{--<div class="col s12 m6 l4">--}}
                    {{----}}
                {{--</div>--}}
            {{--</div>--}}
