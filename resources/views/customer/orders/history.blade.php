@extends('customer.layouts.app')

@section('content')
<div class="max-w-4xl mx-auto">

    <h2 class="text-2xl font-bold mb-6">Riwayat Pesanan</h2>

    <!-- Form pencarian -->
    <form action="{{ route('orders.history') }}" method="GET" class="mb-6 flex gap-2">
        <input type="text" name="order_code" placeholder="Masukkan kode pesanan" 
               class="flex-1 px-4 py-2 border rounded shadow-sm focus:outline-none focus:ring-2 focus:ring-gray-800" 
               value="{{ request('order_code') }}">
        <button type="submit" 
                class="px-4 py-2 bg-gray-800 text-white rounded hover:bg-gray-700 transition">
            Cari
        </button>
    </form>

    <!-- Tabel riwayat -->
    <div class="overflow-x-auto bg-white shadow rounded border border-gray-200">
        <table class="w-full text-left">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-3 border-b">Kode Pesanan</th>
                    <th class="p-3 border-b">Produk</th>
                    <th class="p-3 border-b">Jumlah</th>
                    <th class="p-3 border-b">Total Harga</th>
                    <th class="p-3 border-b">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $order)
                <tr class="border-b hover:bg-gray-50">
                    <td class="p-3">{{ $order->order_code }}</td>
                    <td class="p-3">{{ $order->product->name ?? '-' }}</td>
                    <td class="p-3">{{ $order->quantity }}</td>
                    <td class="p-3">Rp {{ number_format($order->total_price,0,',','.') }}</td>
                    <td class="p-3">
                        <span class="px-3 py-1 rounded text-white {{ $order->status=='pending' ? 'bg-yellow-600' : 'bg-green-600' }}">
                            {{ ucfirst($order->status) }}
                        </span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="p-3 text-center text-gray-500">Belum ada riwayat pesanan</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection
