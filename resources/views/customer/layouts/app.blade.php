<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Top Up Anafora</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800">

    <!-- NAVBAR -->
    <nav class="bg-gray-800 text-white p-4 flex justify-between items-center">
        <div class="text-xl font-bold">Top Up Anafora</div>
        <div>
            <a href="{{ route('home') }}" class="px-3 py-1 hover:bg-gray-700 rounded">Katalog</a>
            <a href="{{ route('orders.history') }}" class="px-3 py-1 hover:bg-gray-700 rounded">Riwayat</a>
        </div>
    </nav>

    <!-- CONTENT -->
    <div class="p-6">
        @yield('content')
    </div>

</body>
</html>
