<!-- SECTION -->
<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <!-- Product main img -->
            <div class="col-md-5 col-md-push-2">
                <div id="product-main-img">
                    @php
                        $photos = json_decode($product->photo);
                    @endphp
                    @foreach ($photos as $photo)
                        <div class="product-preview">
                            <img src="{{ asset($photo) }}" alt="{{ $product->title }}">
                        </div>
                    @endforeach
                </div>
            </div>
            <!-- /Product main img -->

            <!-- Product thumb imgs -->
            <div class="col-md-2 col-md-pull-5">
                <div id="product-imgs">
                    @php
                        $photos = json_decode($product->photo);
                    @endphp
                    @foreach ($photos as $photo)
                        <div class="product-preview">
                            <img src="{{ asset($photo) }}" alt="{{ $product->title }}">
                        </div>
                    @endforeach
                </div>
            </div>
            <!-- /Product thumb imgs -->

            <!-- Product details -->
            <div class="col-md-5">
                <div class="product-details">
                    <h2 class="product-name">{{ $product->title }}</h2>
                    <div>
                        <div class="product-rating">
                            @php
                                // Fetch average rating for the product
                                $averageRating = DB::table('reviews')
                                    ->where('product_id', $product->id)
                                    ->avg('rating');
                                $totalReviews = DB::table('reviews')
                                    ->where('product_id', $product->id)
                                    ->count();
                            @endphp
                            @for ($i = 1; $i <= 5; $i++)
                                @if ($i <= floor($averageRating))
                                    <i class="fa fa-star"></i>
                                @elseif ($i <= ceil($averageRating))
                                    <i class="fa fa-star-half-o"></i>
                                @else
                                    <i class="fa fa-star-o"></i>
                                @endif
                            @endfor
                        </div>
                        <a class="review-link">{{ $totalReviews }} Review(s)</a>
                    </div>
                    <div>
                        <h3 class="product-price">
                            @php
                                $newPrice = $product->price - $product->discount;
                                $discountPercentage = round(($product->discount / $product->price) * 100, 2);
                            @endphp
                            @if ($product->discount > 0)
                                {{ $newPrice ?? $product->price }} ৳
                            @else
                                {{ $product->price }} ৳
                            @endif
                            @if ($product->discount > 0)
                                <del class="product-old-price">{{ $product->price }} ৳</del>
                            @endif
                        </h3>
                        @if ($product->stock > 0)
                            <span class="product-available">In Stock
                                <span style="font-size: 18px; background-color: green; padding: 5px; color: white;">
                                    {{ $product->stock }}
                                </span>
                            </span>
                        @else
                            <span class="product-available">Out of Stock</span>
                        @endif
                    </div>
                    <p>{!! $product->summary !!}</p>

                    <!--Form for add to cart  -->
                    @auth
                        <!-- Form for add to cart -->
                        <form action="{{ route('addToCart') }}" method="POST">
                            @csrf
                            <div class="product-options">
                                <label>
                                    Size
                                    <select class="input-select" name="size">
                                        @php
                                            $sizes = DB::table('sizes')->orderBy('created_at', 'desc')->get();
                                        @endphp
                                        @foreach ($sizes as $size)
                                            <option value="{{ $size->name }}">{{ $size->name }}</option>
                                        @endforeach
                                    </select>
                                </label>
                                <label>
                                    Color
                                    <select class="input-select" name="color">
                                        <option value="None">None</option>
                                        <option value="Red">Red</option>
                                        <option value="Black">Black</option>
                                        <option value="Blue">Blue</option>
                                        <option value="Green">Green</option>
                                        <option value="Yellow">Yellow</option>
                                    </select>
                                </label>
                            </div>
                            <!-- Taking product id  -->
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="amount" value="{{ $newPrice }}">

                            <div class="add-to-cart">
                                <div class="qty-label">
                                    Qty
                                    <div class="input-number">
                                        <input type="number" value="1" name="quantity">
                                        <span class="qty-up">+</span>
                                        <span class="qty-down">-</span>
                                    </div>
                                </div>
                                @if ($product->stock > 0)
                                    <button type="submit" class="add-to-cart-btn">
                                        <i class="fa fa-shopping-cart"></i> add to cart
                                    </button>
                                @else
                                    <button class="add-to-cart-btn" disabled>
                                        <i class="fa fa-shopping-cart"></i> Out of Stock
                                    </button>
                                @endif
                            </div>
                        </form>
                    @else
                        <!-- Prompt to login if not authenticated -->
                        <div class="product-options">
                            <label>
                                Size
                                <select class="input-select" name="size">
                                    @php
                                        $sizes = DB::table('sizes')->orderBy('created_at', 'desc')->get();
                                    @endphp
                                    @foreach ($sizes as $size)
                                        <option value="{{ $size->name }}">{{ $size->name }}</option>
                                    @endforeach
                                </select>
                            </label>
                            <label>
                                Color
                                <select class="input-select" name="color">
                                    <option value="None">None</option>
                                    <option value="Red">Red</option>
                                    <option value="Black">Black</option>
                                    <option value="Blue">Blue</option>
                                    <option value="Green">Green</option>
                                    <option value="Yellow">Yellow</option>
                                </select>
                            </label>
                        </div>
                        <!-- Taking product id  -->
                        <input type="hidden" name="product_id" value="{{ $product->id }}">

                        <div class="add-to-cart">
                            <div class="qty-label">
                                Qty
                                <div class="input-number">
                                    <input type="number" value="1" name="quantity">
                                    <span class="qty-up">+</span>
                                    <span class="qty-down">-</span>
                                </div>
                            </div>
                            @if ($product->stock > 0)
                                <a href="{{ route('login') }}"><button class="add-to-cart-btn">
                                        <i class="fa fa-shopping-cart"></i> add to cart
                                    </button></a>
                            @else
                                <button class="add-to-cart-btn" disabled>
                                    <i class="fa fa-shopping-cart"></i> Out of Stock
                                </button>
                            @endif
                        </div>
                    @endauth


                    <ul class="product-btns">
                        <li><a href="#"><i class="fa fa-heart-o"></i> add to wishlist</a></li>
                        <li><a href="#"><i class="fa fa-exchange"></i> add to compare</a></li>
                    </ul>

                    <ul class="product-links">
                        <li>Category:</li>
                        <li><a href="#">{{ $product->category_name }}</a></li>
                        <li><a href="#">{{ $product->brand_name }}</a></li>
                    </ul>

                    <ul class="product-links">
                        <li>Share:</li>
                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                        <li><a href="#"><i class="fa fa-envelope"></i></a></li>
                    </ul>
                </div>
            </div>
            <!-- /Product details -->

            <!-- Product tab -->
            <div class="col-md-12">
                <div id="product-tab">
                    <!-- product tab nav -->
                    <ul class="tab-nav">
                        <li class="active"><a data-toggle="tab" href="#tab1">Description</a></li>
                        <li><a data-toggle="tab" href="#tab2">Details</a></li>
                        @php
                            $totalReviews = DB::table('reviews')
                                ->where('product_id', $product->id)
                                ->count();
                        @endphp
                        <li><a data-toggle="tab" href="#tab3">Reviews ({{ $totalReviews }})</a></li>
                    </ul>
                    <!-- /product tab nav -->

                    <!-- product tab content -->
                    <div class="tab-content">
                        <!-- tab1  -->
                        <div id="tab1" class="tab-pane fade in active">
                            <div class="row">
                                <div class="col-md-12">
                                    <p>{!! $product->description !!}</p>
                                </div>
                            </div>
                        </div>
                        <!-- /tab1  -->

                        <!-- tab2  -->
                        <div id="tab2" class="tab-pane fade in">
                            <div class="row">
                                <div class="col-md-12">
                                    <p>{!! $product->summary !!}</p>
                                </div>
                            </div>
                        </div>
                        <!-- /tab2  -->

                        <!-- tab3  -->
                        <div id="tab3" class="tab-pane fade in">

                            @include('pages.product.reviews.review', ['product_id' => $product->id])

                        </div>
                    </div>
                    <!-- /tab3  -->
                </div>
                <!-- /product tab content  -->
            </div>
        </div>
        <!-- /product tab -->
    </div>
    <!-- /row -->
</div>
<!-- /container -->
</div>
<!-- /SECTION -->
