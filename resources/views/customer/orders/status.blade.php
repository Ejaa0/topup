@extends('customer.layouts.app')

@section('content')
<div class="p-6">
    <h2 class="text-2xl font-bold mb-4">Status Pesanan</h2>

    <div class="bg-white p-4 rounded shadow">
        <p><strong>Kode Pesanan:</strong> {{ $order->order_code }}</p>
        <p><strong>Produk:</strong> {{ $order->product->name }}</p>
        <p><strong>Total:</strong> Rp {{ number_format($order->total_price,0,',','.') }}</p>
        <p><strong>Status:</strong> 
            <span class="px-3 py-1 rounded {{ $order->status == 'pending' ? 'bg-yellow-500 text-white' : 'bg-green-600 text-white' }}">
                {{ strtoupper($order->status) }}
            </span>
        </p>
    </div>

    {{-- Jika metode qris: tampilkan QRIS --}}
    @if($order->payment_method === 'qris')
    <div class="mt-6 bg-white p-4 rounded shadow text-center">
        <h3 class="text-xl font-semibold mb-3">Scan QRIS untuk Pembayaran</h3>
        <img src="{{ asset('qris/qris.jpg') }}" alt="QRIS" class="mx-auto w-64 rounded border">
    </div>
    @endif


    {{-- Jika belum upload bukti, tampilkan form upload --}}
    @if(!$order->payment_proof && $order->status === 'pending')
    <div class="mt-6 bg-white p-4 rounded shadow">
        <h3 class="text-lg font-semibold mb-3">Upload Bukti Pembayaran</h3>

        <form action="{{ route('orders.upload-proof', $order) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="file" name="payment_proof" accept="image/*" class="w-full p-2 border rounded mb-3" required>
            <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded">Upload Bukti</button>
        </form>
    </div>
    @endif

    {{-- Jika sudah upload, tampilkan bukti --}}
    @if($order->payment_proof)
    <div class="mt-6 bg-white p-4 rounded shadow">
        <h3 class="text-lg font-semibold mb-3">Bukti Pembayaran</h3>
        <img src="{{ asset('storage/payments/' . $order->payment_proof) }}" alt="Bukti" class="w-64 rounded border">
    </div>
    @endif
</div>
@endsection
