@extends('layouts.master')

@section('content')
    <div class="txtcenter">
        <div class="inbl alert">
            <h1 class="txtcenter" {{$typeMessage}}">{{$message}}</h1>
            <a class="txtcenter" href="{{url($uri)}}"><button>ok</button></a>
        </div>
    </div>
@stop