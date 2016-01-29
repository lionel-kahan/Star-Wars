@extends('layouts.master')

@section('content')
    <p>{{$title}}</p>
    <div class="txtcenter wauto">
        <div class="clear product grid-2 mw960p">
            @if($pict=$product->picture)
                <div class="clearfix"><img class="product_image_large" src="{{url('upload', $pict->uri)}}"></div>
            @endif
            <div>
                <h2><a href="{{url('prod', [$product->id, $product->slug])}}">{{$product->name}}</a></h2>
                <h5>{{$product->abstract}}</h5>
                <p>{{$product->content}}</p>
                <p>
                    {{trans('app.tag')}} :
                    @forelse($product->tags as $tag)
                        <a href="{{url('tag', [$tag->id, $tag->slug])}}">{{$tag->name}}</a>
                    @empty
                        {{trans('app.notag')}}
                    @endforelse
                </p>
                <h5>Catégories: <a href="{{url('cat', [$product->category->id, $product->category->slug])}}">{{$product->category->title}}</a></h5>
                <h5>Price : {{$product->price}}€</h5>
                <form method="POST" action="{{url('addCart')}}">
                    {!! csrf_field() !!}
                    <div class="form-text">
                        <label class="label" for="quantity">Quantity</label>
                        <input class="input-text" type="text" id="quantity" name="quantity" value="{{$quantity}}" maxlength="4" size="1" pattern="[0-9]*">
                        <div class="form-submit">
                            <input type="submit" value="Add to the cart"">
                            @if($errors->has('quantity'))<span class="error">{{$errors->first('quantity')}}</span>@endif
                            <input type="hidden" value="{{$product->id}}" name="product_id">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
