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
                            @foreach ($recentOrders as $order)
                                <tr>
                                    <td>{{ $order->id }}</td>
                                    <td>{{ $order->name }}</td>
                                    <td>{{ $order->email }}</td>
                                    <td>{{ $order->amount }}<span
                                            style="font-size: 22px">{{ $settings->currency_symbol }}</span></td>
                                    <td>{{ $order->created_at->format('d-m-Y H:i') }}</td>
                                    <td>
                                        <form action="{{ route('updateOrderStatus', $order->id) }}" method="POST"
                                            class="form-inline">
                                            @csrf
                                            @method('PUT')
                                            <div class="form-group">
                                                <select name="status" class="form-control">
                                                    <option value="processing"
                                                        {{ $order->status == 'processing' ? 'selected' : '' }}>
                                                        Processing
                                                    </option>
                                                    <option value="pending"
                                                        {{ $order->status == 'pending' ? 'selected' : '' }}>Pending
                                                    </option>
                                                    <option value="completed"
                                                        {{ $order->status == 'completed' ? 'selected' : '' }}>Completed
                                                    </option>
                                                </select>
                                            </div>
                                            <button type="submit" class="btn btn-primary btn-sm ml-2"
                                                {{ $order->status == 'completed' ? 'disabled' : '' }}>Update</button>
                                        </form>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.invoices', $order->id) }}"><button
                                                class="btn btn-primary">Invoice</button></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div> <!-- .table-responsive -->
            </div>
        </div>
    </div>
</div>
