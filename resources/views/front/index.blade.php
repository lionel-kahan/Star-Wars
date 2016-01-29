@extends('layouts.master')

@section('content')
    <div class="txtcenter">
        <h6>{!! $products->links() !!}</h6>
    </div>
    @include('front.partials.index', ['products' => $products])
    <div class="txtcenter">
        <h6>{!! $products->links() !!}</h6>
    </div>
@stop
