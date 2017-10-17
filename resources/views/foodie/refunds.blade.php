@extends('foodie.layout')
@section('page_head')
    <link rel="stylesheet" href="/css/foodie/foodieRefund.css">
    <script src="/js/foodie/refunds.js" defer></script>
@endsection
@section('page_content')
    <div class="container">
        <div class="row">
            {{-- forms for refund --}}
            <div class="col s12">
                <div class="refundBox">
                    <div class="refundMainTitle">
                        <span style="font-size: 30px; font-weight: bold;">Refund Methods</span>
                    </div>
                    <div class="refundTabsContainer">
                        <div class="refundTabs">
                            <div class="row">
                                <div data-pay-reveal="bank" class="col s12 m3 refundTab">
                                    <span class="bankIcon"><i class="fa fa-bank"></i></span>
                                    <span class="bankDes">Bank</span>
                                </div>
                                <div data-pay-reveal="transfer" class="col s12 m3 refundTab">
                                    <span class="transferIcon"><i class="fa fa-exchange"></i></span>
                                    <span class="transferDes">Money Transfer</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="refundTabsWrapper">
                        <div id="defaultRefund" class="refundForm" style="height: 100px;">
                            <span>Choose a method of payment!</span>
                        </div>
                        <div id="bankRefundPayment" class="refundForm">
                            <div>
                                <span style="font-size: 30px; font-weight: bold;">Bank Deposit Refund</span>
                            </div>

                            <div class="refundInfoCntr">
                                <div class="refundInfo"><span style="font-size: 30px;">Refund Information</span></div>
                                <div class="divider"></div>
                                <div class="refundInfo">Order Item: {{$planName}}</div>
                                <div class="divider"></div>
                                <div class="refundInfo">Chef: {{$chefName}}</div>
                                <div class="divider"></div>
                                <div class="refundInfo">Amount: {{'PHP ' . number_format(($orderItem->price * $orderItem->quantity), 2, '.', ',')}}</div>
                            </div>
                            <form id="bankRefundForm" action="{{route('foodie.refund',$refund->id)}}" method="post" enctype="multipart/form-data">
                                {{csrf_field()}}
                                <input type="hidden" value="0" name="refundType">
                                <div class="row">
                                    <div><label for="bankType">Bank:</label></div>
                                    <div><select name="bankType" id="bankType">
                                            <option value="0" selected>BDO</option>
                                            <option value="1">BPI</option>
                                            <option value="2">MetroBank</option>
                                            <option value="3">EastWest</option>
                                        </select></div>
                                    {{--<div class="error-recpt err"></div>--}}
                                </div>
                                <div class="row">
                                    <div><label for="acctNmbr">Account Number:</label></div>
                                    <div><input id="acctNmbr" name="acctNmbr" data-error=".error-account-number" type="text"></div>
                                    <div class="error-account-number err"></div>

                                </div>
                                <div class="row">
                                    <div><label for="acctName">Account Name:</label></div>
                                    <div><input id="acctName" name="acctName" data-error=".error-account-name" type="text"></div>
                                    <div class="error-account-name err"></div>

                                </div>
                                {{--<div class="row">--}}
                                    {{--<div class="file-field">--}}
                                        {{--<div id="bankContainer">--}}
                                        {{--</div>--}}
                                        {{--<label for="image" class="active">Picture Upload:</label>--}}
                                        {{--<div style="padding-top: 10px;">--}}
                                            {{--<div class="btn orange darken-2">--}}
                                                {{--<span>File</span>--}}
                                                {{--<input type="file" data-error=".error-image" id="image" name="image">--}}
                                            {{--</div>--}}
                                            {{--<div class="file-path-wrapper">--}}
                                                {{--<input class="file-path validate" type="text" >--}}
                                            {{--</div>--}}
                                            {{--<div class="error-image err"></div>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                <div class="row" style="margin-bottom: 5px;">
                                    <button class="btn waves-light waves-light orange darken-2" type="submit">Submit</button>
                                </div>
                            </form>
                        </div>
                        <div id="transferMoneyPayment" class="refundForm">
                            <div>
                                <span style="font-size: 30px; font-weight: bold;">Money Transfer Refund</span>
                            </div>

                            <div class="refundInfoCntr">
                                <div class="refundInfo"><span style="font-size: 30px;">Refund Information</span></div>
                                <div class="divider"></div>
                                <div class="refundInfo">Order Item: {{$planName}}</div>
                                <div class="divider"></div>
                                <div class="refundInfo">Chef: {{$chefName}}</div>
                                <div class="divider"></div>
                                <div class="refundInfo">Amount: {{'PHP ' . number_format(($orderItem->price * $orderItem->quantity), 2, '.', ',')}}</div>
                            </div>

                            <form id="transferRefundForm" action="{{route('foodie.refund',$refund->id)}}" method="post" enctype="multipart/form-data">
                                {{csrf_field()}}
                                <input type="hidden" value="1" name="refundType">
                                <div class="row">
                                    <div><label for="transferType">Money Transfer Service:</label></div>
                                    <div><select name="transferType" id="transferType">
                                            <option value="0" selected>Cebuana Lhuillier</option>
                                        </select></div>
                                    {{--<div class="error-recpt err"></div>--}}
                                </div>
                                <div class="row">
                                    <div><label for="transferName">Full Name:</label></div>
                                    <div><input id="transferName" name="transferName" data-error=".error-transfer-name" type="text"></div>
                                    <div class="error-transfer-name err"></div>
                                </div>
                                <div class="row" style="margin-bottom: 5px;">
                                    <button class="btn waves-light waves-light orange darken-2" type="submit">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection