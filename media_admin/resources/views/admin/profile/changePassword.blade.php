@extends('admin.layouts.master')
@section('content')
    <div class="row ">
        <div class="col-10 offset-1 card  ">
            <div class="card-header text-center ">
                <h3>Change Password</h3>
            </div>

            <div class="card-body">
                @if (session('updateError'))
                    <div class="col-8 offset-2">
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fa-solid fa-circle-xmark"></i> {{ session('updateError') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                @endif
                <form action="{{ route('admin#changePassword') }}" method="post">
                    @csrf
                    <div class="row mt-2">
                        <div class="col-3 mt-1 offset-1">Old Password</div>
                        <div class="col-7">
                            <input type="password" class="form-control" name="oldPassword"
                                placeholder="Enter Your Old Password">
                            @error('oldPassword')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mt-2 ">
                        <div class="col-3 mt-1 offset-1">New Password</div>
                        <div class="col-7">
                            <input type="password" class="form-control" name="newPassword"
                                placeholder="Enter Your New Password">
                                @error('newPassword')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mt-2 ">
                        <div class="col-3 mt-1 offset-1">Confirm Password</div>
                        <div class="col-7">
                            <input type="password" class="form-control" name="confirmPassword"
                                placeholder="Enter Your Confirm Password">
                                @error('confirmPassword')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row ">
                        <div class="my-2 col-3 offset-8">
                            <button class="btn bg-dark text-white" type="submit">Change Password</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
