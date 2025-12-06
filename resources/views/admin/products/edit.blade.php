@extends('admin.layouts.admin')

@section('content')
<h2 class="text-2xl font-bold mb-6">Edit Produk</h2>

<form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data" class="bg-gray-800 p-6 rounded-lg shadow-lg border border-gray-700">
    @csrf
    @method('PUT')

    <label class="block mb-2 text-white font-medium">Nama Produk</label>
    <input type="text" name="name" class="w-full p-2 rounded border border-gray-600 text-white bg-gray-900" value="{{ $product->name }}" required>

    <label class="block mb-2 mt-4 text-white font-medium">Deskripsi</label>
    <textarea name="description" class="w-full p-2 rounded border border-gray-600 text-white bg-gray-900">{{ $product->description }}</textarea>

    <label class="block mb-2 mt-4 text-white font-medium">Harga</label>
    <input type="number" name="price" class="w-full p-2 rounded border border-gray-600 text-white bg-gray-900" value="{{ $product->price }}" required>

    <label class="block mb-2 mt-4 text-white font-medium">Gambar Produk</label>
    <input type="file" name="image" class="w-full p-2 rounded border border-gray-600 bg-gray-900 text-white">

    @if($product->image)
        <p class="mt-2 text-gray-300 font-medium">Gambar saat ini:</p>
        <img src="{{ asset('storage/'.$product->image) }}" alt="Gambar Produk" class="w-32 h-32 object-cover mt-2 rounded border border-gray-600">
    @endif

    <button type="submit" class="mt-4 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded font-medium">Update Produk</button>
</form>
@endsection
