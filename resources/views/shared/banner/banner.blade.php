@php
    // Fetch the first settings record from the database
    $recentCategories = DB::table('categories')
        ->where('is_featured', 'yes')
        ->orderBy('created_at', 'desc')
        ->limit(3)
        ->get();

@endphp
<!-- SECTION -->
<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <!-- shop -->
            @foreach ($recentCategories as $category)
                <div class="col-md-4 col-xs-6">
                    <div class="shop">
                        <div class="shop-img">
                            <img src={{ asset($category->photo) }} alt="">
                        </div>
                        <div class="shop-body">
                            <h3>{{ $category->name }}<br>Collection</h3>
                            <a href="{{ route('category_products', ['category' => $category->id]) }}" class="cta-btn">Shop now
                                <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>
            @endforeach
            <!-- /shop -->
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /SECTION -->
