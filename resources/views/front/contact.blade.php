@extends('layouts.master')

@section('content')
    @if(Session::has('message'))
        @include('front.partials.flash')
    @else
        <form class="txtcenter" method="POST" action="{{url('storeContact')}}">
            {{--Token de cession--}}
            {!! csrf_field() !!}
            <div class="form-text">
                <label class="label" for="email">{{trans('app.emailAdress')}}</label>
                <input class="input-text" id="email" name="email" type="text" value="{{old('email')}}" >
                <p>@if($errors->has('email'))<span class=""error">{{$errors->first('email')}}</span>@endif</p>
            </div>

            <div class="content">
                <textarea row="50" cols="50" name="content">{{old('content')}}</textarea>
            </div>

            <input type="submit" value="Ok">
            <input type="reset" value="reinitialize">

        </form>
    @endif
@stop
