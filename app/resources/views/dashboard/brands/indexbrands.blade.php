@include('layout_dashboard_start')
<!-- Main content goes here -->
<div class="dashboardContent">
        <div class="mb-3">
            <div class="search">
            <input type="search" name="search" id="search" placeholder="Search Somthing Here" 
            class="form-control">
            </div>
        </div>
        <div class="addBrand">
        <button class="btn btn-success"><a href="{{ route('brands.create') }}">Brand +</a></button>
</div>
        <table  class="table table-striped table-bordered">
            <thead>
                <tr>
                <th>Brand Name @sortablelink('name','↑↓')</th>
               <th>Description @sortablelink('description','↑↓')</th>
                <th>photo @sortablelink('photo', '↑↓')</th>
                <th>Status @sortablelink('is_active', '↑↓')</th>
                <th>Status Action</th>
               <th>Action</th>
                </tr>
            </thead>
            <tbody id="allData">
            @if(count($brands) > 0)
            @foreach($brands as $brand)
        <tr>
            <td>{{ $brand->id }}</td>
            <td>{{ $brand->name }}</td>
            <td>{{ $brand->description }}</td>
        <td id="userProfileShow"><img src="{{ asset('storage/' . $brand->photo) }}" alt="Profile Picture" class="img-fluid rounded-circle"></td>
    <td>{{ $brand->is_active }}</td>
    <td><button class="btn btn-outline-success" name="actives"><a href="{{ route('brandactive',['id'=>$brand->id])}}">Active/Deactive</a></button></td>    
    <td>
    <button class="btn btn-warning" ><a href="{{ route('brands.edit', ['brand' => $brand]) }}">Edit</a></button>
    <button class="btn btn-danger"><a href="{{ route('destroyBrand', ['id' => $brand->id]) }}" onclick="alertDelete()">Delete</a></button>

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
<div class="pagination-container" id="paginating">
    {{ $brands->links('pagination::bootstrap-4') }}
</div>
      

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<script src="{{ asset('js/dashboard.js') }}"></script>



@include('layout_dashboard_end')

