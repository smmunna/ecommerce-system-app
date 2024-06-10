@extends('layouts.dashboard_layout')
@section('title', 'Edit Cupon Code')
@section('content')

    <div class="container">
        <h1>Edit Cupon</h1>
        <form action="{{ route('cupons.update', $cupon->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="cupon_code">Cupon Code</label>
                <input type="text" name="cupon_code" class="form-control" id="cupon_code" value="{{ $cupon->cupon_code }}"
                    required>
            </div>
            <div class="form-group">
                <label for="discount_price">Discount Price</label>
                <input type="number" name="discount_price" class="form-control" id="discount_price"
                    value="{{ $cupon->discount_price }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>

@endsection
