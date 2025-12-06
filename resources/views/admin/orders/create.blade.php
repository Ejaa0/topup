@extends('admin.layouts.admin')

@section('content')

<h2 class="text-2xl font-bold mb-6">Tambah Pesanan Baru</h2>

<div class="bg-gray-800 shadow-lg rounded-lg p-6 border border-gray-700 max-w-3xl">
    <form action="{{ route('admin.orders.store') }}" method="POST" class="space-y-4">
        @csrf

        <!-- Nama Pembeli -->
        <div>
            <label class="block text-gray-300 mb-1" for="user_name">Nama Pembeli</label>
            <input type="text" name="user_name" id="user_name" 
                   class="w-full p-3 rounded bg-gray-900 border border-gray-600 text-white focus:outline-none focus:border-blue-500"
                   value="{{ old('user_name') }}" required>
            @error('user_name') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <!-- Pilih Produk -->
        <div>
            <label class="block text-gray-300 mb-1" for="product_id">Produk</label>
            <select name="product_id" id="product_id"
                    class="w-full p-3 rounded bg-gray-900 border border-gray-600 text-white focus:outline-none focus:border-blue-500"
                    required>
                <option value="">-- Pilih Produk --</option>
                @foreach($products as $product)
                <option value="{{ $product->id }}" {{ old('product_id') == $product->id ? 'selected' : '' }}>
                    {{ $product->name }} - Rp {{ number_format($product->price,0,',','.') }}
                </option>
                @endforeach
            </select>
            @error('product_id') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <!-- Game ID -->
        <div>
            <label class="block text-gray-300 mb-1" for="game_id">Game ID</label>
            <input type="text" name="game_id" id="game_id" 
                   class="w-full p-3 rounded bg-gray-900 border border-gray-600 text-white focus:outline-none focus:border-blue-500"
                   value="{{ old('game_id') }}" required>
            @error('game_id') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <!-- Server ID -->
        <div>
            <label class="block text-gray-300 mb-1" for="server_id">Server ID</label>
            <input type="text" name="server_id" id="server_id" 
                   class="w-full p-3 rounded bg-gray-900 border border-gray-600 text-white focus:outline-none focus:border-blue-500"
                   value="{{ old('server_id') }}" required>
            @error('server_id') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <!-- Nomor Telepon -->
        <div>
            <label class="block text-gray-300 mb-1" for="phone">Nomor Telepon</label>
            <input type="text" name="phone" id="phone" 
                   class="w-full p-3 rounded bg-gray-900 border border-gray-600 text-white focus:outline-none focus:border-blue-500"
                   value="{{ old('phone') }}" required>
            @error('phone') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <!-- Jumlah -->
        <div>
            <label class="block text-gray-300 mb-1" for="quantity">Jumlah</label>
            <input type="number" name="quantity" id="quantity" min="1"
                   class="w-full p-3 rounded bg-gray-900 border border-gray-600 text-white focus:outline-none focus:border-blue-500"
                   value="{{ old('quantity',1) }}" required>
            @error('quantity') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <!-- Status -->
        <div>
            <label class="block text-gray-300 mb-1" for="status">Status</label>
            <select name="status" id="status"
                    class="w-full p-3 rounded bg-gray-900 border border-gray-600 text-white focus:outline-none focus:border-blue-500"
                    required>
                <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="done" {{ old('status') == 'done' ? 'selected' : '' }}>Done</option>
            </select>
            @error('status') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <!-- Submit -->
        <div class="flex justify-end">
            <button type="submit" 
                    class="px-6 py-3 bg-green-600 hover:bg-green-700 rounded text-white font-semibold transition">
                Tambah Pesanan
            </button>
        </div>
    </form>
</div>

@endsection
