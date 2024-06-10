@extends('layouts.dashboard_layout')
@section('title', 'Cupon Code')
@section('content')

    <div class="container">
        <h1>Create Cupon</h1>
        @if ($errors->any())
            <div id="failure" class="alert alert-danger">
                <p>
                    @foreach ($errors->all() as $error)
                        <span>{{ $error }}</span> <br>
                    @endforeach
                </p>
            </div>
        @endif
        <form action="{{ route('cupons.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="cupon_code">Cupon Code</label>
                <input type="text" name="cupon_code" class="form-control" id="cupon_code" required>
            </div>
            <div class="form-group">
                <label for="discount_price">Discount Price</label>
                <input type="number" name="discount_price" class="form-control" id="discount_price" required>
            </div>
            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>

@endsection
