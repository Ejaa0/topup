@extends('customer.layouts.app')

@section('content')
<div class="p-6">
    <h2 class="text-3xl font-bold mb-6 text-black">Katalog Produk</h2>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($products as $product)
        <div class="bg-white shadow-lg rounded-lg border border-gray-300 hover:shadow-xl transition overflow-hidden">
            
            <!-- Gambar Produk -->
            @if($product->image)
                <img src="{{ asset('storage/products/' . $product->image) }}" 
                     alt="{{ $product->name }}" 
                     class="w-full h-48 object-cover">
            @else
                <img src="{{ asset('images/placeholder.png') }}" 
                     alt="Placeholder" 
                     class="w-full h-48 object-cover">
            @endif

            <!-- Info Produk -->
            <div class="p-4">
                <h3 class="text-xl font-semibold mb-2 text-black">{{ $product->name }}</h3>
                <p class="text-gray-600 mb-3">{{ $product->description }}</p>
                <p class="text-lg font-bold text-black mb-4">Rp {{ number_format($product->price, 0, ',', '.') }}</p>

                <!-- Tombol Order -->
                <a href="{{ route('orders.create', $product) }}" 
                   class="w-full inline-block text-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded transition">
                    Order Sekarang
                </a>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
