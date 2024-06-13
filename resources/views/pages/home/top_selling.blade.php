@php
    $recentProducts = DB::table('products')->orderBy('created_at', 'desc')->take(3)->get();
    $recentProducts2 = DB::table('products')
        ->orderBy('created_at', 'desc')
        ->skip(3) // Skip the first 3 products
        ->take(3) // Take the next 3 products
        ->get();

    $lessPriceProducts = DB::table('products')
        ->where('price', '<=', 5000) // Filter by price less than or equal to 5000
        ->orderBy('created_at', 'desc') // Order by creation date in descending order
        ->take(3) // Limit to the first 3 results
        ->get();

    $lessPriceProducts2 = DB::table('products')
        ->where('price', '<=', 5000) // Filter by price less than or equal to 5000
        ->orderBy('created_at', 'desc') // Order by creation date in descending order
        ->skip(3) // Skip the first 3 products
        ->take(3) // Limit to the first 3 results
        ->get();

    $morePriceProducts = DB::table('products')
        ->where('price', '>=', 5000) // Filter by price less than or equal to 5000
        ->orderBy('created_at', 'desc') // Order by creation date in descending order
        ->take(3) // Limit to the first 3 results
        ->get();

    $morePriceProducts2 = DB::table('products')
        ->where('price', '>=', 5000) // Filter by price less than or equal to 5000
        ->orderBy('created_at', 'desc') // Order by creation date in descending order
        ->skip(3) // Skip the first 3 products
        ->take(3) // Limit to the first 3 results
        ->get();

