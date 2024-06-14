<div class="container mt-3">
    <div>
        @php
            $settings = App\Models\Setting::first();
        @endphp
        <div class="row">
            <div class="col-md-12">
                <h3>Orders List</h3>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Customer Name</th>
                                <th>Email</th>
                                <th>Total</th>
                                <th>Order Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($myOrders as $order)
                                <tr>
                                    <td>{{ $order->id }}</td>
                                    <td>{{ $order->name }}</td>
                                    <td>{{ $order->email }}</td>
                                    <td>{{ number_format($order->amount) }}<span
                                            style="font-size: 22px">{{ $settings->currency_symbol }}</span></td>
                                    <td>{{ $order->created_at }}</td>
                                    <td>{{ $order->status }}</td>
                                    <td>
                                        <a href="{{ route('user.invoices', $order->id) }}"><button
                                                class="btn btn-primary">Invoice</button></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div> <!-- .table-responsive -->
                <!-- Pagination -->
                <div class="mt-3">
                    {{ $myOrders->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
