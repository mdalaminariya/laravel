@extends('layouts.dashboardmaster')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title mb-3">Exists Role Manage</h4>

                <form action="{{ route('management.role.assign') }}" method="POST">
                    @csrf
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
                    <div class="row mb-2">
                        <label for="inputPassword5" class="col-sm-3 col-form-label">Manage User's Role</label>
                        <div class="col-sm-9">
                            <select class="form-select" name="user_id">
                                <option value="">Select User's</option>
                                @foreach ($use as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>=
                                @endforeach
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
</div>

<div class="row">
    {{-- blogger --}}
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">Blogger's table</h4>

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
                         @forelse ($bloggers as $blogger)
                         <tr>
                            <th scope="row">
                                {{ $loop->index +1 }}
                            </th>
                            <td>{{ $blogger->name }}</td>
                            <td>{{ $blogger->role }}</td>
                            @if (Auth::user()->role == 'admin')
                            <td>
                                <form id="Online_News{{ $blogger->id }}" action="{{ route('management.role.blogger.demotion',$blogger->id) }}" method="POST">
                                    @csrf
                                    <div class="form-check form-switch" style="font-size:large">
                                        <input onchange="document.querySelector('#Online_News{{ $blogger->id }}').submit()" class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" {{
                                            $blogger->role == $blogger->role ? 'checked' : ''
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
{{-- user --}}
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">User's table</h4>

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
                         @forelse ($use as $user)
                         <tr>
                            <th scope="row">
                                {{ $loop->index +1 }}
                            </th>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->role }}</td>
                            @if (Auth::user()->role == 'admin')
                            <td>
                                <form id="Online_News{{ $user->id }}" action="{{ route('management.role.user.demotion',$user->id) }}" method="POST">
                                    @csrf
                                    <div class="form-check form-switch" style="font-size:large">
                                        <input onchange="document.querySelector('#Online_News{{ $user->id }}').submit()" class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" {{
                                            $user->role == $user->role ? 'checked' : ''
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
