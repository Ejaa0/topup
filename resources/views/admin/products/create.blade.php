@extends('admin.layouts.admin')

@section('content')
<h2 class="text-2xl font-bold mb-6">Tambah Produk</h2>

<form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="bg-gray-800 p-6 rounded-lg shadow-lg border border-gray-700">
    @csrf

    <label class="block mb-2 text-white">Nama Produk</label>
    <input type="text" name="name" class="w-full p-2 rounded border" required>

    <label class="block mb-2 mt-4 text-white">Deskripsi</label>
    <textarea name="description" class="w-full p-2 rounded border"></textarea>

    <label class="block mb-2 mt-4 text-white">Harga</label>
    <input type="number" name="price" class="w-full p-2 rounded border" required>

    <label class="block mb-2 mt-4 text-white">Gambar Produk</label>
    <input type="file" name="image" class="w-full p-2 rounded border">

    <button type="submit" class="mt-4 px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded">Simpan Produk</button>
</form>
@endsection
