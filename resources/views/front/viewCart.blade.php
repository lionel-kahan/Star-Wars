@extends('layouts.master')

@section('content')

    <h1 class="txtcenter">{{$title}}</h1>
    <table class="table" id="tabCart">
        <thead>
        <tr>
            <th class="txtcenter">Product</th>
            <th class="txtcenter">Name</th>
            <th class="txtcenter">Price</th>
            <th class="txtcenter">Quantity</th>
            <th class="txtcenter">Action</th>
        </tr>
        </thead>
        @forelse($carts as $cart)
            <tr id="ligne_produit_{{$cart['productId']}}">
                <td class="txtcenter"><img class="product_small_image" src="{{url('upload', $cart['uri'])}}" alt="{{$cart['slug']}}"></td>
                <td><a href="{{url('prod', [$cart['productId'], $cart['slug']])}}">{{$cart['name']}}</a></td>
                <td class="txtcenter">{{$cart['price']}}</td>
                <td id ="qte_{{$cart['productId']}}" class="txtcenter">{{$cart['quantity']}}</td>
                <td class="txtcenter">
                    {{--<form class="inbl" method="GET" action="{{url('removeCart', $cart['productId'])}}">--}}
                        {{--<input type="hidden" name="_method" value="delete">--}}
                        {{--<input type="submit" value="delete">--}}
                    {{--</form>--}}
                    <span><button class="btnSuppr" productId="{{$cart['productId']}}">Delete</button></span>
                    <span><button class="btnPlus" productId="{{$cart['productId']}}"> + </button></span>
                    <span><button class="btnMoins" productId="{{$cart['productId']}}"> - </button></span>
                    {{--<span><a href="{{url('incrementProductInCart', $cart['productId'])}}"><button class="btnPlus"  id="btnPlus_{{$cart['productId']}}"> + </button></a></span>--}}
                    {{--<span><a href="{{url('decrementProductInCart', $cart['productId'])}}"><button class="btnMoins" id="btnMoins_{{$cart['productId']}}"> - </button></a></span>--}}
                </td>
            </tr>
        @empty
            <p>Your cart is empty</p>
        @endforelse
        <tr style="font-weight: bold;">
            <td colspan="2" style="text-align: right;">Total</td>
            <td id="totalPrice" colspan="1" style="text-align: center;">{{number_format($totalPrice, 2)}}</td>
            <td colspan="2" style="text-align: center;"></td>
        </tr>
    </table>
    <form  method="GET" id="formCommand" class="txtcenter" action="{{url('confirmCart')}}">
        <div class="form-submit txtcenter">
            <input type="submit" value="Command">
        </div>
    </form>
    {{--todo bouton abort--}}
@stop
