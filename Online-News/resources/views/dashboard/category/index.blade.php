@extends('layouts.dashboardmaster')

@section('content')


    <div class="row">
        {{-- category Show --}}
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Category table</h4>

                    <div class="table-responsive">
                        <table class="table table-borderless mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Image</th>
                                    <th>Title</th>
                                    <th>Staus</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                             @foreach ($categories as $category)
                             <tr>
                                <th scope="row">
                                    {{ $loop->index +1 }}
                                </th>
                                <td><img src="{{ asset('upload/category') }}/{{ $category->image }}" style="width: 90px;height:70px"></td>
                                <td>{{ $category->title }}</td>
                                <td>
                                    <form id="Online_News{{ $category->id }}" action="{{ route('category.status',$category->slug) }}" method="POST">
                                        @csrf
                                        <div class="form-check form-switch" style="font-size:large">
                                            <input onchange="document.querySelector('#Online_News{{ $category->id }}').submit()" class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" {{
                                                $category->status == 'active' ? 'checked' : ''
                                            }}>
                                          </div>
                                    </form>
                                </td>
                                <td>
                                    <a class="btn btn-info sm" href="{{ route('category.edit',$category->id) }}"><i class="fa-solid fa-pen-to-square"></i></a>
                                    <a class="btn btn-danger sm" href="{{ route('category.delete',$category->slug) }}"><i class="fa-solid fa-trash-can"></i></a>
                                </td>
                            </tr>
                             @endforeach
                            </tbody>
                        </table>
                    </div> <!-- end table-responsive-->
                </div>
            </div> <!-- end card -->
        </div>
        {{-- Category Insert --}}
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mb-3">Category Insert Table</h4>

                    <form action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">Category Title</label>
                            <div class="col-sm-9">
                                <input name="title" type="text" class="form-control @error('title')
                                    is-invalid
                                @enderror" id="inputEmail3" placeholder="Title">
                                @error('title')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputPassword3" class="col-sm-3 col-form-label">Category Slug</label>
                            <div class="col-sm-9">
                                <input name="slug" type="text" class="form-control @error('slug')
                                    is-invalid
                                @enderror" id="inputPassword3" placeholder="Slug">
                                @error('slug')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <img style="width: 50%; height= 50%; margin-left: 27%; object-fit: contain" id="OnlineNews" src="{{ asset('upload/profile') }}/{{ auth()->user()->image }}" alt="">
                        </div>
                        <div class="row mb-2">
                            <label for="inputPassword5" class="col-sm-3 col-form-label">Category Image</label>
                            <div class="col-sm-9">
                                <input onchange="document.querySelector('#OnlineNews').src = window.URL.createObjectURL(this.files[0])" name='image' type="file" class="form-control @error('image')
                                    is-invalid
                                @enderror" id="inputPassword5">
                                @error('image')
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
