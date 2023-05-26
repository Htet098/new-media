<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    //direct admin home page
    public function index(){
        $id = Auth::user()->id;
        $user = User::select('id','name','email','phone','address','gender')->where('id',$id)->first();
        // dd($userInfo ->toArray());
        return view('admin.profile.index',compact('user'));
    }
    //admin update profile
    public function updateAdminAccount(Request $request){
        $userData = $this->getUserInfo($request);
        $validator=$this->userValidationCheck($request);
        User::where('id',Auth::user()->id)->update($userData);
        return back()->with(['updateSuccess'=>'Admin Account Update Success']);
    }
    //admin change password
    public function directChangePassword(){
        return view('admin.profile.changePassword');
    }
    //change password
    public function changePassword( Request $request){
        $validation = $this->changePasswordValidationCheck($request);
        $dbData = User::where('id',Auth::user()->id)->first();

        $dbPassword= $dbData->password;

        $hashUserPassword = Hash::make($request->newPassword);
        $updateData=[
            'password' =>$hashUserPassword
        ];

        if(Hash::check($request->oldPassword,$dbPassword)){
            User::where('id',Auth::user()->id)->update($updateData);
            return redirect()->route('dashboard');
        }else{
           return back()->with(['updateError'=>'Old Password Do Not Match...']);
        }
        dd($dbPassword);
    }

    //request admin data
    private function getUserInfo($request){
        return[
            'name' =>$request->adminName,
            'email'=>$request->adminEmail,
            'phone'=>$request->adminPhone,
            'address'=>$request->adminAddress,
            'gender'=>$request->adminGender,
            'updated_at'=>Carbon::now(),
        ];
    }

    //user validation check
    private function userValidationCheck($request){
       $validationRule =[
            'adminName'=>'required',
            'adminEmail'=>'required',
        ];
        Validator::make($request->all(),$validationRule)->validate();
    }

    //change password validation check
    private function changePasswordValidationCheck($request){
        $validationRule=[
            'oldPassword'=>'required',
            'newPassword'=>'required |min:8|max:15',
            'confirmPassword'=>'required|same:newPassword|min:8|max:15'
        ];
        Validator::make($request->all(),$validationRule)->validate();
    }

}
