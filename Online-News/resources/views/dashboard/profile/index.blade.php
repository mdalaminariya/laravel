 @extends('layouts.dashboardmaster')

@section('content')

<div class="row">
    <div class="col-lg-5" style="margin-left: 5%">
        <div class="card">
            <div class="card-body">
                <h5 class="header-title">Name Update</h5>
                <form action="{{ route('profile.name.update') }}" method="POST">
                    @csrf
                    <div class="form-floating mb-4">
                        <input name="name" type="text" class="form-control @error('name')
                            is-invalid
                        @enderror" id="floatingnameInput" placeholder="Enter Name" value="{{ old('name') }}">
                        @error('name')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                        <label for="floatingnameInput">Name</label>
                    </div>
                    <div style="margin-left: 45%;">
                        <button type="submit" class="btn btn-primary w-md">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-5" style="margin-left: 5%">
        <div class="card">
            <div class="card-body">
                <h5 class="header-title">Email Update</h5>
                <form action="{{ route('profile.email.update') }}" method="POST">
                    @csrf
                    <div class="form-floating mb-4">
                        <input name="email" type="text" class="form-control @error('email')
                            is-invalid
                        @enderror" id="floatingnameInput" placeholder="Enter Email" value="{{ old('email') }}">
                        @error('email')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                        <label for="floatingnameInput">Email</label>
                    </div>
                    <div style="margin-left: 45%;">
                        <button type="submit" class="btn btn-primary w-md">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-5" style="margin-left: 5%">
        <div class="card">
            <div class="card-body">
                <h5 class="header-title">Password Update</h5>
                <form action="{{ route('profile.password.update') }}" method="POST">
                    @csrf
                    <div class="form-floating mb-4">
                        <input name="current_password" type="password" class="form-control @error('current_password')
                            is-invalid
                        @enderror" id="floatingnameInput" placeholder="Enter Password">
                        @error('current_password')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                        <label for="floatingnameInput">Current Password</label>
                    </div>
                    <div class="form-floating mb-4">
                        <input name="password" type="password" class="form-control @error('password')
                            is-invalid
                        @enderror" id="floatingnameInput" placeholder="Enter Password" value="{{ old('password') }}">
                        @error('password')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                        <label for="floatingnameInput">New Password</label>
                    </div>
                    <div class="form-floating mb-4">
                        <input name="password_confirmation" type="password" class="form-control @error('password_confirmation')
                            is-invalid
                        @enderror" id="floatingnameInput" placeholder="Enter Password" value="{{ old('password_confirmation') }}">
                        <label for="floatingnameInput">Confirm Password</label>
                    </div>
                    <div style="margin-left: 45%;">
                        <button type="submit" class="btn btn-primary w-md">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-5" style="margin-left: 5%">
        <div class="card">
            <div class="card-body">
                <h5 class="header-title">Image Update</h5>
                <form action="{{ route('profile.image.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-3">
                        <img id="Online_News" src="{{ asset('upload/profile') }}/{{ auth()->user()->image }}" style="width: 50%; height: 50%; margin-left: 20%; object-fit: contain">
                    </div>
                    <div class="form-floating mb-4">
                        <input onchange="document.querySelector('#Online_News').src = window.URL.createObjectURL(this.files[0])" name="image" type="file" class="form-control mn-3 @error('image')
                            is-invalid
                        @enderror" id="floatingnameInput" placeholder="Enter Name">
                        @error('image')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div style="margin-left: 45%;">
                        <button type="submit" class="btn btn-primary w-md">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
@if (session('success'))
    <script>
        Toastify({
    text: "{{ session('success') }}",
    duration: 3000,
    newWindow: true,
    close: true,
    gravity: "top", // `top` or `bottom`
    position: "center", // `left`, `center` or `right`
    stopOnFocus: true, // Prevents dismissing of toast on hover
    style: {
    background: "linear-gradient(to right, #00C9FF, #92FE9D)",
    },
    onClick: function(){} // Callback after click
    }).showToast();
    </script>
@endif
@endsection
