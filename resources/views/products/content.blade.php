@extends('main-page')


@section('content')
    @include('header')

    <div class="container">
        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>SKU</th>
                <th>Title</th>
            </tr>
            </thead>
            <tbody>
            @foreach($products as $product)
                <tr>
                    <td>{{$product->id}}</td>
                    <td>{{$product->SKU}}</td>
                    <td>{{$product->title}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
