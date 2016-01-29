@extends('layouts.admin')
@section('content')
    <div class="txtcenter"><a href="{{url('admin/product', 'create')}}"><button>Add product</button></a></div>
        <div class="h6-like txtcenter">{!!$products->links()!!}</div>
    <table class="table">
        <thead>
        <tr>
            <th class="txtcenter">Product</th>
            <th class="txtcenter">Status</th>
            <th class="txtcenter">Name</th>
            <th class="txtcenter">Price</th>
            <th class="txtcenter">Quantity in stock</th>
            <th class="txtcenter">Quantity in command</th>
            <th class="txtcenter">Category</th>
            <th class="txtcenter">Tags</th>
            <th class="txtcenter">Published date</th>
            <th class="txtcenter">Action</th>
        </tr>
        </thead>
    @forelse($products->reverse() as $product)
            <tr>
                <td class="txtcenter">@if ($product->Picture)<img class="product_small_image" src="{{url('upload', $product->picture->uri)}}" alt="{{$product->slug}}">@endif</td>
                <td class="txtcenter"><a class="btn btn-{{$product->status}}" href="{{url('admin/product', ['status', $product->id])}}"><button>{{$product->status}}</button></a></td>
                <td><a href="{{url('admin/product', [$product->id, 'edit'])}}">{{$product->name}}</a></td>
                <td>{{$product->price}}</td>
                <td>{{$product->quantity}}</td>
                <td>{{$product->quantityInCommand}}</td>
                <td class="txtcenter">{{!empty($cat = $product->category)? $cat->title : 'No category'}}</td>
                <td class="txtcenter">@if($tags = $product->tags)@foreach($tags as $tag ) {{$tag->name}}<br> @endforeach @endif</td>
                <td class="txtcenter">{{$product->published_at}}</td>
                <td class="txtcenter">
                    <form class="inbl" method="POST" action="{{url('admin/product', $product->id)}}">
                        {!! csrf_field() !!}
                        <input type="hidden" name="_method" value="delete">
                        <input type="submit" value="delete">
                    </form>
                    <form class="inbl" method="GET" action="{{url('admin/product', [$product->id, 'edit'])}}">
                        {!! csrf_field() !!}
                        <input type="submit" value="edit">
                    </form>
                </td>
            </tr>
        @empty
        @endforelse
    </table>
    <div class="h6-like txtcenter">{!!$products->links()!!}</div>
@stop
