@extends('admin.layouts.master')
@section('content')
<div class="row ">
    <div class="col-10 offset-1 card  ">
        <div class="card-header text-center ">
            <h3>User Account Edit</h3>
        </div>

        <div class="card-body">
            @if (session('updateSuccess'))
                <div class="col-8 offset-2">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fa-solid fa-circle-xmark"></i> {{ session('updateSuccess') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            @endif
            <form action="{{ route('admin#accountEditUpdate',$user['id']) }}" method="post">
                @csrf
                {{-- @foreach ($user as user) --}}
                <div class="row mt-2">
                    <div class="col-2 mt-1 offset-1">Name</div>
                    <div class="col-8">
                        <input type="text" class="form-control" name="adminName" value="{{ old('adminName',$user->name) }}"
                            placeholder="Enter Your Name">
                        @error('adminName')
                            <div class="text-danger">{{ $message}}</div>
                        @enderror
                    </div>
                </div>
                <div class="row mt-2 ">
                    <div class="col-2 mt-1 offset-1">Email</div>
                    <div class="col-8">
                        <input type="email" class="form-control" name="adminEmail" value="{{old('adminEmail',$user->email)  }}"
                            placeholder="Enter Your Email">
                            @error('adminEmail')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row mt-2 ">
                    <div class="col-2 mt-1 offset-1">Phone</div>
                    <div class="col-8">
                        <input type="number" class="form-control" name="adminPhone"value="{{ $user->phone }}"
                            placeholder="Enter Your Phone Number">
                    </div>
                </div>
                <div class="row mt-2 ">
                    <div class="col-2 mt-1 offset-1">Address</div>
                    <div class="col-8">
                        <textarea class="form-control" name="adminAddress" cols="30" rows="10" placeholder="Enter Your Address">{{ $user->address }}</textarea>
                    </div>
                </div>
                <div class="row mt-2 ">
                    <div class="col-2 mt-1 offset-1">Gender</div>
                    <div class="col-8">
                        <select name="adminGender" id="" class="form-control">
                            @if (Auth::user()->gender == 'male')
                                {
                                <option value="empty">Choose your gender</option>
                                <option value="male" selected>Male</option>
                                <option value="female">Female</option>
                                }
                            @elseif (Auth::user()->gender == 'female')
                                {
                                <option value="empty">Choose your gender</option>
                                <option value="male">Male</option>
                                <option value="female" selected>Female</option>
                            }@else{
                                <option value="empty" selected>Choose your gender</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                }
                            @endif
                        </select>
                    </div>
                </div>
                {{-- @endforeach --}}
                <div class="row ">
                    <div class="my-2 col-3 offset-8">
                        <button class="btn bg-dark text-white" type="submit">Update</button>
                    </div>
                </div>
            </form>
            {{-- <div class="row">
                <a href=" {{route('admin#directChangePassword')}} " class=" col-4 offset-8">Change Password</a>
            </div> --}}
        </div>
    </div>
</div>

@endsection
