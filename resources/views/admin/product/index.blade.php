@extends('layouts.admin')
@section('content')
    <div class="txtcenter"><a href="{{url('admin/product', 'create')}}"><button>Add product</button></a></div>
    <div class="h6-like txtcenter">{!!$products->links()!!}</div>
    <table class="table">
        <thead>
            <tr>
                <th class="txtcenter">Id</th>
                <th class="txtcenter">Product</th>
                <th class="txtcenter">Status</th>
                <th class="txtcenter">Name</th>
                <th class="txtcenter">Price</th>
                <th class="txtcenter">Quantity in stock</th>
                <th class="txtcenter">Quantity currently commanded</th>
                <th class="txtcenter">Category</th>
                <th class="txtcenter">Tags</th>
                <th class="txtcenter">Published date</th>
                <th class="txtcenter">Action</th>
            </tr>
        </thead>
            @forelse($products as $product)
                <tr>
                    <td class="txtcenter">{{$product->id}}</td>
                    <td class="txtcenter">@if ($picture=$product->Picture)<a href="{{url('admin/product', [$product->id, 'edit'])}}"><img class="product_small_image" src="{{url('upload', $picture->uri)}}" alt="{{$product->slug}}"></a>@endif</td>
                    <td class="txtcenter"><a class="btn btn-{{$product->status}}" href="{{url('admin/product', ['status', $product->id])}}"><button>{{$product->status}}</button></a></td>
                    <td class="txtcenter">{{$product->name}}</td>
                    <td class="txtcenter">{{$product->price}}</td>
                    <td class="txtcenter">{{$product->quantity}}</td>
                    <td class="txtcenter">{{$product->nbProductCurrentlyCommended()}}</td>
                    <td class="txtcenter">{{!empty($cat = $product->category)? $cat->title : 'No category'}}</td>
                    <td class="txtcenter">@if($tags = $product->tags)@foreach($tags as $tag ) {{$tag->name}}<br> @endforeach @endif</td>
                    <td class="txtcenter">{{$product->published_at}}</td>
                    <td class="txtcenter">
                        <form class="inbl" method="GET" action="{{url('admin/product', [$product->id, 'edit'])}}">
                            {!! csrf_field() !!}
                            <input type="submit" value="edit">
                        </form>
                        @if(Auth::user()->role == 'administrator')
                            <button data-rel="popup-remove-product" class="poplight" data-width="600" data-productid="{{$product->id}}" data-productname="{{$product->name}}">Delete</button>
                        @endif
                    </td>
                </tr>
            @empty
            @endforelse
        </table>
    <div class="h6-like txtcenter">{!!$products->links()!!}</div>
    <div id="popup-remove-product" class="popup_block">
        <h2>Do you realy want to delete this product ?</h2>
        <form class="inbl flex-container" method="POST" action="#">
            {!! csrf_field() !!}
            <div class="flex-item-center">
                <input type="hidden" name="_method" value="delete">
                <input type="submit" value="Yes">
                <button class="close" value="No">No</button>
            </div>
        </form>
    </div>
@stop
