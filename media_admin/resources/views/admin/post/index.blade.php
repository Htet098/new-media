@extends('admin.layouts.master')
@section('search')
    <form class="form-header" action=" {{ route('admin#postSearch') }} " method="POST">
        @csrf
        <input class="au-input au-input--xl" type="text" name="postSearchKey" value="{{ old('postSearchKey') }}"
            placeholder="Search for datas &amp; reports..." />
        <button class="au-btn--submit" type="submit">
            <i class="zmdi zmdi-search"></i>
        </button>
    </form>
@endsection
@section('content')
    <div class="row">
        <div class="col-4">
            <div class="card">
                <div class="card-header">
                    <h3>Post Create</h3>
                </div>
                <div class="card-body">
                    <form action=" {{ route('admin#createPost') }} " method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="">Post Name</label>
                            <input type="text" name="postName" value="{{ old('postName') }}"
                                class="form-control @error('postName') is-invalid  @enderror"
                                placeholder="Enter Post Name....">
                            @error('postName')
                                <div class="text-danger invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Post Description</label>
                            <textarea name="postDescription" placeholder="Enter Post Deacription..." id="" cols="30" rows="10"
                                class="form-control @error('postDescription') is-invalid  @enderror">{{ old('postDescription') }}</textarea>
                            @error('postDescription')
                                <div class="text-danger invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Post Image</label>
                            <input type="file" name="postImage"
                                class="form-control @error('postImage') is-invalid  @enderror"
                                placeholder="Enter Category Name....">
                            @error('postImage')
                                <div class="text-danger invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Category Name</label>
                            <select name="postCategory" class="form-control @error('postCategory') is-invalid  @enderror">
                                <option value="">Chooes category...</option>
                                @foreach ($category as $c)
                                    <option value="{{ $c['category_id'] }} "> {{ $c['title'] }} </option>
                                @endforeach
                            </select>
                            @error('postCategory')
                                <div class="text-danger invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-7 offset-1">
            <div class="card">
                <div class="card-body">
                    <div class="card-header">
                        Post List
                    </div>
                    <div class="table-responsive table-responsive-data2">
                        @if (session('deleteSuccess'))
                            <div class="col-8 offset-2">
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <i class="fa-solid fa-circle-xmark"></i> {{ session('deleteSuccess') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            </div>
                        @endif
                        <table class="table table-data2">
                            <thead>
                                <tr>
                                    <th>Post id</th>
                                    <th>Post title</th>
                                    <th>Post Image</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($post as $p)
                                    <tr class="tr-shadow ">
                                        <td>{{ $p['post_id'] }}</td>
                                        <td>{{ $p['title'] }}</td>
                                        <td>
                                            <img @if ($p['image'] == null) src="{{ asset('Default/defaultImage.jpg') }} "
                                            @else src="{{ asset('postImage/' . $p['image']) }} " @endif
                                                width="100px" class="rounded img-thumbnail" alt="">

                                        </td>
                                        <td>
                                            <div class="table-data-feature">
                                                <a href="{{ route('admin#updatePostPage', $p['post_id']) }} ">
                                                    <button class="item bg-primary " data-toggle="tooltip"
                                                        data-placement="top" title="Edit">
                                                        <i class="zmdi zmdi-edit text-white"></i>
                                                    </button>
                                                </a>
                                                <a href=" {{ route('admin#deletePost', $p['post_id']) }} ">
                                                    <button class="item bg-danger ms-2" data-toggle="tooltip"
                                                        data-placement="top" title="Delete">
                                                        <i class="zmdi zmdi-delete text-white"></i>
                                                    </button>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="spacer"></tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
