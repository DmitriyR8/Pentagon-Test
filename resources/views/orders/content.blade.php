@extends('main-page')


@section('content')
    @include('header')

    <div class="container">
        <h1 style="text-align: center; padding-bottom: 50px">Orders</h1>
        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Order ID</th>
                <th>Total</th>
                <th>Shipping Total</th>
                <th>Timezone</th>
            </tr>
            </thead>
            <tbody>
            @foreach($orders as $order)
                <tr>
                    <td>{{$order->id}}</td>
                    <td>{{$order->order_id}}</td>
                    <td>{{$order->total}}</td>
                    <td>{{$order->shipping_total}}</td>
                    <td>{{$order->timezone}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
