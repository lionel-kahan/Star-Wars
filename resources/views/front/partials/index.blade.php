@extends('layouts.master')

@section('content')
    <div class="txtcenter">
        <h6>{!! $products->links() !!}</h6>
    </div>
    @foreach($products as $product)
        <div class="txtcenter wauto pas">
            <div class="@if($pict=$product->picture)grid-1-2 flex-container @endif clear mw960p mauto">
                <div class="clearfix flex-item-center">
                    @if($pict)
                        <img class="product_medium_image" src="{{url('upload', $pict->uri)}}">
                    @endif
                </div>
                    <div class="flex-item-center">
                        <h2><a href="{{url('prod', [$product->id, $product->slug])}}">{{$product->name}}</a></h2>
                        {{$product->abstract}}
                        <span class="visually-hidden">{{$category = $product->category}}</span>
                        <h6>Catégories <a href="{{url('cat', [$category->id, $category->slug])}}">{{$category->title}}</a></h6>
                        <span class="visually-hidden">{{$tags = $product->tags}}</span>
                        @if(isset($tags[0]))
                            <p> Associated products in themes :
                                @forelse($tags as $tag)
                                    <a href="{{url('tag', [$tag->id, $tag->slug])}}">{{$tag->name}}</a>
                                 @empty
                                    {{trans('app.notag')}}
                                @endforelse
                            </p>
                        @endif
                        <h5>Price : {{$product->price}}€</h5>
                    </div>
            </div>
        </div>
    @endforeach
    <div class="txtcenter">
        <h6>{!! $products->links() !!}</h6>
    </div>
@stop
