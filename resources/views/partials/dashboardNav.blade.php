<nav id="navigation" role="navigation">
    <h1 class="h1-like">Stars War - Dashboard</h1>
    <ul class="pas">
        <li class="{{ Request::is('/') ? 'active' : '' }}"><a href="{{url('/')}}">Site Home</a></li>
        @if (Auth::check())
            <li class="{{ Request::is('admin/product')     ? 'active' : '' }}"><a href="{{url('admin/product')   }}">Product management</a></li>
            <li class="{{ Request::is('admin/category')    ? 'active' : '' }}"><a href="{{url('admin/category')  }}">categories management</a></li>
            <li class="{{ Request::is('admin/tag')         ? 'active' : '' }}"><a href="{{url('admin/tag')       }}">Tags management</a></li>
            <li class="{{ Request::is('admin/commandList') ? 'active' : '' }}"><a href="{{url('admin/commandList')}}">History</a></li>
            <li><a href="{{url('/logout')}}">logout</a></li>
        @endif
    </ul>
</nav>
