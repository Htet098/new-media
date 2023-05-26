<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    //direct admin category page
   public function index(){
    $category =Category::get();
    return view('admin.category.index',compact('category'));
    }
    //create category
    public function createCategory(Request $request){
        // dd($request->all());
        $this->categoryValidationCheck($request);
        $data =$this->getCategoryData($request);
        Category::create($data);
        return back();
    }

    //category delete
    public function categoryDelete($id){
        // dd($id);
        Category::where('category_id',$id)->delete();
        return back()->with(['deleteSuccess'=>'Category Delete Success....']);

    }

    //category search
    public function categorySearch(Request $request){
        $category = Category::orWhere('title','LIKE','%'.$request->categorySearchKey.'%')
                            ->orWhere('description','LIKE','%'.$request->categorySearchKey.'%')
                            ->get();
        return view('admin.category.index',compact('category'));
    }

    //category edit
    public function categoryEdit($id){
        $category = Category::get();
        $updateData=Category::where('category_id',$id)->first();
        return view('admin.category.edit',compact('updateData','category'));

    }

    //category update
    public function updateCategory(Request $request,$id){
        $this->categoryValidationCheck($request);
        $data =$this->getCategoryData($request);
        Category::where('category_id',$id)->update($data);
        return back()->with(['updateSuccess'=>'Category Update Success']);
    }

    //get category data
    private function getCategoryData($request){
        return[
            'title' =>$request->categoryName,
            'description'=>$request->categoryDescription,
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ];
    }
    //category validation check
    private function categoryValidationCheck($request){
        $validationRules=[
            'categoryName'=>'required',
            'categoryDescription'=>'required'
        ];
        Validator::make($request->all(),$validationRules)->validate();
    }

}
