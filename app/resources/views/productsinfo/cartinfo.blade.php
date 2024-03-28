@include('layout_start_userPage')

<div class="cart">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="cartModalLabel">Shopping Cart</h3>
            </div>
            <div class="modal-body">
                <!-- Cart content goes here -->
                <div class="container-fluid">
                    <!-- Header row -->
                    <div class="row font-weight-bold">
                        <div class="col">#</div>
                        <div class="col">Photo</div>
                        <div class="col">Product</div>
                        <div class="col">Quantity</div>
                        <div class="col">Price</div>
                        <div class="col">Total</div>
                        <div class="col">Action</div>
                    </div>

                    <!-- Example cart items -->
                    <form method="post" action="{{ route('carts.store') }}" enctype="multipart/form-data">
                        @csrf
                        @foreach($cartData as $value)
                            <div class="row align-items-center">
                                <div class="col">{{ $loop->iteration }}</div>
                                <div class="col"><img src="{{ asset('storage/' . $value->getProductData->image) }}" alt="{{ $value->getProductData->name }}" class="img-fluid"></div>
                                <div class="col">{{ $value->getProductData->name }}</div>
                                <div class="col">
                                    <input type="hidden" name="cart[{{ $value->id }}]" value="{{ $value->id }}">
                                    <input type="number" class="form-control cart-qty" min="0" name="cartQty[{{ $value->id }}]" value="{{ $value->quantity }}">
                                </div>
                                <div class="col">{{ !empty($value->getProductData->sale_price) ? 'Pkr ' . $value->getProductData->sale_price : 'Pkr ' . $value->getProductData->_price }}</div>
                                <div class="col">
                                    Pkr {{ !empty($value->getProductData->sale_price) ? $value->getProductData->sale_price * $value->quantity : $value->getProductData->_price * $value->quantity }}
                                </div>
                                <div class="col"><a href="{{ route('deleteCart', ['id' => $value->id]) }}">Delete                                  
                                </a>
                                </div>
                            </div>
                        @endforeach

                       

                        <!-- Order Summary -->
                        <div class="mt-4">
                            <h5 class="font-weight-bold">Order Summary:</h5>
                            <h6>Subtotal: Pkr {{ $subtotal }}</h6>
                            <h6>Shipping: Pkr 100</h6>
                            <h6>Tax: Pkr {{ $tax }}%</h6>
                            <h4>Total: Pkr {{ $total }}</h4>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-outline-success">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@include('layout_footer_userPage')
