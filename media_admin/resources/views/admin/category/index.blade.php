@extends('admin.layouts.master')
@section('search')
    <form class="form-header" action=" {{ route('admin#categorySearch') }} " method="POST">
        @csrf
        <input class="au-input au-input--xl" type="text" name="categorySearchKey" value="{{ old('categorySearchKey') }}"
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
                    <h3>Category Create</h3>
                </div>
                <div class="card-body">
                    <form action=" {{ route('admin#createCategory') }} " method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="">Category Name</label>
                            <input type="text" name="categoryName"
                                class="form-control @error('categoryName') is-invalid  @enderror"
                                placeholder="Enter Category Name....">
                            @error('categoryName')
                                <div class="text-danger invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Category Description</label>
                            <textarea name="categoryDescription" placeholder="Enter Category Deacription..." id="" cols="30"
                                rows="10" class="form-control @error('categoryDescription') is-invalid  @enderror"></textarea>
                            @error('categoryDescription')
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
                        Category List
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
                                    <th>Category id</th>
                                    <th>Category title</th>
                                    <th>Category description</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($category as $c)
                                    <tr class="tr-shadow">
                                        <td>{{ $c['category_id'] }}</td>
                                        <td>{{ $c['title'] }}</td>
                                        <td> {{ $c['description'] }}</td>
                                        <td>
                                            <div class="table-data-feature">
                                                {{-- @if (Auth::user()->id == $c['id']) --}}
                                                <a href="{{ route('admin#categoryEdit',$c['category_id']) }} ">
                                                    <button class="item bg-primary " data-toggle="tooltip"
                                                        data-placement="top" title="Edit">
                                                        <i class="zmdi zmdi-edit text-white"></i>
                                                    </button>
                                                </a>
                                                <a href=" {{ route('admin#categoryDelete', $c['category_id']) }} ">
                                                    <button class="item bg-danger ms-2" data-toggle="tooltip"
                                                        data-placement="top" title="Delete">
                                                        <i class="zmdi zmdi-delete text-white"></i>
                                                    </button>
                                                </a>
                                                {{-- @endif --}}
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
