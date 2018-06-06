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
<div class="user-menu-cart">
    <div class="user-cart">
        <i class="fas fa-shopping-cart"></i>
    </div>
    <div class="user-cart-content">

    </div>
</div>