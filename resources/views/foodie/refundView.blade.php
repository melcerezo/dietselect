@extends('foodie.layout')
@section('page_head')
    <link rel="stylesheet" href="/css/foodie/foodieRefundView.css">
    <script src="/js/foodie/refundView.js" defer></script>
@endsection
@section('page_content')
    <div class="container">
        <div class="row">
            <div class="refundPic col s12 m6">
                    @if($refund->refund_pic=='')
                        <span>Payment Pending</span>
                    @else
                        <div style="border :1px solid #d1d1d1; height: 300px; width: 300px;">
                            <img src="/img/refunds/{{ $refund->refund_pic }}" alt="">
                        </div>
                    @endif
            </div>
            <div class="refundInfo col s12 m6">
                <div class="row">
                    <span style="font-size: 20px; font-weight: bold;">Refund Information</span>
                </div>
                <div class="divider"></div>
                <div class="row">
                    <div>Item to be Refunded</div>
                    <div class="divider"></div>
                    <div>
                        <div>
                            <span>Plan Name:</span>
                        </div>
                        <div>
                            <span>{{$planName}}</span>
                        </div>
                    </div>
                    <div class="divider"></div>
                    <div>
                        <div>
                            <span>Chef Name:</span>
                        </div>
                        <div>
                            <span>{{$chefName}}</span>
                        </div>
                    </div>
                    <div class="divider"></div>
                    <div>
                        <div>
                            <span>Type:</span>
                        </div>
                        <div>
                            <span>{{$orderType}}</span>
                        </div>
                    </div>
                    <div class="divider"></div>
                    <div>
                        <div>
                            <span>Quantity:</span>
                        </div>
                        <div>
                            <span>{{$orderItem->quantity}}</span>
                        </div>
                    </div>

                </div>
                <div class="divider"></div>
                <div class="row">
                    <span style="font-size: 20px; font-weight: bold;">STATUS</span>
                    <span class="right">{{$refund->is_paid == 1 ? 'Paid' : 'Pending'}}</span>
                </div>
                <div class="divider"></div>
                <div class="row">
                    <span style="font-size: 20px; font-weight: bold;">DATE</span>
                    <span class="right">{{$refund->created_at->format('F d, Y h:i A')}}</span>
                </div>
                <div class="row">
                    <div>
                        <span style="font-size: 20px; font-weight: bold;">REFUND METHOD</span>
                        <span class="right">{{$refund->method == 1 ? 'Money Transfer' : 'Bank Deposit'}}</span>
                    </div>
                    <div>
                        @if($refund->method==0)
                            <div>
                                <span style="font-size: 20px; font-weight: bold;">BANK ACCOUNT</span>
                                <span class="right">{{$refund->bank_account}}</span>
                            </div>
                        @elseif($refund->method==1)
                            <div>
                                <span style="font-size: 20px; font-weight: bold;">MONEY TRANSFER COMPANY</span>
                                @if($refund->transfer_company==0)
                                    <span class="right">Cebuana Lhuillier</span>
                                @endif
                            </div>
                        @endif
                            <div>
                                @if($refund->method==0)
                                    <span style="font-size: 20px; font-weight: bold;">ACCOUNT NAME</span>
                                @elseif($refund->method==1)
                                    <span style="font-size: 20px; font-weight: bold;">FULL NAME</span>
                                @endif
                                <span class="right">{{$refund->name}}</span>
                            </div>
                    </div>
                </div>
                <div class="divider"></div>
                <div class="row">
                    <span style="font-size: 30px; font-weight: bold;">AMOUNT</span>
                    <span class="right" style="color: #f57c00; font-size: 30px;">{{'PHP ' . number_format(($orderItem->price * $orderItem->quantity), 2, '.', ',')}}</span>
                </div>
            </div>
        </div>
    </div>
@endsection