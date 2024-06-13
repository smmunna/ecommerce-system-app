@php
    $categories = DB::table('categories')->get();
@endphp

<div class="col-md-6">
    <div class="header-search">
        <form method="GET" action="{{ route('all_products') }}">
            <select class="input-select" name="category">
                <option value="0">All Categories</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
            <input class="input" name="search" placeholder="Search here" value="{{ request()->input('search') }}">
            <button class="search-btn">Search</button>
        </form>
    </div>
</div>
