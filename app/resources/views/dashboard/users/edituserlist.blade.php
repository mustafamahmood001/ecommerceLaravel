@include('layout_dashboard_start')

<!-- Main content goes here -->
<div class="dashboardContent">
<div class="container">
            <div class="row">
                <div class="col-md-4">
                    <!-- Profile picture -->
                    <img src="{{ asset('storage/' . $user->photo) }}" alt="Profile Picture" class="img-fluid rounded-circle">
                    <!-- Form for updating profile photo -->
                    <form action="{{ route('userPictureupdates', ['id' => auth()->user()->id]) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mt-3">
                            <label for="photo" class="custom-file-upload">
                                <i class="bi bi-camera"></i> Update Photo
                            </label>
                            <input type="file" id="photo" name="photo" class="form-control" accept="image/*"
                                style="display: none;">
                            @error('photo')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Update Photo</button>
                    </form>
                </div>
                <div class="col-md-8">
                                        <div class="Userdetailsform">
                            <form action="{{auth()->check() ?route('userProfileupdates', ['id' => auth()->user()->id])  : route('logform') }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <!-- User details fields -->
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="fname">First Name:</label>
                                        <input type="text" id="fname" name="fname" value="{{ $user->fname }}"
                                            class="form-control" required>
                                        @error('fname')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="lname">Last Name:</label>
                                        <input type="text" id="lname" name="lname" value="{{ $user->lname }}"
                                            class="form-control" required>
                                        @error('lname')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="email">Email:</label>
                                        <input type="email" id="email" name="email" value="{{ $user->email }}"
                                            class="form-control" required readonly>
                                        @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="country">Country:</label>
                                        <select id="country" name="country" class="form-control" required>
                                            <option value="">Select Country</option>
                                            @foreach(['Pakistan', 'UAE', 'Oman'] as $option)
                                            <option value="{{ $option }}" {{ $user->country == $option ? 'selected' : '' }}>
                                                {{ $option }}
                                            </option>
                                            @endforeach
                                        </select>
                                        @error('country')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="city">City:</label>
                                        <select id="city" name="city" class="form-control" required>
                                            <option value="">Select City</option>
                                            @foreach(['Lahore', 'Islamabad', 'Peshawar'] as $option)
                                            <option value="{{ $option }}" {{ $user->city == $option ? 'selected' : '' }}>
                                                {{ $option }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="gender">Gender:</label>
                                        <select id="gender" name="gender" value="{{ $user->gender }}"
                                            class="form-control" required>
                                            <option value="">Select Gender</option>
                                            <option value="male" @if($user->gender === 'male') selected @endif>Male
                                            </option>
                                            <option value="female" @if($user->gender === 'female') selected @endif>Female
                                            </option>
                                            <option value="other" @if($user->gender === 'other') selected @endif>Other
                                            </option>
                                        </select>
                                        @error('gender')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                </div>    
                                <div class="form-row">
                                    <div class="form-group col-md-8">
                                        <button type="submit" class="btn btn-primary btn-lg">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                </div>
            </div>
        </div>
    </div> <!-- Close MainContent div -->
    </div>
    @include('layout_dashboard_end')