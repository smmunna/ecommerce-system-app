<div class="row">
    @php
        // Fetch paginated reviews for the product with user names
        $reviews = DB::table('reviews')
            ->join('users', 'reviews.email', '=', 'users.email')
            ->where('reviews.product_id', $product->id)
            ->select('reviews.*', 'users.name as user_name')
            ->paginate(3);
        // Calculate average rating and star counts
        $ratingSummary = DB::table('reviews')
            ->select(
                DB::raw('AVG(rating) as avg_rating'),
                DB::raw('SUM(rating = 5) as five_star_count'),
                DB::raw('SUM(rating = 4) as four_star_count'),
                DB::raw('SUM(rating = 3) as three_star_count'),
                DB::raw('SUM(rating = 2) as two_star_count'),
                DB::raw('SUM(rating = 1) as one_star_count'),
            )
            ->where('product_id', $product->id)
            ->first();
    @endphp
    <!-- Rating -->
    <div class="col-md-3">
        <div id="rating">
            <div class="rating-avg">
                <span>{{ number_format($ratingSummary->avg_rating, 1) }}</span>
                <div class="rating-stars">
                    @for ($i = 1; $i <= 5; $i++)
                        <i class="fa fa-star{{ $i <= round($ratingSummary->avg_rating) ? '' : '-o' }}"></i>
                    @endfor
                </div>
            </div>
            <ul class="rating">
                @php
                    $totalReviews = $reviews->total();
                @endphp
                <li>
                    <div class="rating-stars">
                        @for ($i = 0; $i < 5; $i++)
                            <i class="fa fa-star"></i>
                        @endfor
                    </div>
                    <div class="rating-progress">
                        <div
                            style="width: {{ $totalReviews > 0 ? ($ratingSummary->five_star_count / $totalReviews) * 100 : 0 }}%;">
                        </div>
                    </div>
                    <span class="sum">{{ $ratingSummary->five_star_count }}</span>
                </li>
                <li>
                    <div class="rating-stars">
                        @for ($i = 0; $i < 4; $i++)
                            <i class="fa fa-star"></i>
                        @endfor
                        <i class="fa fa-star-o"></i>
                    </div>
                    <div class="rating-progress">
                        <div
                            style="width: {{ $totalReviews > 0 ? ($ratingSummary->four_star_count / $totalReviews) * 100 : 0 }}%;">
                        </div>
                    </div>
                    <span class="sum">{{ $ratingSummary->four_star_count }}</span>
                </li>
                <li>
                    <div class="rating-stars">
                        @for ($i = 0; $i < 3; $i++)
                            <i class="fa fa-star"></i>
                        @endfor
                        <i class="fa fa-star-o"></i>
                        <i class="fa fa-star-o"></i>
                    </div>
                    <div class="rating-progress">
                        <div
                            style="width: {{ $totalReviews > 0 ? ($ratingSummary->three_star_count / $totalReviews) * 100 : 0 }}%;">
                        </div>
                    </div>
                    <span class="sum">{{ $ratingSummary->three_star_count }}</span>
                </li>
                <li>
                    <div class="rating-stars">
                        @for ($i = 0; $i < 2; $i++)
                            <i class="fa fa-star"></i>
                        @endfor
                        @for ($i = 0; $i < 3; $i++)
                            <i class="fa fa-star-o"></i>
                        @endfor
                    </div>
                    <div class="rating-progress">
                        <div
                            style="width: {{ $totalReviews > 0 ? ($ratingSummary->two_star_count / $totalReviews) * 100 : 0 }}%;">
                        </div>
                    </div>
                    <span class="sum">{{ $ratingSummary->two_star_count }}</span>
                </li>
                <li>
                    <div class="rating-stars">
                        <i class="fa fa-star"></i>
                        @for ($i = 0; $i < 4; $i++)
                            <i class="fa fa-star-o"></i>
                        @endfor
                    </div>
                    <div class="rating-progress">
                        <div
                            style="width: {{ $totalReviews > 0 ? ($ratingSummary->one_star_count / $totalReviews) * 100 : 0 }}%;">
                        </div>
                    </div>
                    <span class="sum">{{ $ratingSummary->one_star_count }}</span>
                </li>
            </ul>
        </div>
    </div>
    <!-- /Rating -->

    <!-- Reviews -->
    <div class="col-md-6">
        <div id="reviews">
            <ul class="reviews">
                @forelse ($reviews as $review)
                    <li>
                        <div class="review-heading">
                            <h5 class="name">{{ $review->user_name }}</h5>
                            <h5 class="name">{{ $review->email }}</h5>
                            <p class="date">{{ \Carbon\Carbon::parse($review->created_at)->format('d M Y, h:i A') }}
                            </p>
                            <div class="review-rating">
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= $review->rating)
                                        <i class="fa fa-star"></i>
                                    @else
                                        <i class="fa fa-star-o empty"></i>
                                    @endif
                                @endfor
                            </div>
                        </div>
                        <div class="review-body">
                            <p>{{ $review->review }}</p>
                        </div>
                    </li>
                @empty
                    <li>No reviews found for this product.</li>
                @endforelse
            </ul>
            <div>
                {{-- Pagination logic can be added here if needed --}}
                {{ $reviews->links() }}
            </div>
        </div>
    </div>
    <!-- /Reviews -->


    <!-- Review Form -->
    <div class="col-md-3">
        <div id="review-form">
            <form class="review-form" method="POST" action="{{ route('reviews.store') }}">
                @csrf
                <input class="input" type="text" value="{{ auth()->user()->name }}" placeholder="Your Name"
                    disabled>
                <input class="input" type="email" name="email" value="{{ auth()->user()->email }}"
                    placeholder="Your Email" readonly>
                <input class="input" type="hidden" name="product_id" value="{{ $product->id }}">
                <textarea class="input" name="review" placeholder="Your Review"></textarea>
                <div class="input-rating">
                    <span>Your Rating: </span>
                    <div class="stars">
                        <input id="star5" name="rating" value="5" type="radio"><label
                            for="star5"></label>
                        <input id="star4" name="rating" value="4" type="radio"><label
                            for="star4"></label>
                        <input id="star3" name="rating" value="3" type="radio"><label
                            for="star3"></label>
                        <input id="star2" name="rating" value="2" type="radio"><label
                            for="star2"></label>
                        <input id="star1" name="rating" value="1" type="radio"><label
                            for="star1"></label>
                    </div>
                </div>
                @if (Auth::check())
                    <button class="primary-btn">Submit</button>
                @else
                    <a href="{{ route('login') }}" class="primary-btn">Login</a>
                @endif
            </form>
        </div>
    </div>
    <!-- /Review Form -->
