<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MiniGrocery - Fresh Groceries Online</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .cat-item:hover .sub-menu {
            display: block !important;
        }
        .cat-item, .sub-menu a {
            transition: all 0.2s ease;
        }
        .dropdown-item:hover .dropdown-menu {
            display: block !important;
        }
    </style>
</head>
<body class="bg-gray-100">

    <!-- =====================================================
         ROW 1: TOP BAR (Hotline + Free Delivery Info)
         ===================================================== -->
    <div class="bg-green-700 text-white text-xs py-1.5">
        <div class="max-w-7xl mx-auto px-4 flex justify-between items-center">
            <p>📞 Hotline: 16297 &nbsp;|&nbsp; 🚚 Free Delivery on Orders ৳500+</p>
            <div class="hidden md:flex gap-4">
                <a href="#" class="hover:underline">Track Order</a>
                <a href="#" class="hover:underline">Help Center</a>
            </div>
        </div>
    </div>

    <!-- =====================================================
         ROW 2: MAIN NAVBAR (Logo + Search + Cart/User)
         ===================================================== -->
    <nav class="bg-white shadow-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between items-center h-20 gap-4">

                <!-- Logo -->
                <a href="{{ route('home') }}" class="flex items-center gap-2 flex-shrink-0">
                    <span class="text-4xl">🛒</span>
                    <div>
                        <div class="text-2xl font-bold text-green-700 leading-none">MiniGrocery</div>
                        <div class="text-xs text-gray-500">Fresh • Fast • Reliable</div>
                    </div>
                </a>

                <!-- Search Bar (Desktop) -->
                <form method="GET" action="{{ route('search') }}" class="hidden md:flex flex-1 max-w-2xl">
                    <div class="flex w-full border-2 border-green-600 rounded-lg overflow-hidden">
                        <input type="text" name="search" 
                               placeholder="🔍 Search for products (e.g., rice, oil, milk)..." 
                               value="{{ request('search') }}"
                               class="flex-1 px-4 py-3 text-sm focus:outline-none">
                        <button type="submit" 
                                class="bg-green-600 text-white px-6 hover:bg-green-700 font-semibold flex items-center gap-2">
                            <span class="text-lg">🔍</span>
                            <span class="hidden lg:inline">Search</span>
                        </button>
                    </div>
                </form>

                <!-- Right Side Icons -->
                <div class="flex items-center gap-2 flex-shrink-0">

                    @auth
                        <!-- Admin Button -->
                        @if(auth()->user()->is_admin)
                            <a href="{{ route('admin.dashboard') }}" 
                               class="hidden lg:flex items-center gap-2 bg-red-50 text-red-600 px-3 py-2 rounded-lg hover:bg-red-100">
                                <span>⚙️</span>
                                <span class="text-sm font-semibold">Admin</span>
                            </a>
                        @endif

                        <!-- Cart with Badge -->
                        <a href="{{ route('cart.index') }}" 
                           class="relative bg-green-50 text-green-700 px-3 py-2 rounded-lg hover:bg-green-100 flex items-center gap-2">
                            <span class="text-xl">🛒</span>
                            @php $cartCount = \App\Models\Cart::where('user_id', auth()->id())->sum('quantity'); @endphp
                            @if($cartCount > 0)
                                <span class="absolute -top-2 -right-2 bg-red-500 text-white text-xs font-bold rounded-full w-5 h-5 flex items-center justify-center">
                                    {{ $cartCount }}
                                </span>
                            @endif
                            <span class="text-sm font-semibold hidden lg:inline">Cart</span>
                        </a>

                        <!-- Wishlist with Badge -->
                        <a href="{{ route('wishlist.index') }}" 
                           class="relative bg-pink-50 text-pink-700 px-3 py-2 rounded-lg hover:bg-pink-100 flex items-center gap-2">
                            <span class="text-xl">Wishlist❤️</span>
                            @php $wishlistCount = \App\Models\Wishlist::where('user_id', auth()->id())->count(); @endphp
                            @if($wishlistCount > 0)
                                <span class="absolute -top-2 -right-2 bg-red-500 text-white text-xs font-bold rounded-full w-5 h-5 flex items-center justify-center">
                                    {{ $wishlistCount }}
                                </span>
                            @endif
                        </a>

                        <!-- User Dropdown -->
                        <div class="relative dropdown-item">
                            <button class="flex items-center gap-2 bg-gray-100 px-3 py-2 rounded-lg hover:bg-gray-200">
                                <div class="w-8 h-8 bg-green-600 text-white rounded-full flex items-center justify-center font-bold">
                                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                </div>
                                <span class="text-sm font-semibold hidden lg:inline">{{ auth()->user()->name }}</span>
                                <span class="text-xs">▾</span>
                            </button>
                            <div class="dropdown-menu hidden absolute right-0 bg-white shadow-lg rounded-lg mt-2 py-2 w-48 z-50 border border-gray-200">
                                <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-gray-700 hover:bg-green-50 text-sm">👤 My Dashboard</a>
                                <a href="{{ route('orders.index') }}" class="block px-4 py-2 text-gray-700 hover:bg-green-50 text-sm">📦 My Orders</a>
                                <a href="{{ route('wishlist.index') }}" class="block px-4 py-2 text-gray-700 hover:bg-green-50 text-sm">❤️ Wishlist</a>
                                <hr class="my-1">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="w-full text-left px-4 py-2 text-red-600 hover:bg-red-50 text-sm">🚪 Logout</button>
                                </form>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-700 hover:text-green-600 px-3 py-2 font-semibold">Login</a>
                        <a href="{{ route('register') }}" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 font-semibold">
                            Sign Up
                        </a>
                    @endauth
                </div>
            </div>

            <!-- Mobile Search Bar -->
            <div class="md:hidden pb-3">
                <form method="GET" action="{{ route('search') }}" class="flex border-2 border-green-600 rounded-lg overflow-hidden">
                    <input type="text" name="search" placeholder="🔍 Search..." 
                           value="{{ request('search') }}"
                           class="flex-1 px-3 py-2 text-sm focus:outline-none">
                    <button type="submit" class="bg-green-600 text-white px-4">🔍</button>
                </form>
            </div>
        </div>
