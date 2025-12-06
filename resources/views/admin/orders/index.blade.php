@extends('admin.layouts.admin')

@section('content')

<h2 class="text-2xl font-bold mb-4">Daftar Pesanan</h2>

<table class="w-full text-left bg-gray-800 text-gray-200 rounded shadow overflow-hidden">
    <thead class="bg-gray-700">
        <tr>
            <th class="p-3">ID</th>
            <th class="p-3">Nama Pembeli</th>
            <th class="p-3">Produk</th>
            <th class="p-3">Status</th>
            <th class="p-3">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($orders as $order)
        <tr class="border-b border-gray-700">
            <td class="p-3">{{ $order->id }}</td>
            <td class="p-3">{{ $order->user_name }}</td>
            <td class="p-3">{{ $order->product->name ?? '-' }}</td>
            <td class="p-3">
                <span class="px-3 py-1 rounded text-sm {{ $order->status=='pending' ? 'bg-yellow-600 text-white' : 'bg-green-600 text-white' }}">
                    {{ ucfirst($order->status) }}
                </span>
            </td>
            <td class="p-3">
                <a href="{{ route('admin.orders.show', $order) }}" class="text-blue-400 hover:underline">Detail</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection
