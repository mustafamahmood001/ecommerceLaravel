@include('layout_dashboard_start')
<!-- Main content goes here -->

<div class="dashboardContent">
    <div class="table-responsive">
        <div class="mb-3">
        <div class="search">
            <input type="search" name="searchProduct" id="searchProduct" placeholder="Search Somthing Here" 
            class="form-control">
            </div>
        </div>
        <div class="addBrand">
        <button class="btn btn-success"><a href="{{ route('products.create') }}">Product+</a></button>
</div>
        <table id="dataTable" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Name @sortablelink('fname','↑↓')</th>
                    <th>Price @sortablelink('email','↑↓')</th>
                    <th>Sale Price @sortablelink('role','↑↓')</th>
                    <th>Color @sortablelink('country','↑↓')</th>
                    <th>Brand @sortablelink('city','↑↓')</th>
                    <th>Product Code @sortablelink('lname','↑↓')</th>
                    <th>Function @sortablelink('photo','↑↓')</th>
                    <th>Stock @sortablelink('is_active','↑↓')</th>
                    <th>Description @sortablelink('description','↑↓')</th>
                    <th>Image</th>
                    <th>Status</th>
                    <th>Status Action</th>
                    <th>Action</th>
                </tr>
            </thead>
          <tbody id="productAllData">
            @if(count($products) > 0)
            @foreach($products as $product)
            <tr>
            <td>{{ $product->name }}</td>
            <td>{{ $product->price }}</td>
            <td>{{ $product->sale_price }}</td>
            <td>{{ $product->color }}</td>
            <td>{{ $product->brand }}</td>
            <td>{{ $product->product_code }}</td>
            <td>{{ $product->function }}</td>
            <td>{{ $product->stock }}</td>
            <td>{{ $product->description }}</td>
            <td id="userProfileShow"><img src="{{ asset('storage/' . $product->image) }}" alt="Profile Picture" class="img-fluid rounded-circle"></td>
            <td>{{ $product->is_active }}</td>
            <td>
    <button class="btn btn-outline-success" name="actives"><a href="{{ route('productactive',['id' => $product->id])}}">Active/Deactive</a></button>
</td>
    <td>
    <button class="btn btn-warning" ><a href="{{ route('products.edit',['product'=>$product->id]) }}">Edit</a></button>
    <button class="btn btn-danger"><a href="{{ route('destroyProduct', ['id' => $product->id]) }}" onclick="alertDelete()">Delete</a></button>
</td>
        </tr>
        @endforeach
          @else
          <tr>
            <td>No Data Found</td>
          </tr>
          @endif
            </tbody>
        </table>
        </div>
</div>
    </div>
<div class="pagination-container" id="paginating">
    {{ $products->links('pagination::bootstrap-4') }}
</div>

      

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<script src="{{ asset('js/dashboard.js') }}"></script>

@include('layout_dashboard_end')