@endphp
<!-- SECTION -->
<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <div class="col-md-4 col-xs-6">
                <div class="section-title">
                    <h4 class="title">Recently Added</h4>
                    <div class="section-nav">
                        <div id="slick-nav-3" class="products-slick-nav"></div>
                    </div>
                </div>

                <div class="products-widget-slick" data-nav="#slick-nav-3">
                    {{-- First 3 recent Products --}}
                    <div>
                        @if ($recentProducts->isEmpty())
                            <p>No products available within this range.</p>
                        @else
                            @foreach ($recentProducts2 as $product)
                                <!-- product widget -->
                                <div class="product-widget">
                                    @php
                                        $photos = json_decode($product->photo);
                                        $firstPhoto = $photos ? $photos[0] : 'default.jpg';
                                    @endphp
                                    <div class="product-img">
                                        <img src="{{ asset($firstPhoto) }}" alt="">
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
                                        <p class="product-category">{{ $category->name }}</p>
                                        <h3 class="product-name"><a
                                                href="{{ route('product.details', $product->slug) }}">{{ $product->title }}</a>
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
                                    </div>
                                </div>
                                <!-- /product widget -->
                            @endforeach
                        @endif
                    </div>

                    {{-- Next 3 recent products --}}
                    <div>
                        @if ($recentProducts2->isEmpty())
                            <p>No products available within this range.</p>
                        @else
                            @foreach ($recentProducts2 as $product)
                                <!-- product widget -->
                                <div class="product-widget">
                                    @php
                                        $photos = json_decode($product->photo);
                                        $firstPhoto = $photos ? $photos[0] : 'default.jpg';
                                    @endphp
                                    <div class="product-img">
                                        <img src="{{ asset($firstPhoto) }}" alt="">
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
                                        <p class="product-category">{{ $category->name }}</p>
                                        <h3 class="product-name"><a
                                                href="{{ route('product.details', $product->slug) }}">{{ $product->title }}</a>
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
                                    </div>
                                </div>
                                <!-- /product widget -->
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-xs-6">
                <div class="section-title">
                    <h4 class="title">Price < 5000৳</h4>
                            <div class="section-nav">
                                <div id="slick-nav-4" class="products-slick-nav"></div>
                            </div>
                </div>

                <div class="products-widget-slick" data-nav="#slick-nav-4">
                    <div>
                        <!-- product widget -->
                        <div>
                            @if ($lessPriceProducts->isEmpty())
                                <p>No products available within this range.</p>
                            @else
                                @foreach ($lessPriceProducts as $product)
                                    <!-- product widget -->
                                    <div class="product-widget">
                                        @php
                                            $photos = json_decode($product->photo);
                                            $firstPhoto = $photos ? $photos[0] : 'default.jpg';
                                        @endphp
                                        <div class="product-img">
                                            <img src="{{ asset($firstPhoto) }}" alt="">
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
                                            <p class="product-category">{{ $category->name }}</p>
                                            <h3 class="product-name"><a
                                                    href="{{ route('product.details', $product->slug) }}">{{ $product->title }}</a>
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
                                        </div>
                                    </div>
                                    <!-- /product widget -->
                                @endforeach
                            @endif
                        </div>
                        <!-- /product widget -->
                    </div>

                    <div>
                        <!-- product widget -->
                        <div>
                            @if ($lessPriceProducts2->isEmpty())
                                <p>No products available within this range.</p>
                            @else
                                @foreach ($lessPriceProducts as $product)
                                    <!-- product widget -->
                                    <div class="product-widget">
                                        @php
                                            $photos = json_decode($product->photo);
                                            $firstPhoto = $photos ? $photos[0] : 'default.jpg';
                                        @endphp
                                        <div class="product-img">
                                            <img src="{{ asset($firstPhoto) }}" alt="">
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
                                            <p class="product-category">{{ $category->name }}</p>
                                            <h3 class="product-name"><a
                                                    href="{{ route('product.details', $product->slug) }}">{{ $product->title }}</a>
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
                                        </div>
                                    </div>
                                    <!-- /product widget -->
                                @endforeach
                            @endif
                        </div>
                        <!-- /product widget -->
                    </div>
                </div>
            </div>

            <div class="clearfix visible-sm visible-xs"></div>

            <div class="col-md-4 col-xs-6">
                <div class="section-title">
                    <h4 class="title">Price > 5000৳</h4>
                    <div class="section-nav">
                        <div id="slick-nav-5" class="products-slick-nav"></div>
                    </div>
                </div>

                <div class="products-widget-slick" data-nav="#slick-nav-5">
                    <div>
                        <!-- product widget -->
                        <div>
                            @if ($morePriceProducts->isEmpty())
                                <p>No products available within this range.</p>
                            @else
                                @foreach ($morePriceProducts as $product)
                                    <!-- product widget -->
                                    <div class="product-widget">
                                        @php
                                            $photos = json_decode($product->photo);
                                            $firstPhoto = $photos ? $photos[0] : 'default.jpg';
                                        @endphp
                                        <div class="product-img">
                                            <img src="{{ asset($firstPhoto) }}" alt="">
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
                                            <p class="product-category">{{ $category->name }}</p>
                                            <h3 class="product-name"><a
                                                    href="{{ route('product.details', $product->slug) }}">{{ $product->title }}</a>
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
                                        </div>
                                    </div>
                                    <!-- /product widget -->
                                @endforeach
                            @endif
                        </div>
                        <!-- /product widget -->
                    </div>

                    <div>
                        <!-- product widget -->
                        <div>
                            @if ($morePriceProducts2->isEmpty())
                                <p>No products available within this range.</p>
                            @else
                                @foreach ($morePriceProducts2 as $product)
                                    <!-- product widget -->
                                    <div class="product-widget">
                                        @php
                                            $photos = json_decode($product->photo);
                                            $firstPhoto = $photos ? $photos[0] : 'default.jpg';
                                        @endphp
                                        <div class="product-img">
                                            <img src="{{ asset($firstPhoto) }}" alt="">
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
                                            <p class="product-category">{{ $category->name }}</p>
                                            <h3 class="product-name"><a
                                                    href="{{ route('product.details', $product->slug) }}">{{ $product->title }}</a>
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
                                        </div>
                                    </div>
                                    <!-- /product widget -->
                                @endforeach
                            @endif
                        </div>
                        <!-- /product widget -->
                    </div>
                </div>
            </div>

        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /SECTION -->
