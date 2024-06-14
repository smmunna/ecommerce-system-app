@php
    // Fetch the first settings record from the database
    $settings = App\Models\Setting::first();
    $recentCategories = DB::table('categories')->orderBy('created_at', 'desc')->limit(5)->get();

@endphp
<!-- FOOTER -->
<footer id="footer">
    <!-- top footer -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="col-md-3 col-xs-6">
                    <div class="footer">
                        <h3 class="footer-title">About Us</h3>
                        <p>{!! $settings->description !!}</p>
                        <ul class="footer-links">
                            <li><a href="#"><i class="fa fa-map-marker"></i>{{ $settings->address }}</a></li>
                            <li><a href="#"><i class="fa fa-phone"></i>{{ $settings->phone }}</a></li>
                            <li><a href="#"><i class="fa fa-envelope-o"></i>{{ $settings->email }}</a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-md-3 col-xs-6">
                    <div class="footer">
                        <h3 class="footer-title">Categories</h3>
                        <ul class="footer-links">
                            @foreach ($recentCategories as $category)
                                <li><a
                                        href="{{ route('category_products', ['category' => $category->id]) }}">{{ $category->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>


                <div class="clearfix visible-xs"></div>

                <div class="col-md-3 col-xs-6">
                    <div class="footer">
                        <h3 class="footer-title">Information</h3>
                        <ul class="footer-links">
                            <li><a href="#">About Us</a></li>
                            <li><a href="#">Contact Us</a></li>
                            <li><a href="#">Privacy Policy</a></li>
                            <li><a href="#">Orders and Returns</a></li>
                            <li><a href="#">Terms & Conditions</a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-md-3 col-xs-6">
                    <div class="footer">
                        <h3 class="footer-title">Service</h3>
                        <ul class="footer-links">
                            <li><a href="#">My Account</a></li>
                            <li><a href="#">View Cart</a></li>
                            <li><a href="#">Wishlist</a></li>
                            <li><a href="#">Track My Order</a></li>
                            <li><a href="#">Help</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /top footer -->

    <!-- bottom footer -->
    <div id="bottom-footer" class="section">
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="col-md-12 text-center">
                    <ul class="footer-payments">
                        <li><a href="#"><i class="fa fa-cc-visa" style="background-color: white"></i></a></li>
                        <li><a href="#"><i class="fa fa-credit-card" style="background-color: white"></i></a></li>
                        <li><a href="#"><i class="fa fa-cc-paypal" style="background-color: white"></i></a></li>
                        <li><a href="#"><i class="fa fa-cc-mastercard" style="background-color: white"></i></a>
                        </li>
                        <li><a href="#"><i class="fa fa-cc-discover" style="background-color: white"></i></a></li>
                        <li><a href="#"><i class="fa fa-cc-amex" style="background-color: white"></i></a></li>
                    </ul>
                    <span class="copyright">
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        Copyright &copy;
                        <script>
                            document.write(new Date().getFullYear());
                        </script> All rights reserved | Developed by by <a
                            href="https://www.techzaint.com" target="_blank" style="color: white">Techzaint Team</a> <i
                            class="fa fa-heart-o" aria-hidden="true"></i>
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    </span>
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /bottom footer -->
</footer>
<!-- /FOOTER -->
