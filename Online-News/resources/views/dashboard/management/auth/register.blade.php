@extends('layouts.dashboardmaster')


@section('content')

<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title mb-3">Role & User Registration</h4>

                <form action="{{ route('management.store') }}" method="POST">
                    @csrf
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Name</label>
                        <div class="col-sm-9">
                            <input name="name" type="text" class="form-control @error('name')
                                is-invalid
                            @enderror" id="inputEmail3" placeholder="Name">
                            @error('name')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputPassword3" class="col-sm-3 col-form-label">Email</label>
                        <div class="col-sm-9">
                            <input name="email" type="text" class="form-control @error('email')
                                is-invalid
                            @enderror" id="inputPassword3" placeholder="Email">
                            @error('email')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-2">
                        <label for="inputPassword5" class="col-sm-3 col-form-label">Password</label>
                        <div class="col-sm-9">
                            <input name='password' type="password" class="form-control @error('password')
                                is-invalid
                            @enderror" placeholder="Password" id="inputPassword5">
                            @error('password')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-2">
                        <label for="inputPassword5" class="col-sm-3 col-form-label">Role</label>
                        <div class="col-sm-9">
                            <select class="form-select" name="role">
                                <option value="">Select Role</option>
                                <option value="manager">Manager</option>
                                <option value="blogger">Blogger</option>
                                <option value="user">User</option>
                            </select>
                            @error('role')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="justify-content-end row">
                        <div class="col-sm-9">
                            <button type="submit" class="btn btn-info waves-effect waves-light">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">Manager's table</h4>

                <div class="table-responsive">
                    <table class="table table-borderless mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Role</th>
                                @if (Auth::user()->role == 'admin')
                                <th>Staus</th>
                                <th>Action</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                         @forelse ($managers as $manager)
                         <tr>
                            <th scope="row">
                                {{ $loop->index +1 }}
                            </th>
                            <td>{{ $manager->name }}</td>
                            <td>{{ $manager->role }}</td>
                            @if (Auth::user()->role == 'admin')
                            <td>
                                <form id="Online_News{{ $manager->id }}" action="{{ route('management.manager.down',$manager->id) }}" method="POST">
                                    @csrf
                                    <div class="form-check form-switch" style="font-size:large">
                                        <input onchange="document.querySelector('#Online_News{{ $manager->id }}').submit()" class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" {{
                                            $manager->role == $manager->role ? 'checked' : ''
                                        }}>
                                      </div>
                                </form>
                            </td>
                            <td>
                                <a class="btn btn-info sm" href="#"><i class="fa-solid fa-pen-to-square"></i></a>
                                <a class="btn btn-danger sm" href="#"><i class="fa-solid fa-trash-can"></i></a>
                            </td>
                            @endif
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-danger text-center">Please Insert Data.!</td>
                        </tr>
                         @endforelse
                        </tbody>
                    </table>
                </div> <!-- end table-responsive-->
            </div>
        </div> <!-- end card -->
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
