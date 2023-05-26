@extends('admin.layouts.master')
@section('search')
    <form class="form-header" action=" {{ route('admin#listSearch') }} " method="POST">
        @csrf
        <input class="au-input au-input--xl" type="text" name="adminSearchKey" value="{{old('adminSearchKey')}}"
            placeholder="Search for datas &amp; reports..." />
        <button class="au-btn--submit" type="submit">
            <i class="zmdi zmdi-search"></i>
        </button>
    </form>
@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            Admin List
        </div>
        <div class="card-body">
            <div class="table-responsive table-responsive-data2">
                @if (session('deleteSuccess'))
                    <div class="col-8 offset-2">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fa-solid fa-circle-xmark"></i> {{ session('deleteSuccess') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                @endif
                <table class="table table-data2">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>name</th>
                            <th>email</th>
                            <th>phone</th>
                            <th>address</th>
                            <th>gender</th>

                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($userData as $user)
                            <tr class="tr-shadow">
                                <td>{{ $user['id'] }}</td>
                                <td>{{ $user['name'] }}</td>
                                <td>
                                    <span class="block-email">{{ $user['email'] }}</span>
                                </td>
                                <td class="desc">{{ $user['phone'] }}</td>
                                <td>{{ $user['address'] }}</td>
                                <td>
                                    {{ $user['gender'] }}
                                </td>
                                <td>
                                    <div class="table-data-feature">
                                        @if (Auth::user()->id == $user['id'])
                                            <a href=" {{route('admin#accountEdit',$user['id'])}}">
                                                <button class="item bg-primary" data-toggle="tooltip" data-placement="top" title="Edit">
                                                    <i class="zmdi zmdi-edit text-white"></i>
                                                </button>
                                            </a>
                                             @endif
                                            <a href="{{ route('admin#accountDelete', $user['id']) }}">
                                                <button class="item bg-danger ms-2"
                                                data-toggle="tooltip" data-placement="top" title="Delete">
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
@endsection
