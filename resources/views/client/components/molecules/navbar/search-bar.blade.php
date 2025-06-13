<a href="{{ route('clientCarts') }}" class="text-decoration-none">
  <div class="cart">
    <span class="badge bg-dark count" id="cartCount">{{ count((array) session('cart')) }}</span>
    <i class="bi bi-cart2 mt-2"></i>
  </div>
</a>