<!-- ============ CATEGORY MENU BAR (Row 3) ============ -->
<div class="bg-gray-50 border-t border-gray-200 relative">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex items-center justify-between h-10 text-sm">

            <!-- Left: Category Menu with Mega Dropdown -->
            <div class="relative group">
                <button class="font-bold text-green-700 hover:text-green-900 whitespace-nowrap flex items-center gap-2 h-10 px-2">
                    <span>☰</span>
                    <span>shop by CATEGORY</span>
                    <span class="text-xs">▾</span>
                </button>

                <!-- Mega Menu Dropdown -->
                @php
                    $menuCategories = \App\Models\Category::whereNull('parent_id')
                        ->with('subCategories')
                        ->take(8)
                        ->get();
                @endphp

                <div class="absolute hidden group-hover:block top-full left-0 bg-white shadow-2xl rounded-b-lg z-50 w-[900px] border border-gray-200">
                    <div class="grid grid-cols-4 gap-4 p-6">
                        @foreach($menuCategories as $cat)
                            <div>
                                <h3 class="font-bold text-green-700 text-sm mb-2 border-b pb-1 flex items-center gap-1">
                                    {{ $cat->name }}
                                </h3>
                                @if($cat->subCategories->count() > 0)
                                    <ul class="space-y-1">
                                        @foreach($cat->subCategories as $sub)
                                            <li>
                                                <a href="{{ route('category.show', $sub->slug) }}" 
                                                   class="text-xs text-gray-600 hover:text-green-600 block py-1">
                                                    → {{ $sub->name }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @else
                                    <p class="text-xs text-gray-400">No sub-categories</p>
                                @endif
                                <a href="{{ route('category.show', $cat->slug) }}" 
                                   class="text-xs text-green-600 font-semibold mt-2 inline-block hover:underline">
                                    View All →
                                </a>
                            </div>
                        @endforeach
                    </div>

                    <!-- Bottom Row -->
                    <div class="bg-green-50 border-t px-6 py-3 flex justify-between items-center">
                        <p class="text-xs text-gray-600">🛒 Fresh groceries delivered to your doorstep</p>
                        <a href="{{ route('home') }}" class="text-xs font-bold text-green-700 hover:underline">
                            View All Categories →
                        </a>
                    </div>
                </div>
            </div>

            <!-- Right: Help & Support -->
            <div class="flex items-center gap-6">
                <a href="{{ route('help') }}" class="text-gray-700 hover:text-green-600 whitespace-nowrap flex items-center gap-1">
                    <span>📞</span>
                    <span>Help</span>
                </a>
            </div>
        </div>
    </div>
</div>

    <!-- =====================================================
         SUCCESS / ERROR MESSAGES
         ===================================================== -->
    <div class="max-w-7xl mx-auto px-4 mt-4">
        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-600 text-green-800 px-4 py-3 rounded mb-4 flex items-center gap-2">
                <span class="text-xl">✅</span>
                <span>{{ session('success') }}</span>
            </div>
        @endif
        @if(session('error'))
            <div class="bg-red-100 border-l-4 border-red-600 text-red-800 px-4 py-3 rounded mb-4 flex items-center gap-2">
                <span class="text-xl">⚠️</span>
                <span>{{ session('error') }}</span>
            </div>
        @endif
    </div>

    <!-- =====================================================
         MAIN CONTENT
         ===================================================== -->
    <main class="max-w-7xl mx-auto px-4 py-6">
        @yield('content')
    </main>

    <!-- =====================================================
         FOOTER
         ===================================================== -->
    <footer class="bg-gray-800 text-white mt-12">
        <div class="max-w-7xl mx-auto px-4 py-8 grid grid-cols-1 md:grid-cols-4 gap-6">
            <div>
                <h3 class="font-bold text-lg mb-3 text-green-400">🛒 MiniGrocery</h3>
                <p class="text-gray-300 text-sm">Fresh groceries delivered to your doorstep within 60 minutes.</p>
            </div>
            <div>
                <h3 class="font-bold mb-3">Quick Links</h3>
                <ul class="space-y-1 text-sm text-gray-300">
                    <li><a href="{{ route('home') }}" class="hover:text-green-400">Home</a></li>
                    <li><a href="{{ route('search') }}" class="hover:text-green-400">All Products</a></li>
                    <li><a href="#" class="hover:text-green-400">Offers</a></li>
                </ul>
            </div>
            <div>
                <h3 class="font-bold mb-3">Customer Service</h3>
                <ul class="space-y-1 text-sm text-gray-300">
                    <li>📞 Hotline: 16297</li>
                    <li>✉️ support@minigrocery.com</li>
                    <li>🕐 24/7 Service</li>
                </ul>
            </div>
            <div>
                <h3 class="font-bold mb-3">Follow Us</h3>
                <div class="flex gap-3 text-2xl">
                    <a href="#" class="hover:text-green-400">📘</a>
                    <a href="#" class="hover:text-green-400">📷</a>
                    <a href="#" class="hover:text-green-400">🐦</a>
                    <a href="#" class="hover:text-green-400">▶️</a>
                </div>
            </div>
        </div>
        <div class="bg-gray-900 text-center py-3 text-sm text-gray-400">
            © {{ date('Y') }} MiniGrocery. All rights reserved.
        </div>
    </footer>

</body>
</html>