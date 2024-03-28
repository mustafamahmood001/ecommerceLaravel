@include('layout_dashboard_start')

<div class="dashboardContent">
    <form action="{{ route('products.update', ['product' => $products->id]) }}" method="POST" enctype="multipart/form-data">
        @method('PUT')
        @csrf

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" value="{{ $products->name }}" id="name" name="name" required>
                @error('name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-6 mb-3">
                <label for="color" class="form-label">Color</label>
                <input type="text" class="form-control" value="{{ $products->color }}" id="color" name="color">
                @error('color')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="number" class="form-control" value="{{ $products->price }}" id="price" name="price" step="0.01" required>
                @error('price')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-6 mb-3">
                <label for="sale_price" class="form-label">Sale Price</label>
                <input type="number" class="form-control" value="{{ $products->sale_price }}" id="sale_price" name="sale_price" step="0.01">
                @error('sale_price')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="brand_id" class="form-label">Brand</label>
                <!-- Add a select dropdown for brand_id -->
                <select class="form-select" id="brand" name="brand" required style="width: 100%;">
                    <option selected disabled>Select Brand</option>

                    {{-- Display the current brand as the default option --}}
                    <option value="{{ $products->brand }}" selected>{{ $products->brand }}</option>

                    {{-- Display other brand options --}}
                    @foreach($brands as $brand)
                        @if($brand->name !== $products->brand)
                            <option value="{{ $brand->name }}">{{ $brand->name }}</option>
                        @endif
                    @endforeach
                </select>
                @error('brand')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-6 mb-3">
                <label for="product_code" class="form-label">Product Code</label>
                <input type="text" class="form-control" value="{{ $products->product_code }}" id="product_code" name="product_code">
                @error('product_code')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="function" class="form-label">Function</label>
                <select class="form-select" id="function" name="function" required style="width: 100%;">
                    <option value="{{ $products->function }}" selected>{{ $products->function }}</option>
                    @foreach(\Config::get('function_watch') as $value)
                        <option value="{{ $value }}">{{ $value }}</option>
                    @endforeach
                </select>
                @error('function')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-6 mb-3">
                <label for="stock" class="form-label">Stock</label>
                <input type="number" class="form-control" value="{{ $products->stock }}" id="stock" name="stock" required>
                @error('stock')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="image" class="form-label">Image</label>
                <input type="file" class="form-control" id="image" name="image">
                @error('image')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-6 mb-3">
                <img src="{{ asset('storage/' . $products->image) }}" alt="Current Image" style="width: 25%; height:97px;">
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="1">{{ $products->description }}</textarea>
                @error('description')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Update Product</button>
    </form>
</div>

@include('layout_dashboard_end')
