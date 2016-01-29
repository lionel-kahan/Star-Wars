@extends('layouts.admin')

@section('content')

    @if(Session::has('message'))
        <div>
            <div class="inbl alert">
                <h1 class="txtcenter" {{Session::get('alert')}}">{{Session::get('message')}}</h1>
                <a class="txtcenter" href="{{url('admin/product')}}"><button>ok</button></a>
            </div>
        </div>
    @else
        <h1 class="txtcenter">{{$title}}</h1>
        <form method="POST" action="{{url('admin/product')}}" enctype="multipart/form-data">
            {!! csrf_field() !!}
            <div class="grid-2" >
                <div class="form-text">
                    <label class="label" for="name">Name</label>
                    <input class="input-text" id="name" name="name" type="text" value="{{old('name')}}" >
                    @if($errors->has('name'))<span class=""error">{{$errors->first('name')}}</span>@endif
                </div>
                 <div class="form-select">
                     <label class="label" for="category">Category</label>
                     <select name="category_id" id="category">
                     @foreach($categories as $key => $value)
                        <option value="{{$key}}">{{$value}}</option>
                     @endforeach
                     </select>
                  </div>

                <div class="form-text">
                    <label class="label" for="slug">Slug</label>
                    <input class="input-text" id="slug" name="slug" type="text" value="{{old('slug')}}" >
                    @if($errors->has('slug'))<span class=""error">{{$errors->first('slug')}}</span>@endif
                </div>
                <div class="form-text">
                    <label class="label" for="abstract">Abstract</label>
                    <input class="input-text" id="abstract" name="abstract" type="text" value="{{old('abstract')}}" >
                    @if($errors->has('abstract'))<span class=""error">{{$errors->first('abstract')}}</span>@endif
                </div>
                <div class="form-text">
                    <label class="label" for="price">Price in €</label>
                    <input class="input-text" id="price" name="price" type="text" value="{{old('price')}}" >
                    @if($errors->has('price'))<span class=""error">{{$errors->first('price')}}</span>@endif
                </div>
                <div class="content">
                    <label class="label" for="content">Content</label>
                    <textarea row="10" cols="100" name="content">{{old('content')}}</textarea>
                    @if($errors->has('content'))<span class=""error">{{$errors->first('content')}}</span>@endif
                </div>
                <div class="form-select">
                    <label class="label" for="tags">Tags</label>
                    <select name="tags[]" id="tags" multiple size="7">
                        @foreach($tags as $key => $value)
                            <option value="{{$key}}">{{$value}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-text">
                    <label class="label" for="quantity">Quantity</label>
                    <input class="input-text" id="quantity" name="quantity" type="text" value="{{old('quantity')}}" >
                    @if($errors->has('quantity'))<span class=""error">{{$errors->first('quantity')}}</span>@endif
                </div>

                <div class="form-text">
                    <label class="label" for="published_at">Published Date</label>
                    <input class="input-text" id="published_at" name="published_at" type="date">
                    @if($errors->has('published_at'))<span class=""error">{{$errors->first('published_at')}}</span>@endif
                </div>
                <div class="form-text">
                    <p class="label">Status</p>
                    <input type="radio" id="opened" value="opened" name="status" checked> <label for="opened">Opened</label>
                    <input type="radio" id="closed" value="closed" name="status">         <label for="closed">Closed</label>
                </div>
                <div class="input-file">
                    <h2>Importer une image</h2>
                    <input class="file" type="file" name="thumbnail">
                    @if($errors->has('thumbnail'))<span class=""error">{{$errors->first('thumbnail')}}</span>@endif
                </div>
            </div>
            <div class="form-submit txtcenter">
                <input class="txtcenter" type="submit" value="create">
            </div>
        </form>
    @endif
@stop

