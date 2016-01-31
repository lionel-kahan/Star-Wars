@extends('layouts.master')

@section('content')
<form method="POST" action="{{url('login')}}">
{!! csrf_field() !!}
    <div class="mw960p flex-container-v">
        <div class="flex-item-center">
            <div class="form-text">
                <label class="label" for="email">{{trans('app.emailAdress')}}</label>
                <input class="input-text" id="email" name="email" type="email" value="{{old('email')}}" >
                @if($errors->has('email'))<span class="error">{{$errors->first('email')}}</span>@endif
            </div>
            <div class="form-text mts">
                <label class="label" for="password">{{trans('app.password')}}</label>
                <input class="input-text" id="password" name="password" type="password" >
                @if($errors->has('password'))<span class="error">{{$errors->first('password')}}</span>@endif
            </div>
            <div class="form-text mts">
                <label class="flex-item-center mrm" for="remember" value="{{old('remember')}}">{{trans('app.remember')}}</label>
                <input class="flex-item-center" type="radio" name="remember" value="true">
            </div>
            <div class="form-submit mtm">
                <input type="submit" value="login">
            </div>
        </div>
        @if(Session::has('message'))
            <h4 class="flex-item-center mtm">{{Session::get('message')}}</h4>
        @endif
    </div>
</form>
@stop