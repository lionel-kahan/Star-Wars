@extends('layouts.master')

@section('content')
    <div class="txtcenter">
        <h6>{!! $products->links() !!}</h6>
    </div>
    @foreach($products as $product)
        <div class="txtcenter wauto pas">
            <div class="clear product grid-1-2 mw960p">
                @if($pict=$product->picture)
                    <div class="clearfix">
                        <img class="product_medium_image" src="{{url('upload', $pict->uri)}}">
                        {{--<img src="upload/{{$product->picture->uri}}" >--}}
                    </div>
                @endif
                    <div class="tag">
                        <h2><a href="{{url('prod', [$product->id, $product->slug])}}">{{$product->name}}</a></h2>
                        {{$product->abstract}}
                        <p>Published at : {{$product->published_at}}</p>
                        <p>
                            {{trans('app.tag')}} :
                            @forelse($product->tags as $tag)
                                <a href="{{url('tag', [$tag->id, $tag->slug])}}">{{$tag->name}}</a>
                            @empty
                                {{trans('app.notag')}}
                            @endforelse
                        </p>
                        <h5>Catégories: <a href="{{url('cat', [$product->category->id, $product->category->slug])}}">{{$product->category->title}}</a></h5>
                </div>
            </div>
        </div>
    @endforeach
    <div class="txtcenter">
        <h6>{!! $products->links() !!}</h6>
    </div>
@stop
