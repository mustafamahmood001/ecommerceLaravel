  <!-- Header-->
<header class="bg-dark py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="text-center text-white">
            <h1 class="display-4 fw-bolder">E-commerce Website</h1>
            <p class="lead fw-normal text-white-50 mb-0">Elegant E-commerce Website</p>
        </div>
    </div>
</header>
<form action="{{ route('homes') }}" method="get" enctype="multipart/form-data">
<div class="filter-bar" >
    <div class="row align-items-center" style="justify-content: center;">
        <div class="col-md-1">
            <span class="filter-label">Price:</span>
            <select class="form-select form-select-sm" name="price">
    <option selected disabled>Select</option>
    <option value="Less_than_500">Less than Pkr500</option>
    <option value="between_500_5k">Pkr500-Pkr5000</option>
    <option value="between_5k_10k">Pkr5000-Pkr10000</option>
    <option value="between_10k_pkr30k">Pkr10000-Pkr30000</option>
    <option value="greater_than_30k">More than Pkr30000</option>
</select>

        </div>

        <div class="col-md-1">
            <span class="filter-label">Color:</span>
            <select class="form-select form-select-sm" name="color">
                <option selected disabled>Select</option>
                @foreach(\Config::get('colors') as $value)
                <option value="{{ $value }}">{{ $value }}</option>
    @endforeach
            </select>
        </div>

        <div class="col-md-1">
            <span class="filter-label">Function:</span>
            <select class="form-select form-select-sm" name="function">
            <option selected disabled>Select</option>
                @foreach(\Config::get('function_watch') as $value)
                <option value="{{ $value }}">{{ $value }}</option>
    @endforeach
            </select>
        </div>

        <div class="col-md-1">
            <span class="filter-label">Brand:</span>
            <select class="form-select form-select-sm" name="brand">
                <option selected disabled>Select</option>
   @foreach($brands as $key=>$value)
        <option value="{{ $key }}">{{ $value }}</option>
    @endforeach
            </select>
        </div>
        <div class="col-md-1">
            <span class="filter-label">SortBy:</span>
            <select class="form-select form-select-sm" name="sort_by">
    <option selected disabled>Select</option>
    <option value="Price_Lower_to_Higher">Price Lower to Higher</option>
    <option value="Price_Higher_to_Lower">Price Higher to Lower</option>
    <option value="model_a_z">Model(A-Z)</option>
    <option value="model_z_a">Model(Z-A)</option>
</select>

        </div>

       
    </div>
    <div class="col-md-4 filter-buttons" style="margin-left:47%; margin-top:1%;">
            <button type="submit" class="btn btn-success btn-sm">Search</button>
            <button class="btn btn-warning btn-sm" name="reset">Reset</button>
        </div>
</div>
</form>
<!-- Section-->
<section class="py-5">
    <div class="container px-4 px-lg-5 mt-5">
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
            @foreach($products as $product)
            <div class="col mb-5">
                <div class="card h-100">

                    @if(!empty($product->sale_price) && $product->stock !== 0)
                    <div class="badge bg-dark text-white position-absolute">
                        Sale
                    </div>
                    @elseif($product->stock == 0)
                    <div class="badge bg-danger text-white position-absolute">
                        Out of stock
                    </div>
                    @endif

                    <!-- Product image -->
                    <img class="card-img-top" src="{{ asset('storage/' . $product->image) }}" alt="Image" />

                    <!-- Product details -->
                    <div class="card-body p-4">
                        <div class="text-center">
                            <!-- Product name -->
                            <h5 class="fw-bolder">{{ $product->name }}</h5>

                            <!-- Product price -->
                            @if(!empty($product->sale_price) && $product->sale_price > 0)
                            <span class="text-muted text-decoration-line-through">{{ 'pkr:' . $product->price }}</span>
                            {{ 'pkr:' . $product->sale_price }}
                            @else
                            {{ 'pkr:' . $product->price }}
                            @endif

                        </div>
                    </div>

                    <!-- Product actions -->
                    <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                        <div class="text-center"><a class="btn btn-outline-dark mt-auto"
                                href="{{ route('product_info',['product'=>$product->id]) }}">View
                                product</a></div>
                    </div>
                </div>
            </div>
            @endforeach
           

    </div>
</section>
