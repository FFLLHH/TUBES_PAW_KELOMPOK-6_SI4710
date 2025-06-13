@prepend('css')
<link rel="stylesheet" href="{{ asset('client/components/organisms/navbar/style.css') }}">
<style>
.nav-admin {
  margin-left: 1rem;
  padding: 0.5rem 1rem;
  background-color: #435ebe;
  color: white;
  border-radius: 0.5rem;
  text-decoration: none;
}
.nav-admin:hover {
  background-color: #364b98;
  color: white;
}
.nav-logout {
  margin-left: 1rem;
  padding: 0.5rem 1rem;
  background-color: #dc3545;
  color: white;
  border-radius: 0.5rem;
  text-decoration: none;
}
.nav-logout:hover {
  background-color: #bb2d3b;
  color: white;
}
</style>
@endprepend
<header class="header" id="header">
  <nav class="nav container">
    <div class="nav-button">
      <div class="nav-toggle" id="nav-toggle">
        <i class="bi bi-list"></i>
      </div>
    </div>
    <div class="d-flex align-items-center">
      <a href="{{ route('clientProducts') }}" class="nav-logo" id="logo">
        <img src="{{ asset('shop/'.$path) }}" alt="">
      </a>
      @auth
        @if(Auth::user()->role === 'admin')
          <a href="{{ route('home') }}" class="nav-admin">Admin</a>
        @endif
      @endauth
    </div>
    <div class="nav-menu" id="nav-menu">
     <x-molecules.navbar.menu />
      <div class="nav-close" id="nav-close">
        <i class="bi bi-x"></i>
      </div>
    </div>
    <div class="icon-left d-flex align-items-center">
      <x-molecules.navbar.search-bar/>
      @auth
        <a href="{{ route('logout') }}" 
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();" 
           class="nav-logout">Keluar</a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
          @csrf
        </form>
      @endauth
    </div>
  </nav>
</header>
@prepend('js')
  <script>
    const navMenu = document.getElementById("nav-menu"),
    navToggle = document.getElementById("nav-toggle"),
    navClose = document.getElementById("nav-close"),
    logo = document.getElementById("logo");

    if (navToggle) {
        navToggle.addEventListener("click", () => {
            navMenu.classList.add("show-menu");
        });
    }

    if (navClose) {
        navClose.addEventListener("click", () => {
            navMenu.classList.remove("show-menu");
        });
    }

    function Onfocus() {
        if (window.matchMedia("(min-width:767px)").matches) {
            navMenu.classList.add("d-none");
        } else {
            logo.classList.add("d-none");
        }
    }

    function Onblur() {
        if (window.matchMedia("(min-width:767px)").matches) {
            navMenu.classList.remove("d-none");
        } else {
            logo.classList.remove("d-none");
        }
    }
  </script>
@endprepend