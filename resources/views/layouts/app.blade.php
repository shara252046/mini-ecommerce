<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MiniGrocery - Fresh Groceries Online</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <!-- Navbar -->
    <nav class="bg-white shadow-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between h-16 items-center">
                <!-- Logo -->
                <a href="{{ route('home') }}" class="text-2xl font-bold text-green-600">🛒 MiniGrocery</a>

                <!-- Navbar Links -->
                <div class="flex items-center space-x-4">
                    <a href="{{ route('home') }}" class="text-gray-700 hover:text-green-600">Home</a>

                    <!-- Categories Dropdown -->
                    <div class="relative group">
                        <button class="text-gray-700 hover:text-green-600 flex items-center">
                            Categories ▾
                        </button>
                        <div class="absolute hidden group-hover:block bg-white shadow-lg rounded mt-2 py-2 w-48 z-50 max-h-96 overflow-y-auto">
                            @foreach(\App\Models\Category::all() as $cat)
                                <a href="{{ route('category.show', $cat->slug) }}" 
                                   class="block px-4 py-2 text-gray-700 hover:bg-green-50 hover:text-green-600">
                                    {{ $cat->name }}
                                </a>
                            @endforeach
                        </div>
                    </div>

                    @auth
                        <a href="{{ route('cart.index') }}" class="text-gray-700 hover:text-green-600">🛒 Cart</a>
                        <a href="{{ route('wishlist.index') }}" class="text-gray-700 hover:text-green-600">❤️ Wishlist</a>
                        <a href="{{ route('orders.index') }}" class="text-gray-700 hover:text-green-600">📦 Orders</a>
                        @if(auth()->user()->is_admin)
                            <a href="{{ route('admin.dashboard') }}" class="text-red-600 font-bold hover:text-red-800">⚙️ Admin</a>
                        @endif
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="text-gray-700 hover:text-red-600">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-700 hover:text-green-600">Login</a>
                        <a href="{{ route('register') }}" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Register</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Success/Error Messages -->
    <div class="max-w-7xl mx-auto px-4 mt-4">
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                ✅ {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                ⚠️ {{ session('error') }}
            </div>
        @endif
    </div>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 py-8">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-white shadow-md mt-12">
        <div class="max-w-7xl mx-auto px-4 py-6 text-center text-gray-600">
            <p class="mb-2">🛒 <strong>MiniGrocery</strong> - Fresh groceries delivered to your doorstep</p>
            <p class="text-sm">© {{ date('Y') }} MiniGrocery. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>