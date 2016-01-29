@extends('layouts.master')

@section('content')
    <h1 class="txtcenter">{{$title}}</h1>
    <table class="table">
        <thead>
        <tr>
            <th class="txtcenter">Product</th>
            <th class="txtcenter">Name</th>
            <th class="txtcenter">Price</th>
            <th class="txtcenter">Quantity</th>
        </tr>
        </thead>
        @forelse($carts as $cart)
            <tr>
                <td class="txtcenter"><img class="product_small_image" src="{{url('upload', $cart['uri'])}}" alt="{{$cart['slug']}}"></td>
                <td>{{$cart['name']}}</td>
                <td class="txtcenter">{{$cart['price']}}</td>
                <td class="txtcenter">{{$cart['quantity']}}</td>
            </tr>
        @empty
            <p>Your cart is empty</p>
        @endforelse
        <tr style="font-weight: bold;">
            <td colspan="2" style="text-align: right;">Total</td>
            <td style="text-align: center;">{{number_format($totalPrice, 2)}}</td>
            <td></td>
        </tr>
    </table>
    <form method="GET" action="{{url('finalizeCart')}}">
        <div class="form-submit txtcenter">
            <input type="submit" value="Finalize">
        </div>
    </form>
@stop
