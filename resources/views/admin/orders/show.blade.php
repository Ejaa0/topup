@extends('admin.layouts.admin')

@section('content')
<div class="p-6">

    <h2 class="text-2xl font-bold mb-4 text-white">Detail Pesanan</h2>

    <div class="bg-gray-800 p-4 rounded shadow text-white">
        <p><strong>Kode Pesanan:</strong> {{ $order->order_code }}</p>
        <p><strong>Pembeli:</strong> {{ $order->user_name }}</p>
        <p><strong>Produk:</strong> {{ $order->product->name }}</p>
        <p><strong>Qty:</strong> {{ $order->quantity }}</p>
        <p><strong>Total:</strong> Rp {{ number_format($order->total_price,0,',','.') }}</p>
        <p><strong>Metode Pembayaran:</strong> {{ strtoupper($order->payment_method) }}</p>

        <p class="mt-2"><strong>Status:</strong>
            <span class="px-3 py-1 rounded text-sm 
                {{ $order->status=='pending' ? 'bg-yellow-600' : ($order->status=='done' ? 'bg-green-600' : 'bg-red-600') }}">
                {{ strtoupper($order->status) }}
            </span>
        </p>
    </div>


    {{-- Bukti Pembayaran --}}
    <div class="mt-6 bg-gray-800 p-4 rounded shadow text-white">
        <h3 class="text-lg font-semibold mb-3">Bukti Pembayaran</h3>

        @if($order->payment_proof)
            <img src="{{ asset('storage/payments/' . $order->payment_proof) }}" 
                class="w-64 rounded border mb-3">
        @else
            <p class="text-gray-400">Belum ada bukti pembayaran.</p>
        @endif
    </div>


    {{-- Update Status --}}
    <div class="mt-6 bg-gray-800 p-4 rounded shadow text-white">
        <h3 class="text-lg font-semibold mb-3">Ubah Status Pesanan</h3>

        <form action="{{ route('admin.orders.updateStatus', $order) }}" method="POST">
            @csrf
            @method('PATCH')

            <select name="status" class="p-2 bg-gray-900 border border-gray-600 rounded text-white">
                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="done" {{ $order->status == 'done' ? 'selected' : '' }}>Done</option>
                <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
            </select>

            <button class="px-4 py-2 bg-blue-600 hover:bg-blue-700 rounded ml-2">
                Update
            </button>
        </form>
    </div>

</div>
@endsection
