<!-- SECTION -->
<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">

            <!-- section title -->
            <div class="col-md-12">
                <div class="section-title">
                    <h3 class="title">Featured Products</h3>
                    <div class="section-nav">
                        <ul class="section-tab-nav tab-nav">
                            <li class="active"><a data-toggle="tab" href="#tab2">All Products</a></li>
                            {{-- <li><a data-toggle="tab" href="#tab2">Smartphones</a></li>
                            <li><a data-toggle="tab" href="#tab2">Cameras</a></li>
                            <li><a data-toggle="tab" href="#tab2">Accessories</a></li> --}}
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /section title -->

            <!-- Products tab & slick -->
            <div class="col-md-12">
                <div class="row">
                    <div class="products-tabs">
                        <!-- tab -->
                        <div id="tab2" class="tab-pane fade in active">
                            <div class="products-slick" data-nav="#slick-nav-2">
                                @php
                                    use Illuminate\Support\Facades\DB;
                                    // Fetch products with condition 'is_featured'
                                    $products = DB::table('products')
                                        ->where('is_featured', 'on')
                                        ->orderBy('created_at', 'desc')
                                        ->get();
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
                                            <div class="product-rating">
                                                @php
                                                    // Fetch average rating for the product
                                                    $averageRating = DB::table('reviews')
                                                        ->where('product_id', $product->id)
                                                        ->avg('rating');
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
                                            <div class="product-btns">
                                                <button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span
                                                        class="tooltipp">add to wishlist</span></button>
                                                <button class="add-to-compare"><i class="fa fa-exchange"></i><span
                                                        class="tooltipp">add to compare</span></button>
                                                <button class="quick-view"><a
                                                        href="{{ route('product.details', $product->slug) }}"><i
                                                            class="fa fa-eye"></i><span class="tooltipp">quick
                                                            view</span></a></button>
                                            </div>
                                        </div>
                                        <!--Form for add to cart  -->
                                        <form action="{{ route('addToCart') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="size" value="None">
                                            <input type="hidden" name="color" value="None">
                                            <input type="hidden" name="quantity" value="1">
                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                            <div class="add-to-cart">
                                                @if ($product->stock > 0)
                                                    @if (Auth::check())
                                                        <button type="submit" class="add-to-cart-btn">
                                                            <i class="fa fa-shopping-cart"></i> add to cart
                                                        </button>
                                                    @else
                                                        <a href="{{ route('login') }}">
                                                            <button class="add-to-cart-btn">
                                                                <i class="fa fa-shopping-cart"></i> add to cart
                                                            </button>
                                                        </a>
                                                    @endif
                                                @else
                                                    <button class="add-to-cart-btn" disabled>
                                                        <i class="fa fa-shopping-cart"></i> Out of Stock
                                                    </button>
                                                @endif
                                            </div>
                                        </form>
                                    </div>
                                    <!-- /product -->
                                @endforeach
                            </div>
                            <div id="slick-nav-2" class="products-slick-nav"></div>
                        </div>
                        <!-- /tab -->
                    </div>
                </div>
            </div>
            <!-- /Products tab & slick -->
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /SECTION -->
