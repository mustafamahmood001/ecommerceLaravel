@include('layout_dashboard_start')

<div class="dashboardContent">
    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
                @error('name')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-6 mb-3">
                <label for="color" class="form-label">Color</label>
                <select class="form-select" id="color" name="color" required style="width: 100%;">
                @foreach(\Config::get('colors') as $value)
                <option value="{{ $value }}">{{ $value }}</option>
              @endforeach
            </select>
                @error('color')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="number" class="form-control" id="price" name="price" step="0.01" required>
                @error('price')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="col-md-6 mb-3">
                <label for="sale_price" class="form-label">Sale Price</label>
                <input type="number" class="form-control" id="sale_price" name="sale_price" step="0.01">
                @error('sale_price')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
            <label for="brand_id" class="form-label">Brand</label>
<select class="form-select" id="brand_id" name="brand" required style="width: 100%;">
    <option selected disabled>Select Brand</option>
    @foreach($brands as $brand)
        <option value="{{ $brand->name }}">{{ $brand->name }}</option>
    @endforeach
</select>
@error('brand')
    <span class="text-danger">{{ $message }}</span>
@enderror


            </div>

            <div class="col-md-6 mb-3">
                <label for="product_code" class="form-label">Product Code</label>
                <input type="text" class="form-control" id="product_code" name="product_code">
                @error('product_code')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="row">
        <div class="col-md-6 mb-3">
                <label for="function" class="form-label">Function</label>
                <select class="form-select" id="function" name="function" required style="width: 100%;">
    <option selected disabled>Select Function</option>
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
                <input type="number" class="form-control" id="stock" name="stock" required>
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
        </div>

        <div class="row">
            <div class="col-md-12 mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="1"></textarea>
                @error('description')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <button type="submit"  class="btn btn-primary">Submit</button>
    </form>


</div>

@include('layout_dashboard_end')
