@include('layout_dashboard_start')

<!-- Main content goes here -->
<div class="dashboardContent">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <!-- Profile picture -->
                <div class="imageBrand">
                <img src="{{ asset('storage/' . $brand->photo) }}" alt="Profile Picture" class="img-fluid rounded-circle">
                <!-- Form for updating profile photo -->
                <form action="{{ route('userPictureupdate', ['id' => $brand->id]) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="photo" class="custom-file-upload">
                            <i class="bi bi-camera"></i> Update Photo
                        </label>
                        <input type="file" id="photo" name="photo" class="form-control" accept="image/*" style="display: none;">
                        @error('photo')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
</div>

                    <button type="submit" class="btn btn-primary">Update Photo</button>
                </form>
            </div>

            <div class="col-md-8">
                <div class="Userdetailsform">
                <form action="{{ route('brands.update', ['brand' => $brand->id]) }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('put')
                        <!-- User details fields -->
                        <div class="col-md-6">
                            <label for="name">Name:</label>
                            <input type="text" name="name" value="{{ $brand->name }}" class="form-control" required>
                            @error('name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="description">Description:</label>
                            <textarea name="description" class="form-control" required>{{ $brand->description }}</textarea>
                            @error('description')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Add other form fields as needed -->
                        <div class="brandUpdate">
        <button type="submit" class="btn btn-primary">Update Brand</button>
</div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
    @include('layout_dashboard_end')