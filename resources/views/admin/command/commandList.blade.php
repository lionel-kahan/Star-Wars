@extends('layouts.admin')
@section('content')
    {{--<div class="txtcenter"><a href="{{url('product', 'create')}}"><button>Add product</button></a></div>--}}
    <div class="h6-like txtcenter">{!!$commands->links()!!}</div>
    <table class="table">
        <thead>
        <tr>
            <th class="txtcenter">Id command</th>
            <th class="txtcenter">Customer</th>
            <th class="txtcenter">Price</th>
            <th class="txtcenter">Nb Product</th>
            <th class="txtcenter">Date command</th>
            <th class="txtcenter">Status</th>
        </tr>
        </thead>
    @forelse($commands as $command)
            <tr>
                <td class="txtcenter"><a href="{{url('admin/commandDetail', $command->id)}}">{{$command->id}}</a></td>
                <td class="txtcenter">{{$command->customer->user->name}}</td>
                <td class="txtcenter">{{$command->price}}</td>
                <td class="txtcenter">{{$command->nb_product}}</td>
                <td class="txtcenter">{{$command->commanded_at}}</td>
                <td class="txtcenter">{{$command->status}}</td>
            </tr>
        @empty
        @endforelse
    </table>
    <div class="h6-like txtcenter">{!!$commands->links()!!}</div>
@stop
