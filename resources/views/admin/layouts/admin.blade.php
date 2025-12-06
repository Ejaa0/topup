<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-gray-200">

<div class="flex min-h-screen">

    <!-- SIDEBAR -->
    <aside class="w-64 bg-gray-900 text-gray-200 shadow-lg flex flex-col">
        <div class="p-6">
            <h2 class="text-2xl font-bold mb-6">Admin Panel Dashboard</h2>
        </div>

        <nav class="flex-1 px-4 space-y-2">
            <a href="{{ route('admin.dashboard') }}" 
               class="block px-4 py-2 rounded hover:bg-gray-200 hover:text-gray-900 transition">
                Dashboard
            </a>
            <a href="{{ route('admin.products.index') }}" 
               class="block px-4 py-2 rounded hover:bg-gray-200 hover:text-gray-900 transition">
                Produk
            </a>
            <a href="{{ route('admin.orders.index') }}" 
               class="block px-4 py-2 rounded hover:bg-gray-200 hover:text-gray-900 transition">
                Pesanan
            </a>
        </nav>
    </aside>

    <!-- CONTENT -->
    <div class="flex-1 flex flex-col">
        <!-- Topbar -->
        <header class="bg-gray-800 border-b border-gray-700 shadow p-4 flex justify-between items-center">
            <h1 class="text-xl font-semibold">Admin Panel Dashboard</h1>
            <div class="text-gray-400">Logged in as: Admin</div>
        </header>

        <!-- Main Content -->
        <main class="p-6 flex-1 overflow-auto">
            @yield('content')
        </main>
    </div>

</div>

</body>
</html>
