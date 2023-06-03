<header class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container">
    <div class="d-flex align-items-center justify-content-between w-100">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="logo-container">
        <a class="navbar-brand" href="{{ route('home.index') }}">
          <img src="/img/parakeet.png" alt="Logo" width="50" height="50">
        </a>
      </div>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto flex-column flex-lg-row">
          @foreach ($menuItems as $menuItem)
            <li class="nav-item">
              <a class="nav-link {{ $menuItem['active'] ? 'current' : '' }}" href="{{ $menuItem['url'] }}"
                data-page="{{ $menuItem['title'] }}">
                {{ $menuItem['title'] }}
              </a>
            </li>
          @endforeach
          <li class="nav-item">
            @if (Auth::check())
              @if (Auth::user()->firstname === 'Admin')
                <a class="nav-link" href="{{ route('voyager.dashboard') }}">{{ Auth::user()->firstname }}</a>
              @else
                <a class="nav-link" href="{{ route('profile.index') }}">{{ Auth::user()->firstname }}</a>
              @endif
            @else
              <a class="btn btn-primary" href="{{ route('login') }}">Inloggen</a>
            @endif
          </li>
          <li class="nav-item">
            @if (Auth::check())
              <a class="btn btn-outline-primary" href="{{ route('logout') }}">Uitloggen</a>
            @else
              
            @endif
          </li>
        </ul>
      </div>
        <div class="cart-container">
          @if (Auth::check())
          <button id="cartToggle" class="cart-toggle">
            <span class="cart-icon">🛒</span>
            <span id="cartItemCount">{{$cart->getContent()->count()}}</span>
          </button>
          <div id="cartDropdown" class="cart-dropdown">
            <h2>Winkelwagen</h2>
            <ul class="list-group">
              @foreach ($cart->getContent() as $item)
                  <li class="list-group-item d-flex justify-content-between align-items-center">
                      <div class="d-flex flex-column">
                          <p>image</p>
                      </div>
                      <div class="d-flex flex-column">
                          <p>{{ $item->name->name }}</p>
                          <p>{{ $item->name->type_id }}</p>
                          <p>Aantal: {{ $item->quantity }}</p>
                          <a href="{{ route('cart.remove', ['id' => $item->id]) }}">Item verwijderen</a>
                      </div>
                      <div class="d-flex align-items-center">
                          <h3>€ {{ $item->price }}</h3>
                      </div>
                  </li>
              @endforeach
              <h2>Totaal: € {{$cart->getTotal()}}</h2>
            </ul>
            <a id="checkoutBtn" class="btn btn-primary" href="{{route('cart')}}">Naar winkelwagen</a>
          </div>
          @else
          @endif
        </div>
      </div>
    </div>
  </header>
  