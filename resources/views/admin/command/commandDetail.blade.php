@extends('layouts.admin')

@section('content')

    <h1 class="txtcenter">{{$title}}</h1>
    <table class="table" id="tabCart">
        <thead>
        <tr>
            <th class="txtcenter">Product</th>
            <th class="txtcenter">Name</th>
            <th class="txtcenter">Price</th>
            <th class="txtcenter">Quantity</th>
        </tr>
        </thead>
        @foreach($commandDetails as $commandDetail)
            <tr>
                <td class="txtcenter"><img class="product_small_image" src="{{url('upload', $commandDetail->product->picture->uri)}}" alt="{{$commandDetail->product->slug}}"></td>
                <td><a href="{{url('prod', [$commandDetail->product->id, $commandDetail->product->slug])}}">{{$commandDetail->product->name}}</a></td>
                <td class="txtcenter">{{$commandDetail->price}}</td>
                <td class="txtcenter">{{$commandDetail->quantity}}</td>
            </tr>
        @endforeach
        <tr style="font-weight: bold;">
            <td colspan="2" style="text-align: right;">Total</td>
            <td id="totalPrice" colspan="1" style="text-align: center;">{{number_format($price, 2)}}</td>
            <td colspan="1" style="text-align: center;"></td>
        </tr>
    </table>
@stop
