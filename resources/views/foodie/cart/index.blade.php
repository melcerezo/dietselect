@extends('foodie.layout')
@section('page_head')
    <script src="/js/foodie/orderValidate.js" defer></script>
    <link rel="stylesheet" href="/css/foodie/order.css">

@endsection
@section('page_content')

    <div class="container shOrdCntr">
        <div class="row">
            <div class="col s12 light-green lighten-1 white-text shOrdMnTtl valign-wrapper">
                <span>Order Payment</span>
            </div>
        </div>
        <div class="row">
            <div class="col s12" style="padding: 0;">
                <div class="card-panel shOrdMlTbl">
                    <table class="centered">
                        <thead class="light-green lighten-1 white-text" style="border: none;">
                            <th>Plan</th>
                            <th>Chef</th>
                            <th>Week</th>
                            <th>Type</th>
                            <th>Quantity</th>
                            <th>Price</th>
                        </thead>
                        <tbody>
                        @foreach($cartItems as $cartItem)
                            <tr>
                                <td>{{$cartItem->name}}</td>
                                <td>{{$cartItem->options->chef}}</td>
                                <td>{{$cartItem->options->date}}</td>
                                <td>
                                    @if($cartItem->options->cust==0)
                                        <span>Standard</span>
                                    @elseif($cartItem->options->cust==1)
                                        <span>Customized</span>
                                    @endif
                                </td>
                                <td>{{$cartItem->qty}}</td>
                                <td>{{$cartItem->price}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col s12 m6">
                <div class="row">
                    <div class="col s12 m4">
                        <a href="" class="modal-trigger">
                            <div class="light-green lighten-1" style="border-radius: 10px;">
                                <div class="white-text valign-wrapper" style="width: 100%; height: 100px;">
                                    <div class="white-text center-block">
                                        <i class="fa fa-shopping-bag" style="font-size: 80px;"></i>
                                    </div>
                                </div>
                                <div class="white-text center">
                                    <span>Place Order</span>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col s12 m6">
                <ul class="collection">
                   <li class="collection-item light-green lighten-1 white-text">
                        <span class="collection-header">Total Order:</span>
                    </li>
                    <li class="collection-item">
                        <span>Total: {{$cartTotal}}</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
@endsection
