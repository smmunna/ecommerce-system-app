@php
    $recentProducts = DB::table('products')->orderBy('created_at', 'desc')->take(3)->get();
    $recentProducts2 = DB::table('products')
        ->orderBy('created_at', 'desc')
        ->skip(3) // Skip the first 3 products
        ->take(3) // Take the next 3 products
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
                    <h4 class="title">Recent Added</h4>
                    <div class="section-nav">
                        <div id="slick-nav-3" class="products-slick-nav"></div>
                    </div>
                </div>

                <div class="products-widget-slick" data-nav="#slick-nav-3">
                    {{-- First 3 recent Products --}}
                    <div>
                        @foreach ($recentProducts as $product)
                            <!-- product widget -->
                            <div class="product-widget">
                                @php
                                    $photos = json_decode($product->photo);
                                    $firstPhoto = $photos ? $photos[0] : 'default.jpg';
                                @endphp
                                <div class="product-img">
                                    <img src={{ asset($firstPhoto) }} alt="">
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
                                    <h3 class="product-name"><a href="#">{{ $product->title }}</a></h3>
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
                    </div>
                    {{-- Next 3 recent products --}}
                    <div>
                        @foreach ($recentProducts2 as $product)
                            <!-- product widget -->
                            <div class="product-widget">
                                @php
                                    $photos = json_decode($product->photo);
                                    $firstPhoto = $photos ? $photos[0] : 'default.jpg';
                                @endphp
                                <div class="product-img">
                                    <img src={{ asset($firstPhoto) }} alt="">
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
                                    <h3 class="product-name"><a href="#">{{ $product->title }}</a></h3>
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
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-xs-6">
                <div class="section-title">
                    <h4 class="title">Top selling</h4>
                    <div class="section-nav">
                        <div id="slick-nav-4" class="products-slick-nav"></div>
                    </div>
                </div>

                <div class="products-widget-slick" data-nav="#slick-nav-4">
                    <div>
                        <!-- product widget -->
                        <div class="product-widget">
                            <div class="product-img">
                                <img src={{ asset('/template_files/img/product04.png') }} alt="">
                            </div>
                            <div class="product-body">
                                <p class="product-category">Category</p>
                                <h3 class="product-name"><a href="#">product name goes here</a></h3>
                                <h4 class="product-price">$980.00 <del class="product-old-price">$990.00</del></h4>
                            </div>
                        </div>
                        <!-- /product widget -->

                        <!-- product widget -->
                        <div class="product-widget">
                            <div class="product-img">
                                <img src={{ asset('/template_files/img/product05.png') }} alt="">
                            </div>
                            <div class="product-body">
                                <p class="product-category">Category</p>
                                <h3 class="product-name"><a href="#">product name goes here</a></h3>
                                <h4 class="product-price">$980.00 <del class="product-old-price">$990.00</del></h4>
                            </div>
                        </div>
                        <!-- /product widget -->

                        <!-- product widget -->
                        <div class="product-widget">
                            <div class="product-img">
                                <img src={{ asset('/template_files/img/product06.png') }} alt="">
                            </div>
                            <div class="product-body">
                                <p class="product-category">Category</p>
                                <h3 class="product-name"><a href="#">product name goes here</a></h3>
                                <h4 class="product-price">$980.00 <del class="product-old-price">$990.00</del></h4>
                            </div>
                        </div>
                        <!-- product widget -->
                    </div>

                    <div>
                        <!-- product widget -->
                        <div class="product-widget">
                            <div class="product-img">
                                <img src={{ asset('/template_files/img/product07.png') }} alt="">
                            </div>
                            <div class="product-body">
                                <p class="product-category">Category</p>
                                <h3 class="product-name"><a href="#">product name goes here</a></h3>
                                <h4 class="product-price">$980.00 <del class="product-old-price">$990.00</del></h4>
                            </div>
                        </div>
                        <!-- /product widget -->

                        <!-- product widget -->
                        <div class="product-widget">
                            <div class="product-img">
                                <img src={{ asset('/template_files/img/product08.png') }} alt="">
                            </div>
                            <div class="product-body">
                                <p class="product-category">Category</p>
                                <h3 class="product-name"><a href="#">product name goes here</a></h3>
                                <h4 class="product-price">$980.00 <del class="product-old-price">$990.00</del></h4>
                            </div>
                        </div>
                        <!-- /product widget -->

                        <!-- product widget -->
                        <div class="product-widget">
                            <div class="product-img">
                                <img src={{ asset('/template_files/img/product09.png') }} alt="">
                            </div>
                            <div class="product-body">
                                <p class="product-category">Category</p>
                                <h3 class="product-name"><a href="#">product name goes here</a></h3>
                                <h4 class="product-price">$980.00 <del class="product-old-price">$990.00</del></h4>
                            </div>
                        </div>
                        <!-- product widget -->
                    </div>
                </div>
            </div>

            <div class="clearfix visible-sm visible-xs"></div>

            <div class="col-md-4 col-xs-6">
                <div class="section-title">
                    <h4 class="title">Top selling</h4>
                    <div class="section-nav">
                        <div id="slick-nav-5" class="products-slick-nav"></div>
                    </div>
                </div>

                <div class="products-widget-slick" data-nav="#slick-nav-5">
                    <div>
                        <!-- product widget -->
                        <div class="product-widget">
                            <div class="product-img">
                                <img src={{ asset('/template_files/img/product01.png') }} alt="">
                            </div>
                            <div class="product-body">
                                <p class="product-category">Category</p>
                                <h3 class="product-name"><a href="#">product name goes here</a></h3>
                                <h4 class="product-price">$980.00 <del class="product-old-price">$990.00</del></h4>
                            </div>
                        </div>
                        <!-- /product widget -->

                        <!-- product widget -->
                        <div class="product-widget">
                            <div class="product-img">
                                <img src={{ asset('/template_files/img/product02.png') }} alt="">
                            </div>
                            <div class="product-body">
                                <p class="product-category">Category</p>
                                <h3 class="product-name"><a href="#">product name goes here</a></h3>
                                <h4 class="product-price">$980.00 <del class="product-old-price">$990.00</del></h4>
                            </div>
                        </div>
                        <!-- /product widget -->

                        <!-- product widget -->
                        <div class="product-widget">
                            <div class="product-img">
                                <img src={{ asset('/template_files/img/product03.png') }} alt="">
                            </div>
                            <div class="product-body">
                                <p class="product-category">Category</p>
                                <h3 class="product-name"><a href="#">product name goes here</a></h3>
                                <h4 class="product-price">$980.00 <del class="product-old-price">$990.00</del></h4>
                            </div>
                        </div>
                        <!-- product widget -->
                    </div>

                    <div>
                        <!-- product widget -->
                        <div class="product-widget">
                            <div class="product-img">
                                <img src={{ asset('/template_files/img/product04.png') }} alt="">
                            </div>
                            <div class="product-body">
                                <p class="product-category">Category</p>
                                <h3 class="product-name"><a href="#">product name goes here</a></h3>
                                <h4 class="product-price">$980.00 <del class="product-old-price">$990.00</del></h4>
                            </div>
                        </div>
                        <!-- /product widget -->

                        <!-- product widget -->
                        <div class="product-widget">
                            <div class="product-img">
                                <img src={{ asset('/template_files/img/product05.png') }} alt="">
                            </div>
                            <div class="product-body">
                                <p class="product-category">Category</p>
                                <h3 class="product-name"><a href="#">product name goes here</a></h3>
                                <h4 class="product-price">$980.00 <del class="product-old-price">$990.00</del></h4>
                            </div>
                        </div>
                        <!-- /product widget -->

                        <!-- product widget -->
                        <div class="product-widget">
                            <div class="product-img">
                                <img src={{ asset('/template_files/img/product06.png') }} alt="">
                            </div>
                            <div class="product-body">
                                <p class="product-category">Category</p>
                                <h3 class="product-name"><a href="#">product name goes here</a></h3>
                                <h4 class="product-price">$980.00 <del class="product-old-price">$990.00</del></h4>
                            </div>
                        </div>
                        <!-- product widget -->
                    </div>
                </div>
            </div>

        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /SECTION -->
