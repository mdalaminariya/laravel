@extends('layouts.dashboardmaster')

@section('title')
    Blog
@endsection

@section('content')

<x-breadcum onlineNews="Blog Show Page"></x-breadcum>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">Blog's table</h4>

                <div class="table-responsive">
                    <table class="table table-borderless mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Image</th>
                                <th>Title</th>
                                <th>Category Title</th>
                                <th>Staus</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                         @forelse ($blogs as $blog)
                         <tr>
                            <th scope="row">
                                {{ $loop->index +1 }}
                            </th>
                            <td><img src="{{ asset('upload/blog') }}/{{ $blog->thumbnail }}" style="width: 90px;height:70px"></td>
                            <td>{{ $blog->title }}</td>
                            <td>{!! $blog->one_category->title !!}</td>
                            <td>
                                <form id="Online_News{{ $blog->id }}" action="{{ route('blog.status',$blog->slug) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-check form-switch" style="font-size:large">
                                        <input onchange="document.querySelector('#Online_News{{ $blog->id }}').submit()" class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" {{
                                            $blog->status == 'active' ? 'checked' : ''
                                        }}>
                                      </div>
                                </form>
                            </td>
                            <td>
                                <a data-bs-toggle="modal" data-bs-target="#show_Online_News{{ $blog->id }}" class="btn btn-info sm" href="javascript:void(0)"><i class="fa-solid fa-circle-info"></i></a>
                                <a class="btn btn-info sm" href="{{ route('blog.edit',$blog->id) }}"><i class="fa-solid fa-pen-to-square"></i></a>
                                <a class="btn btn-danger sm" href="{{ route('blog.destroy',$blog->slug) }}"><i class="fa-solid fa-trash-can"></i></a>
                            </td>
                        </tr>
                        <!-- Modal -->
                        <div class="modal fade" id="show_Online_News{{ $blog->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="card" style="width: 30rem; margin-left: 10px; margin-top: 1rem;">
                                    <img src="{{ asset('upload/blog') }}/{{ $blog->thumbnail }}" class="card-img-top" alt="...">
                                    <div class="card-body">
                                      <h5 class="card-title">{{ $blog->id }} -- {{ $blog->title }} </h5>
                                      <p class="card-text">Short-Description -- {!! $blog->short_description !!}</p>
                                      <p class="card-text">Description -- {!! $blog->description !!}</p>
                                    </div>
                                  </div>
                                <div class="modal-footer">
                                  <button style="margin-right: 40%" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                              </div>
                            </div>
                          </div>
                          @empty
                          <tr>
                            <td colspan="6" class="text-danger text-center">No Data Found</td>
                          </tr>
                         @endforelse
                        </tbody>
                    </table>
                    {{ $blogs->links() }}
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
