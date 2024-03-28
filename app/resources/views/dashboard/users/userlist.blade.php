@include('layout_dashboard_start')
<!-- Main content goes here -->

<div class="dashboardContent">
    <div class="table-responsive">
        <div class="mb-3">
        <div class="search">
            <input type="search" name="searchUser" id="searchUser" placeholder="Search Somthing Here" 
            class="form-control">
            </div>
        </div>

        <table id="dataTable" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>First Name @sortablelink('fname','↑↓')</th>
                    <th>Last Name @sortablelink('lname','↑↓')</th>
                    <th>Email @sortablelink('email','↑↓')</th>
                    <th>Role @sortablelink('role','↑↓')</th>
                    <th>Country @sortablelink('country','↑↓')</th>
                    <th>City @sortablelink('city','↑↓')</th>
                    <th>Gender @sortablelink('gender','↑↓')</th>
                    <th>Photo @sortablelink('photo','↑↓')</th>
                    <th>Status @sortablelink('is_active','↑↓')</th>
                    <th>Status Action</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="userAllData">
            @if(count($user) > 0)
            @foreach($user as $users)
            <tr>
            <td>{{ $users->id }}</td>
            <td>{{ $users->fname }}</td>
            <td>{{ $users->lname }}</td>
            <td>{{ $users->email }}</td>
            <td>{{ $users->role }}</td>
            <td>{{ $users->country }}</td>
            <td>{{ $users->city }}</td>
            <td>{{ $users->gender }}</td>
            <td id="userProfileShow"><img src="{{ asset('storage/' . $users->photo) }}" alt="Profile Picture" class="img-fluid rounded-circle"></td>
            <td>{{ $users->is_active }}</td>
            <td>
    <button class="btn btn-outline-success" name="actives"><a href="{{ route('useractive',['id'=>$users->id])}}">Active/Deactive</a></button>
</td>
    <td>
    <button class="btn btn-warning" ><a href="{{ route('edituserdetails',['id'=>$users->id]) }}">Edit</a></button>
        <button class="btn btn-danger"><a href="{{ route('userdetaildestroy',['id'=>$users->id]) }}">Delete</a></button>
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
    {{ $user->links('pagination::bootstrap-4') }}
</div>

      

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<script src="{{ asset('js/dashboard.js') }}"></script>

@include('layout_dashboard_end')