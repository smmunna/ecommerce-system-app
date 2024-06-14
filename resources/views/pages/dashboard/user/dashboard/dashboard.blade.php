@php
    $settings = App\Models\Setting::first();
@endphp

<div class="container-fluid pt-3">
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-lg-6 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ number_format($totalCostByUser, 2) }}<span
                            style="font-size: 30px">{{ $settings->currency_symbol }}</span></h3>

                    <p>Total Cost</p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-6 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $totalOrdersByUser }}</h3>

                    <p>Total Orders</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>
    <!-- /.row -->
    <!-- Recent Orders -->
    @include('pages.dashboard.user.dashboard.my_orders', ['myOrders' => $myOrders])
</div><!-- /.container-fluid -->
