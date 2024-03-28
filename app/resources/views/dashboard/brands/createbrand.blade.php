@include('layout_dashboard_start')
<!-- Main content goes here -->
<div class="dashboardContent">
<div class="brandForm">
<h2>Add New Brand</h2>

    <form action="{{ route('brands.store') }}" method="post" enctype="multipart/form-data">
        @csrf <!-- CSRF protection for Laravel forms -->

        <div class="col-md-6">
            <label for="name" class="form-label">Brand Name</label>
            <input type="text" class="form-control" id="name" name="name" style="width: 200px;" required>
        </div>

        <div class="col-md-6">
            <label for="description" class="form-label">Brand Description</label>
            <textarea class="form-control" id="description" name="description" rows="3" style="width: 200px;"></textarea>
        </div>

        <div class="col-md-6">
            <label for="photo" class="form-label">Brand Photo</label>
            <input type="file" class="form-control" id="photo" name="photo" style="width: 200px;">
        </div>
<div class="brandAdd">
        <button type="submit" class="btn btn-primary">Add Brand</button>
</div>
    </form>
</div>
</div>


@include('layout_dashboard_end')
        