@extends('foodie.layout')
@section('page_head')
@endsection

@section('page_content')

    <div>
        <table>
            <tr>
                <th>ID</th>
                <th>Plan Name</th>
                <th>Chef Name</th>
                <th>Amount</th>
                <th>Type</th>
            </tr>
            <tr>
                <td class="orderID"></td>
                <td class="planName"></td>
                <td class="chefName"></td>
                <td class="amount"></td>
                <td class="type"></td>
            </tr>
        </table>
    </div>

@endsection