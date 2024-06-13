@extends('layouts.dashboard_layout')
@section('title', 'Cupon Code')
@section('content')

    <div class="container">
        <h1>Cupons</h1>
        <a href="{{ route('cupons.create') }}" class="btn btn-primary">Create Cupon</a>

        @if ($message = Session::get('success'))
            <div id="success" class="alert alert-success mt-2">
                {{ $message }}
            </div>
        @endif

        @if ($cupons->isEmpty())
            <div class="alert alert-info mt-2">
                No coupons found.
            </div>
        @else
            <table class="table mt-3">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Cupon Code</th>
                        <th>Discount Price</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cupons as $cupon)
                        <tr>
                            <td>{{ $cupon->id }}</td>
                            <td>{{ $cupon->cupon_code }}</td>
                            <td>{{ $cupon->discount_price }}</td>
                            <td>{{ $cupon->created_at }}</td>
                            <td>
                                <a href="{{ route('cupons.edit', $cupon->id) }}" class="btn btn-warning">Edit</a>
                                <form action="{{ route('cupons.destroy', $cupon->id) }}" method="POST"
                                    style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>

@endsection
