@extends('layouts.master')

@section('content')
    <div class="txtcenter">
        <h6>{!! $products->links() !!}</h6>
    </div>
    @forelse($products as $product)
        <div class="txtcenter wauto pas">
            <div class="clear @if($pict=$product->picture)grid-1-2 flex-container @endif mw960p mauto">
                <div class="clearfix flex-item-center"">
                    @if($pict=$product->picture)
                        <img class="product_medium_image" src="{{url('upload', $pict->uri)}}">
                        {{--<img src="upload/{{$product->picture->uri}}" >--}}
                    @endif
                </div>
                <div class="flex-item-center"">
                    <h2><a href="{{url('prod', [$product->id, $product->slug])}}">{{$product->name}}</a></h2>
                    {{$product->abstract}}
                    <p>
                        Associated products in themes :
                        @foreach($product->tags as $tag)
                            <a href="{{url('tag', [$tag->id, $tag->slug])}}">{{$tag->name}}</a>
                        @endforeach
                    </p>
                    <h5>Catégories: <a href="{{url('cat', [$product->category->id, $product->category->slug])}}">{{$product->category->title}}</a></h5>
                    <h5>Price : {{$product->price}}€</h5>
                </div>
            </div>
        </div>
    @empty
        <p>No Product in this tag</p>
    @endforelse
    <div class="txtcenter">
        <h6>{!! $products->links() !!}</h6>
    </div>
@stop
