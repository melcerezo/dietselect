@extends('layouts.app')
@section('content')

    <nav>
        <div class="nav-wrapper green lighten-1">
            <a href="#" class="brand-logo">Diet Select</a>
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
                        bottom:125px;
                        ">
                        <span class="card-title">Melchor Cerezo</span>
                        <p>Birthday: 10-03-89</p>
                        <p>Email: melcerezo@gmail.com</p>
                        <p>Phone Number:09273656642</p>
                        {{--<p>I am a very simple card. I am good at containing small bits of information. I am convenient because I require little markup to use effectively.</p>--}}
                    </div>
                </div>
            </div>
            <div class="col s12 m6 l6">
                <div>
                    <ul class="collection">
                        <li class="collection-item green lighten-1 white-text">
                            <div class="collection-header">Pending Order</div>
                        </li>
                        <li class="collection-item">
                            <p>Chef Plan 1</p>
                            <p>Total Calories: 1200</p>
                            <p>Price: Php 5000</p>
                        </li>
                    </ul>
                </div>
                <div class="col s12 m6 l6" style="padding: 0;">
                    <ul class="collection">
                        <li class="collection-item green lighten-1 white-text">
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
            <div class="row">
                <div class="col s12 m6 l4">
                    <div class="card">
                        <div class="green lighten-1 white-text" style="line-height: 1.5rem;
                                padding: 10px 20px;
                                margin: 0;">
                            <span>
                                Plan for Week of: April 1-7
                            </span>
                        </div>
                        <table>
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
                                <td>Meal 1<i class="material-icons">done</i></td>
                                <td>Meal 2<i class="material-icons">done</i></td>
                                <td>Meal 3<i class="material-icons">done</i></td>
                                <td>Meal 4</td>
                                <td>Meal 5</td>
                            </tr>
                            <tr>
                                <th>Tu</th>
                                <td>Meal 6</td>
                                <td>Meal 7</td>
                                <td>Meal 8</td>
                                <td>Meal 9</td>
                                <td>Meal 10</td>
                            </tr>
                            <tr>
                                <th>We</th>
                                <td>Meal 11</td>
                                <td>Meal 12</td>
                                <td>Meal 13</td>
                                <td>Meal 14</td>
                                <td>Meal 15</td>
                            </tr>
                            <tr>
                                <th>Th</th>
                                <td>Meal 16</td>
                                <td>Meal 17</td>
                                <td>Meal 18</td>
                                <td>Meal 19</td>
                                <td>Meal 20</td>
                            </tr>
                            <tr>
                                <th>Fr</th>
                                <td>Meal 21</td>
                                <td>Meal 22</td>
                                <td>Meal 23</td>
                                <td>Meal 24</td>
                                <td>Meal 25</td>
                            </tr>
                            <tr>
                                <th>Sa</th>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="col s12 m6 l4">
                    <ul class="collection">
                        <li class="collection-item green lighten-1 white-text">
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
                </div>
                <div class="col s12 m6 l4">
                    <ul class="collection">
                        <li class="collection-item green lighten-1 white-text">
                            <span class="collection-header">Suggested Meal Plans</span>
                        </li>
                        <li class="collection-item">
                            Chef Plan 3
                        </li>

                    </ul>
                </div>
            </div>
        </div>

@endsection