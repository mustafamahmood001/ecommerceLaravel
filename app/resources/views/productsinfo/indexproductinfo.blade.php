     @include('layout_start_userPage')
     
     <section class="py-5">
            <div class="container px-4 px-lg-5 my-5">
                <div class="row gx-4 gx-lg-5 align-items-center">
                    <div class="col-md-6"><img class="card-img-top mb-5 mb-md-0" src="{{ asset('storage/' . $product->image) }}" alt="Image" /></div>
                    <div class="col-md-6">
                        <div class="small mb-1">{{$product->product_code}}</div>
                        <h1 class="display-5 fw-bolder">{{$product->name}}</h1>
                        <div class="fs-5 mb-5">
                        @if(!empty($product->sale_price) && $product->sale_price > 0)
                                <span class="text-muted text-decoration-line-through">{{ 'pkr:' . $product->price }}</span>
                                <span>{{'pkr:' . $product->sale_price }}</span>
                                @else
                               <span>{{'pkr:' . $product->price }}</span>
                                @endif
                        </div>
                        @if($product->stock==0)   
                        <div class="badge bg-danger text-white position-absolute" id="stock">
                                Out of stock
                            </div> 
                        @endif
                        <p class="lead">{{$product->description}}</p>
                        <div class="container mt-5">
    
                        <a href="{{ route('products_carts',['product'=>$product->id]) }}" class="btn btn-outline-dark">Add to Cart</a>
                        </div>

<!-- Cart Modal -->


                    </div>
                </div>
            </div>
        </section>
        <!-- Related items section-->
        <section class="py-5 bg-light">
            <div class="container px-4 px-lg-5 mt-5">
                <h2 class="fw-bolder mb-4" style="text-align: center;">Related products</h2>
                <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                @foreach($relatedProduct as $relatedProducts)
            <div class="col mb-5">
                <div class="card h-100">

                    @if(!empty($relatedProducts->sale_price) && $relatedProducts->stock !== 0)
                    <div class="badge bg-dark text-white position-absolute">
                        Sale
                    </div>
                    @elseif($relatedProducts->stock == 0)
                    <div class="badge bg-danger text-white position-absolute">
                        Out of stock
                    </div>
                    @endif

                    <!-- Product image -->
                    <img class="card-img-top" src="{{ asset('storage/' . $relatedProducts->image) }}" alt="Image" />

                    <!-- Product details -->
                    <div class="card-body p-4">
                        <div class="text-center">
                            <!-- Product name -->
                            <h5 class="fw-bolder">{{ $relatedProducts->name }}</h5>

                            <!-- Product price -->
                            @if(!empty($relatedProducts->sale_price) && $relatedProducts->sale_price > 0)
                            <span class="text-muted text-decoration-line-through">{{ 'pkr:' . $relatedProducts->price }}</span>
                            {{ 'pkr:' . $relatedProducts->sale_price }}
                            @else
                            {{ 'pkr:' . $relatedProducts->price }}
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
            </div>
        </section>
        

      @include('layout_footer_userPage')
        