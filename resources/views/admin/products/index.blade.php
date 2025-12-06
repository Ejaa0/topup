@extends('admin.layouts.admin')

@section('content')

<h2 class="text-2xl font-bold mb-4">Daftar Produk</h2>

<a href="{{ route('admin.products.create') }}" 
   class="mb-4 inline-block px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded">
    Tambah Produk
</a>

<table class="w-full text-left bg-gray-800 text-gray-200 rounded shadow overflow-hidden">
    <thead class="bg-gray-700">
        <tr>
            <th class="p-3">ID</th>
            <th class="p-3">Gambar</th>
            <th class="p-3">Nama</th>
            <th class="p-3">Deskripsi</th>
            <th class="p-3">Harga</th>
            <th class="p-3">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($products as $product)
        <tr class="border-b border-gray-700">
            <td class="p-3">{{ $product->id }}</td>

            {{-- Kolom Gambar --}}
            <td class="p-3">
                @if($product->image)
                    <img src="{{ asset('storage/products/' . $product->image) }}" 
                         alt="{{ $product->name }}" class="w-20 h-20 object-cover rounded">
                @else
                    <img src="{{ asset('images/placeholder.png') }}" 
                         alt="Placeholder" class="w-20 h-20 object-cover rounded">
                @endif
            </td>

            <td class="p-3">{{ $product->name }}</td>
            <td class="p-3">{{ $product->description }}</td>
            <td class="p-3">Rp {{ number_format($product->price,0,',','.') }}</td>
            <td class="p-3 space-x-2">
                <a href="{{ route('admin.products.edit', $product) }}" class="text-blue-400 hover:underline">Edit</a>
                <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="inline-block">
                    @csrf
                    @method('DELETE')
                    <button class="text-red-400 hover:underline" onclick="return confirm('Hapus produk?')">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection
