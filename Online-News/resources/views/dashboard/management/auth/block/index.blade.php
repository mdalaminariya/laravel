@extends('layouts.dashboardmaster')

@section('title')
    Management
@endsection

@section('content')

<x-breadcum onlineNews="Block Page"></x-breadcum>

<div class="row">
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
                                <th>Block</th>
                                <th>Action</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                         @forelse ($users as $user)
                         <tr>
                            <th scope="row">
                                {{ $loop->index +1 }}
                            </th>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->role }}</td>
                            @if (Auth::user()->role == 'admin'||Auth::user()->role == 'manager')
                            <td>
                                <form id="Online_News{{ $user->id }}" action="{{ route('management.user.unblock',$user->id) }}" method="POST">
                                    @csrf
                                    <div class="form-check form-switch" style="font-size:large">
                                        <input onchange="document.querySelector('#Online_News{{ $user->id }}').submit()" class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" {{
                                            $user->block == $user->block ? 'checked' : ''
                                        }}>
                                      </div>
                                </form>
                            </td>
                            <td>
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
