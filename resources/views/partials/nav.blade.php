{{--{{dd(Request())}}--}}
<nav id="navigation" role="navigation">
    <h1 class="h1-like">Stars War</h1>
    <ul class="pas">
        <li class="{{ Request::is('/') ? 'active' : '' }}"><a href="{{url('/')}}">Accueil</a></li>
        @forelse($categories as $category)
            <li class="{{ Request::is('cat/' .  $category->id . '/' . $category->slug) ? 'active' : '' }}"><a href="{{url('cat', [$category->id, $category->slug])}}">{{$category->title}}</a></li>
        @empty
            <li>{{trans('app.noCategory')}}</li>
        @endforelse
        <li class="{{ Request::is('contact') ? 'active' : '' }}"><a href="{{url('contact')}}">Contact</a></li>

        @if (Auth::check())
            @if(Auth::user()->role == 'administrator')
                <li class="{{ Request::is('admin') ? 'active' : '' }}"><a href="{{url('admin')}}">Admin</a></li>
            @endif
            <li class="{{ Request::is('logout') ? 'active' : '' }}"><a href="{{url('logout')}}">Logout</a></li>

        @else
            <li class="{{ Request::is('login') ? 'active' : '' }}"><a href="{{url('login')}}">Login</a></li>
        @endif
        @if (Session::has('cart'))
            <li class="{{ Request::is('viewCart') ? 'active' : '' }}"><a id="cart" href="{{url('viewCart')}}"><i class="fa fa-shopping-cart"></i><span id="nbProdInCart">{{count(Session::get('cart'))}}</span></a></li>
        @endif
    </ul>
</nav>
