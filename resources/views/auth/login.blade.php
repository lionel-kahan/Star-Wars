@extends('layouts.master')

@section('content')
<form method="POST" action="{{url('login')}}">
{!! csrf_field() !!}
    <div class="form-text">
        <label class="label" for="email">{{trans('app.emailAdress')}}</label>
        <input class="input-text" id="email" name="email" type="email" value="{{old('email')}}" >
        @if($errors->has('email'))<span class=""error">{{$errors->first('email')}}</span>@endif
    </div>
    <div class="form-text">
        <label class="label" for="password">{{trans('app.password')}}</label>
        <input class="input-text" id="password" name="password" type="password" >
        @if($errors->has('password'))<span class=""error">{{$errors->first('password')}}</span>@endif
    </div>
    <div class="form-text">
        <label class="label" for="remember" value="{{old('remember')}}">{{trans('app.remember')}}</label>
        <input type="radio" name="remember" value="true">
    </div>
    <div class="form-submit">
        <input type="submit" value="login">
    </div>

</form>
@stop