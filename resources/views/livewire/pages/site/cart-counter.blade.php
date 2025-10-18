<button data-modal-target="checkoutModal" data-modal-toggle="checkoutModal"
    class="relative flex items-center justify-center w-14 h-14 rounded-full bg-blue-600 text-white shadow-lg hover:bg-blue-700 transition transform hover:scale-105 focus:outline-none">
    <i class="fa-solid fa-cart-shopping text-xl"></i>
    <span class="absolute -top-1 -right-1 bg-red-600 text-white text-xs font-semibold rounded-full px-2 py-0.5"
        id="nav-cart-badge">
        {{ $this->counter }}
    </span>
</button>