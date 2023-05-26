@extends('admin.layouts.master')
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
                        <th>post title</th>
                        <th>image</th>
                        <th>view Count</th>


                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($post as $item)
                        <tr class="tr-shadow">
                            <td>{{ $item['post_id'] }}</td>
                            <td>{{ $item['title'] }}</td>
                            <td>
                                <img @if ($item['image'] == null) src="{{ asset('Default/defaultImage.jpg') }} "
                                @else src="{{ asset('postImage/' . $item['image']) }} " @endif
                                    width="100px" class="rounded img-thumbnail" alt="">

                            </td>
                            <td><i class="fa-solid fa-eye"></i> {{$item['post_count']}} </td>
                            <td><a href="{{ route('admin/trendPostDetails' ,$item['post_id'])}}">
                                <button class="btn btn-sm bg-dark text-white"><i class="fa-solid fa-file-lines"></i></button>
                            </a></td>

                        </tr>
                        <tr class="spacer"></tr>
                    @endforeach
                </tbody>
            </table>
            <div class= " d-flex justify-content-end me-5 text-end">
                {{-- {{$post->links()}} --}}
            </div>
        </div>
    </div>
</div>

@endsection
