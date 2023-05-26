@extends('admin.layouts.master')

@section('content')
    <div class="col-6 offset-3 mt-5">
<i class="fa-solid fa-arrow-left text-black" onclick="history.back()"></i>

        <div class="card-header">

            <div class="text-center"> <img
                    @if ($post['image'] == null) src="{{ asset('Default/defaultImage.jpg') }} "
            @else src="{{ asset('postImage/' . $post['image']) }} " @endif
                    width="400px" class="rounded img-thumbnail " alt="">
            </div>
        </div>
        <div class="card-body">
            <h3 class="text-center">{{ $post['title'] }}</h3>
            <p class="text-muted text-start">{{ $post['description'] }}</p>
        </div>
    </div>
@endsection
