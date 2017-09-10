@extends('foodie.layout')
@section('page_head')
    <script src="/js/foodie/orderValidate.js" defer></script>
    <script src="/js/foodie/cartOrder.js" defer></script>
    <link rel="stylesheet" href="/css/foodie/cart.css">
    <link rel="stylesheet" href="/css/foodie/order.css">

@endsection
@section('page_content')

    <div class="container shOrdCntr">
        <div class="row">
            <div class="col s12 light-green lighten-1 white-text shOrdMnTtl valign-wrapper">
                <span>Order Payment</span>
            </div>
        </div>
        @if(Cart::count()>0)
        <div class="row">
            <div class="col s12" style="padding: 0;">
                <div class="shOrdMlTbl">
                    <table class="responsive-table" style="table-layout: fixed; width: 100%;">
                        <thead>
                            <tr>
                                <th style="width:45%;">Plan</th>
                                <th style="width:20%">Quantity</th>
                                <th style="width:25%">Price</th>
                                <th style="width:10%">Remove</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cartItems as $cartItem)
                                <tr>
                                    <td>
                                        <div class="row">
                                            <div class="col s12 m4">
                                                <img class="responsive-img" src="/img/{{$cartItem->pic}}" alt="">
                                            </div>
                                            <div class="col s12 m8">
                                                <div style="font-size: 30px;">
                                                    {{$cartItem->name}}
                                                </div>
                                                <div style="font-size: 18px; margin-bottom: 50px;">
                                                    @foreach($chefs as $chef)
                                                        @if($chef->id == $cartItem->options->chef)
                                                            {{$chef->name}}
                                                        @endif
                                                    @endforeach
                                                </div>
                                                <div>
                                                    @if($cartItem->options->cust==0)
                                                        <span>Standard</span>
                                                    @elseif($cartItem->options->cust==1 || $cartItem->options->cust==2)
                                                        <span>Customized</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <form method="post" action="{{route('cart.update', $cartItem->rowId)}}">
                                                {{ csrf_field() }}
                                                        <span><input type="number" name="qty" value="{{$cartItem->qty}}" style="width: 30%;"></span>

                                                        <span><button type="submit">Update</button></span>
                                            </form>
                                        </div>
                                        {{--<a href="{{route('cart.update', $cartItem->rowId)}}" class="btn btn-primary waves-light waves-effect">ADD</a>--}}

                                    </td>
                                    <td>{{'PHP '.number_format($cartItem->price,2,'.',',')}}</td>
                                    <td><a id="removeButton" href="{{route('cart.remove',$cartItem->rowId)}}"><i class="material-icons">delete</i></a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col s12 m6 offset-m6">
                <div class="row">
                    <div class="col s12 m4 offset-m6">
                        <ul class="collection" style="margin: 0;">
                           <li class="collection-item light-green lighten-1 white-text">
                                <span class="collection-header">Total Order:</span>
                            </li>
                            <li class="collection-item">
                                <span>Quantity: {{$cartCount}}</span>
                            </li>
                            <li class="collection-item">
                                <span>Week: {{$cartItem->options->date}}</span>
                            </li>
                            <li class="collection-item">
                                <span>Total: {{'PHP'.$cartTotal}}</span>
                            </li>
                        </ul>
                    </div>
                    <div class="col s12 m2">
                        <a id="orderButton" href="{{route('foodie.order')}}">
                            <div class="light-green lighten-1" style="border-radius: 10px;">
                                <div class="white-text valign-wrapper" style="width: 100%; height: auto;">
                                    <div class="white-text center-block">
                                        <i class="fa fa-shopping-bag" style="font-size: 30px;"></i>
                                    </div>
                                </div>
                                <div class="white-text center">
                                    <span>Order</span>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @else
            <div>
                <div>
                    <span>Nothing in Cart!</span>
                </div>
                <div>
                    <a href="{{route('foodie.plan.show')}}">Check out our plans to order!</a>
                </div>
            </div>
        @endif
    </div>
    <div id="loadWait" class="valign-wrapper">
        <div id="loadStatus" class="preloader-wrapper active valign">
            <div class="spinner-layer spinner-red-only">
                <div class="circle-clipper left">
                    <div class="circle"></div>
                </div><div class="gap-patch">
                    <div class="circle"></div>
                </div><div class="circle-clipper right">
                    <div class="circle"></div>
                </div>
            </div>
        </div>
    </div>
@endsection
