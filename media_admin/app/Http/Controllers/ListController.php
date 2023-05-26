<?php

namespace App\Http\Controllers;

// use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ListController extends Controller
{
   //direct admin list page
   public function index(){
    $userData= User::get();
    return view('admin.list.index',compact('userData'));

    }

    //delete admin account
    public function deleteAccount($id){
        User::where('id',$id)->delete();
        return back()->with(['deleteSuccess'=>'Admin Account Delete Success....']);

    }

    //list search
    public function adminListSearch(Request $request){
        $userData = User::orWhere('name','LIKE','%'.$request->adminSearchKey.'%')
        ->orWhere('email','LIKE','%'.$request->adminSearchKey.'%')
        ->orWhere('phone','LIKE','%'.$request->adminSearchKey.'%')
        ->orWhere('address','LIKE','%'.$request->adminSearchKey.'%')
        ->orWhere('gender','LIKE','%'.$request->adminSearchKey.'%')
        ->get();
        // dd($searchData->toArray());
         return view('admin.list.index',compact('userData'));
    }
    //admin account edit
    public function adminAccountEdit($id){
        // $user = User::get();
        $user =User::where('id',$id)->first();
        // dd($userEdit);
        return view('admin.list.edit',compact('user'));
    }

    //admin account edit update

    public function adminAccountEditUpdate(Request $request){
        // $userData = $this->getUserInfo($request);
        $validator = $this->adminAccountValidation($request);
        dd($request->all());
        return back();
    }

//  //request admin data
//  private function getUserInfo($request){
//     return[
//         'name' =>$request->adminName,
//         'email'=>$request->adminEmail,
//         'phone'=>$request->adminPhone,
//         'address'=>$request->adminAddress,
//         'gender'=>$request->adminGender,
//         'updated_at'=>Carbon::now(),
//     ];
// }
    //admin account validation
    private function adminAccountValidation($request){
        $validationRule =[
            'name'=>'required',
            'email'=>'required',
            'phone'=>'required',
            'address'=>'required',
            'gender'=>'required |empty'
        ];
        Validator::make($request->all(),$validationRule)->validate();

    }
}
