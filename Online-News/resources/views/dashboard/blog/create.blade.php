@extends('layouts.dashboardmaster')

@section('title')
    Blog
@endsection

@section('content')

<x-breadcum onlineNews="Blog Create Page"></x-breadcum>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title mb-3">Category Insert Table</h4>

                <form action="{{ route('blog.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Categories</label>
                        <div class="col-sm-9">
                            <div class="col-12">
                                <select class="form-control" data-toggle="select2" name="category_id">
                                    <option>Select</option>
                                    <optgroup label="{{ env('APP_SLOGAN') }}">
                                        @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->title }}</option>
                                        @endforeach
                                    </optgroup>
                                </select>
                            </div>
                            @error('title')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Blog Title</label>
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
                        <label for="inputPassword3" class="col-sm-3 col-form-label">Blog Slug</label>
                        <div class="col-sm-9">
                            <input name="slug" type="text" class="form-control @error('slug')
                                is-invalid
                            @enderror"  placeholder="Slug">
                            @error('slug')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputPassword3" class="col-sm-3 col-form-label">Short Description</label>
                        <div class="col-sm-9">
                            <textarea id="shortNote" name="short_description" type="text" class="form-control @error('short_description')
                                is-invalid
                            @enderror" ></textarea>
                            @error('short_description')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputPassword3" class="col-sm-3 col-form-label">Description</label>
                        <div class="col-sm-9">
                            <textarea id="longNote" name="description" type="text" class="form-control @error('description')
                                is-invalid
                            @enderror" ></textarea>
                            @error('description')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <img style="width: 20%; height= 20%; margin-left: 50%;" id="OnlineNews" src="{{ asset('upload/default/user.png') }}" alt="">
                    </div>
                    <div class="row mb-2">
                        <label for="inputPassword5" class="col-sm-3 col-form-label">Blog Thumbnail</label>
                        <div class="col-sm-9">
                            <input onchange="document.querySelector('#OnlineNews').src = window.URL.createObjectURL(this.files[0])" name='thumbnail' type="file" class="form-control @error('thumbnail')
                                is-invalid
                            @enderror" id="inputPassword5">
                            @error('thumbnail')
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

<script>
    tinymce.init({
      selector: '#shortNote',
      plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
      toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
    });
  </script>
<script>
    tinymce.init({
      selector: '#longNote',
      plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
      toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
    });
  </script>

@endsection
