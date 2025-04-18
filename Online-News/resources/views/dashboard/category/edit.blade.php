@extends('layouts.dashboardmaster')

@section('title')
    Category
@endsection

@section('content')
<x-breadcum onlineNews="Category Edit Page"></x-breadcum>

    <div class="row">
        <div class="col-lg-112">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mb-3">Category Edit Table</h4>

                    <form action="{{ route('category.update',$category->slug) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">Category Title</label>
                            <div class="col-sm-9">
                                <input name="title" type="text" class="form-control @error('title')
                                    is-invalid
                                @enderror" id="inputEmail3" placeholder="Title" value="{{ $category->title }}">
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
                                @enderror" id="inputPassword3" placeholder="Slug" value="{{ $category->slug }}">
                                @error('slug')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <img id="OnlineNews" src="{{ asset('upload/category') }}/{{ $category->image }}" style="width: 50%; hight:50%; margin-left: 27%; object-fit:contain">
                        </div>
                        <div class="row mb-2">
                            <label for="inputPassword5" class="col-sm-3 col-form-label">Category Image</label>
                            <div class="col-sm-9">
                                <input onchange="document.querySelector('#OnlineNews').src = window.URL.createObjectURL(this.files[0])" name='image' type="file" class="form-control @error('image')
                                    is-invalid
                                @enderror" id="inputPassword5" value="{{ $category->image }}">
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
