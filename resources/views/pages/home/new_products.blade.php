<!-- SECTION -->
<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">

            <!-- section title -->
            <div class="col-md-12">
                <div class="section-title">
                    <h3 class="title">New Products</h3>
                    <div class="section-nav">
                        <ul class="section-tab-nav tab-nav">
                            <li class="active"><a data-toggle="tab" href="#tab1">All Products</a></li>
                            <!--<li><a data-toggle="tab" href="#tab1">Software</a></li>-->
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /section title -->
            @php

            @endphp
            <!-- Products tab & slick -->
            <div class="col-md-12">
                <div class="row">
                    <div class="products-tabs">
                        <!-- tab 1 -->
                        <div id="tab1" class="tab-pane active">
                            <div class="products-slick" data-nav="#slick-nav-1">
                                @php
                                    use Illuminate\Support\Facades\DB;

                                    // Fetch products with condition 'new'
                                    $products = DB::table('products')->where('condition', 'new')->get();
                                @endphp

                                @foreach ($products as $product)
                                    <!-- product -->
                                    <div class="product">
                                        <div class="product-img">
                                            @php
                                                $photos = json_decode($product->photo);
                                                $firstPhoto = $photos ? $photos[0] : 'default.jpg';
                                            @endphp
                                            <div class="product-img-container">
                                                <img src="{{ asset($firstPhoto) }}" alt=""
                                                    class="product-img-fixed">
                                            </div>
                                            <div class="product-label">
                                                @if ($product->discount > 0)
                                                    @php
                                                        $newPrice = $product->price - $product->discount;
                                                        $discountPercentage = round(
                                                            ($product->discount / $product->price) * 100,
                                                            2,
                                                        );
                                                    @endphp
                                                    <span class="sale">{{ $discountPercentage }}%</span>
                                                @endif
                                                @if (strtolower($product->condition) === 'new')
                                                    <span class="new">NEW</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="product-body">
                                            @php
                                                $category = DB::table('categories')
                                                    ->where('id', $product->cat_id)
                                                    ->first();
                                                $brand = DB::table('brands')
                                                    ->where('id', $product->brand_id)
                                                    ->first();
                                            @endphp
                                            <p class="product-category">{{ $category->name ?? 'Category' }}</p>
                                            <h3 class="product-name"><a
                                                    href="{{ route('products.show', $product->id) }}">{{ $product->title }}</a>
                                            </h3>
                                            <h4 class="product-price">
                                                @if ($product->discount > 0)
                                                    {{ $newPrice ?? $product->price }} tk
                                                @else
                                                    {{ $product->price }} Tk
                                                @endif
                                                @if ($product->discount > 0)
                                                    <del class="product-old-price">{{ $product->price }} tk</del>
                                                @endif
                                            </h4>
                                            <div class="product-rating">
                                                {{-- @for ($i = 0; $i < 5; $i++)
                                                    <i class="fa fa-star{{ $i < $product->rating ? '' : '-o' }}"></i>
                                                @endfor --}}
                                            </div>
                                            <div class="product-btns">
                                                <button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span
                                                        class="tooltipp">add to wishlist</span></button>
                                                <button class="add-to-compare"><i class="fa fa-exchange"></i><span
                                                        class="tooltipp">add to compare</span></button>
                                                <button class="quick-view"><i class="fa fa-eye"></i><span
                                                        class="tooltipp">quick view</span></button>
                                            </div>
                                        </div>
                                        <div class="add-to-cart">
                                            <button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to
                                                cart</button>
                                        </div>
                                    </div>
                                    <!-- /product -->
                                @endforeach
                            </div>
                            <div id="slick-nav-1" class="products-slick-nav"></div>
                        </div>
                        <!-- /tab -->
                    </div>
                </div>
            </div>
            <!-- Products tab & slick -->
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /SECTION -->

@push('styles')
    <style>
        .product-img-container {
            width: 100%;
            height: 200px;
            /* Adjust the height as needed */
            overflow: hidden;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .product-img-fixed {
            width: 100%;
            height: 100%;
            object-fit: cover;
            /* Ensures the image covers the container */
            object-position: center;
            /* Centers the image within the container */
        }
    </style>
@endpush
