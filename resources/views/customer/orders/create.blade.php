@extends('customer.layouts.app')

@section('content')
<h2 class="text-2xl font-bold mb-4">Order {{ $product->name }}</h2>

<form action="{{ route('orders.store', $product) }}" method="POST">
    @csrf

    <input type="hidden" name="payment_method" value="qris">

    <div class="mb-4">
        <label class="block mb-1 font-semibold">Nama</label>
        <input type="text" name="user_name" class="w-full p-2 border rounded" required>
    </div>

    <div class="mb-4">
        <label class="block mb-1 font-semibold">Game ID</label>
        <input type="text" name="game_id" class="w-full p-2 border rounded" required>
    </div>

    <div class="mb-4">
        <label class="block mb-1 font-semibold">Server ID</label>
        <input type="text" name="server_id" class="w-full p-2 border rounded" required>
    </div>

    <div class="mb-4">
        <label class="block mb-1 font-semibold">No. Telepon</label>
        <input type="text" name="phone" class="w-full p-2 border rounded" required>
    </div>

    <div class="mb-4">
        <label class="block mb-1 font-semibold">Quantity</label>
        <input type="number" name="quantity" id="quantity" value="1" min="1" class="w-full p-2 border rounded" required>
    </div>

    <div class="mb-4">
        <label class="block mb-1 font-semibold">Total Harga</label>
        <input type="text" id="total_price" value="Rp {{ number_format($product->price,0,',','.') }}" class="w-full p-2 border rounded bg-gray-100" readonly>
    </div>

    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Order Sekarang</button>
</form>

<script>
    const price = {{ $product->price }};
    const quantityInput = document.getElementById('quantity');
    const totalInput = document.getElementById('total_price');

    quantityInput.addEventListener('input', () => {
        const total = quantityInput.value * price;
        totalInput.value = 'Rp ' + total.toLocaleString('id-ID');
    });
</script>
@endsection
