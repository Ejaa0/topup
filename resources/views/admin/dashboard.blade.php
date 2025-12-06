@extends('admin.layouts.admin')

@section('content')

<h2 class="text-2xl font-bold mb-6">Katalog Produk</h2>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @foreach($products as $product)
    <div class="bg-gray-800 p-5 shadow-lg rounded-lg border border-gray-700 hover:border-blue-500 transition">

        {{-- Tampilkan gambar produk --}}
        @if($product->image)
            <img src="{{ asset('storage/products/' . $product->image) }}" 
                 alt="{{ $product->name }}" 
                 class="w-full h-40 object-cover rounded mb-3">
        @else
            <img src="{{ asset('images/placeholder.png') }}" 
                 alt="Placeholder" 
                 class="w-full h-40 object-cover rounded mb-3">
        @endif

        <h3 class="text-xl font-semibold mb-2 text-white">{{ $product->name }}</h3>
        <p class="text-gray-400 mb-3">{{ $product->description }}</p>
        <p class="text-lg font-bold text-white mb-4">Rp {{ number_format($product->price, 0, ',', '.') }}</p>

        <a href="{{ route('admin.products.edit', $product) }}" 
           class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded transition">
            Edit Produk
        </a>
    </div>
    @endforeach
</div>

<hr class="border-gray-700 my-8">

<h2 class="text-2xl font-bold mb-4 flex justify-between items-center">
    Pesanan Terbaru
    <a href="{{ route('admin.orders.create') }}" 
       class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded transition">
        Tambah Pesanan
    </a>
</h2>

<div class="bg-gray-800 shadow-lg rounded-lg border border-gray-700 overflow-hidden">
    <table class="w-full text-left">
        <thead class="bg-gray-700 text-gray-300">
            <tr>
                <th class="p-3">ID</th>
                <th class="p-3">Kode Order</th>
                <th class="p-3">Nama Pembeli</th>
                <th class="p-3">Produk</th>
                <th class="p-3">Status</th>
                <th class="p-3">Aksi</th>
            </tr>
        </thead>

        <tbody>
            @foreach($orders as $order)
            <tr class="border-b border-gray-700 hover:bg-gray-700 transition">
                <td class="p-3">{{ $order->id }}</td>
                <td class="p-3">{{ $order->order_code ?? '-' }}</td>
                <td class="p-3">{{ $order->user_name }}</td>
                <td class="p-3">{{ $order->product->name ?? '-' }}</td>
                <td class="p-3">
                    <span class="px-3 py-1 rounded text-sm {{ $order->status=='pending' ? 'bg-yellow-600 text-white' : 'bg-green-600 text-white' }}">
                        {{ ucfirst($order->status) }}
                    </span>
                </td>
                <td class="p-3 flex gap-2 items-center">
                    {{-- Detail --}}
                    <a href="{{ route('admin.orders.show', $order) }}" class="text-blue-400 hover:underline">Detail</a>

                    {{-- Hapus --}}
                    <form action="{{ route('admin.orders.destroy', $order) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus pesanan ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-2 py-1 bg-red-600 hover:bg-red-700 text-white rounded text-sm">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
