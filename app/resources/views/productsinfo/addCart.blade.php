@include('layout_start_userPage')

<div class="cart">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="cartModalLabel">Shopping Cart</h3>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <!-- Header row -->
                    <div class="row font-weight-bold">
                        <div class="col">Photo</div>
                        <div class="col">Product</div>
                        <div class="col">Quantity</div>
                        <div class="col">Price</div>
                        <div class="col">Total</div>
                    </div>

                    <!-- Display added products in the cart -->
                    <form action="{{ route('storeCart') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="userId" value="{{ auth()->id() }}">
    <input type="hidden" name="productId" value="{{ $product->id }}">
                    <div class="row align-items-center">
                        <div class="col"><img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="img-fluid"></div>
                        <div class="col">{{$product->name}}</div>
                        <div class="col">
    <input type="number" id="quantity" name="quantity" class="form-control cart-qty @error('quantity') is-invalid @enderror" min="0">
    @error('quantity')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>
                        <div class="col" id="priceValue" data-price="{{ !empty($product->sale_price) ? $product->sale_price : $product->price }}">
                            {{ !empty($product->sale_price) ? 'Pkr ' . $product->sale_price : 'Pkr ' . $product->price }}
                        </div>
                        
                        <div class="col" id="totalValue">Pkr 0</div> <!-- Initial value set to 0 -->
                    </div>

                    <div class="mt-4">
    <h5 class="font-weight-bold">Special Notes for This Order:</h5>
    <textarea class="form-control @error('userComments') is-invalid @enderror" name="userComments" rows="3"></textarea>
    @error('userComments')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>

                        <!-- Order Summary -->
                        <div class="mt-4">
    <h5 class="font-weight-bold">Order Summary:</h5>
    <h6 id="subtotal">Subtotal: Pkr 0 </h6>
    <h6>Shipping: Pkr 100</h6>
    <h6>Tax: Pkr 3% </h6>
    <h4 id="totalOrder">Total: Pkr 0</h4>
</div>
                        <div class="modal-footer">
                            <a href="{{ route('product_info',['product'=>$product->id]) }}"><button type="button" class="btn btn-outline-danger" data-dismiss="modal">Close</button></a>
                            <button type="submit" class="btn btn-outline-success">Proceed for Checkout</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<!-- ... Your existing HTML ... -->

<!-- ... Your existing HTML ... -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<script>
    $(document).ready(function() {
        $('#quantity').on('keyup', function() {
            var quantity = $(this).val();
            var price = $('#priceValue').data('price');

            // Check for quantity validation error
            if (quantity < 1) {
                $('#quantity').addClass('is-invalid');
                $('#quantity').next('.invalid-feedback').text('Quantity must be at least 1.');
                return;
            } else {
                $('#quantity').removeClass('is-invalid');
                $('#quantity').next('.invalid-feedback').text('');
            }

            // Calculate the subtotal value
            var subtotal = quantity * price;

            // Display the subtotal value without the decimal part in the div and h6 element
            $('#totalValue').text('Pkr ' + parseInt(subtotal)); // or use Math.floor(subtotal)
            $('#subtotal').text('Subtotal: Pkr ' + parseInt(subtotal)); // or use Math.floor(subtotal)

            // Calculate the total order value including shipping and tax
            var shipping = 100;
            var taxRate = 3; // replace with your actual tax rate
            var tax = (subtotal * taxRate) / 100;
            var total = Math.round(subtotal + shipping + tax);

            // Display the total value in the h4 element
            $('#totalOrder').text('Total: Pkr ' + total);
        });
    });
</script>


@include('layout_footer_userPage')
