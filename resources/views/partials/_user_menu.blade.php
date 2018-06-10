<!-- user menu -->
<div class="user-menu-container">
    <div class="user-picto" @if(Auth::check()) style="background-color: #000000;" @endif>
        <i class="fas fa-user"></i>
    </div>
    <div class="user-login">
        @guest
        <a href="{{ route('login') }}">Login</a>
        @else
        <a href="{{ route('users.edit', ['id' => Auth::user()->id]) }}">{{ Auth::user()->profile->firstName }}</a>
        @endguest
    </div>
</div>

<!-- user cart -->
@php
    $visibility = 'none';
    $cart = [];
    //session()->forget('cart');
@endphp
@if( session()->has('cart') && count(session()->get('cart')) > 0)
    @php
        $visibility = 'block';
        $cart = session()->get('cart');
    @endphp
@endif
<div class="user-menu-cart" style="display: {{ $visibility }}">
    <div class="user-cart">
        <i class="fas fa-shopping-cart"></i>
        <div class="voyage-counter" style="display: {{ $visibility }}">{{ count($cart) }}</div>
    </div>
    <div class="user-cart-title">
        <a href="#" id="details" data-toggle="modal" data-content="11" data-target="#cartmodalglobal">{{ count($cart) }} - voyage(s)</a>
    </div>
    <div class="close-cart">
        <i class="fas fa-times-circle"></i>
    </div>
</div>
