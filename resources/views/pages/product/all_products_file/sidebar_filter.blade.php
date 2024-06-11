<form id="filterForm" method="GET" action="{{ route('all_products') }}">
    <div id="aside" class="col-md-3">
        <!-- aside Widget -->
        <div class="aside">
            <h3 class="aside-title">Categories</h3>
            <div class="checkbox-filter">
                @php
                    // Fetch categories and their product counts
                    $categories = DB::table('categories')
                        ->leftJoin('products', 'categories.id', '=', 'products.cat_id')
                        ->select('categories.id', 'categories.name', DB::raw('COUNT(products.id) as product_count'))
                        ->groupBy('categories.id', 'categories.name')
                        ->get();
                @endphp

                @foreach ($categories as $category)
                    <div class="input-checkbox">
                        <input type="checkbox" id="category-{{ $category->id }}" name="categories[]"
                            value="{{ $category->id }}"
                            {{ in_array($category->id, request('categories', [])) ? 'checked' : '' }}
                            onchange="document.getElementById('filterForm').submit();">
                        <label for="category-{{ $category->id }}">
                            <span></span>
                            {{ $category->name }}
                            <small>({{ $category->product_count }})</small>
                        </label>
                    </div>
                @endforeach
            </div>
        </div>
        <!-- /aside Widget -->


        <!-- aside Widget -->
        <div class="aside">
            <h3 class="aside-title">Price</h3>
            <div class="price-filter">
                <div class="input-number price-min">
                    <input name="price_min" type="number" placeholder="Min">
                </div>
                <span>-</span>
                <div class="input-number price-max">
                    <input name="price_max" type="number" placeholder="Max">
                </div>
                <button type="submit">Filter</button>
            </div>

        </div>
        <!-- /aside Widget -->



        <!-- aside Widget -->
        <div class="aside">
            <h3 class="aside-title">Brand</h3>
            <div class="checkbox-filter">
                @php
                    // Fetch brands and their product counts
                    $brands = DB::table('brands')
                        ->leftJoin('products', 'brands.id', '=', 'products.brand_id')
                        ->select('brands.id', 'brands.name', DB::raw('COUNT(products.id) as product_count'))
                        ->groupBy('brands.id', 'brands.name')
                        ->get();
                @endphp

                @foreach ($brands as $brand)
                    <div class="input-checkbox">
                        <input type="checkbox" id="brand-{{ $brand->id }}" name="brands[]"
                            value="{{ $brand->id }}"
                            {{ in_array($brand->id, request('brands', [])) ? 'checked' : '' }}
                            onchange="document.getElementById('filterForm').submit();">
                        <label for="brand-{{ $brand->id }}">
                            <span></span>
                            {{ $brand->name }}
                            <small>({{ $brand->product_count }})</small>
                        </label>
                    </div>
                @endforeach
            </div>
        </div>
        <!-- /aside Widget -->
</form>

<!-- aside Widget -->
<div class="aside">
    <h3 class="aside-title">Top selling</h3>
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
</div>
<!-- /aside Widget -->
</div>
