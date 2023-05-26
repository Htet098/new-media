<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    //direct admin post page
   public function index(){
    $category= Category::get();
    $post =Post::get();
    return view('admin.post.index',compact('category','post'));
 }
 //category search
 public function postSearch(Request $request){
    $category = Category::orWhere('title','LIKE','%'.$request->categorySearchKey.'%')
    ->orWhere('description','LIKE','%'.$request->categorySearchKey.'%')
    ->get();
    $post = Post::orWhere('title','LIKE','%'.$request->postSearchKey.'%')
                        ->orWhere('description','LIKE','%'.$request->postSearchKey.'%')
                        ->get();
    return view('admin.post.index',compact('post','category'));
}
//post create
 public function createPost(Request $request){
    $this->postValidationCheck($request);
    if(!empty($request->file('postImage'))){
        $file= $request->file('postImage');
        $fileName = uniqid().'_'.$file->getClientOriginalName();
        $file->move(public_path().'/postImage',$fileName);
        $data = $this->getPostData($request,$fileName);
    }else{
        $data = $this->getPostData($request,null);
    }
  ;
    // dd($data);
    Post::create($data);
    return back();
 }
//delete post
 public function deletePost($id){
    // dd($id);
    $postData= Post::where('post_id',$id)->first();
    $dbImageName = $postData['image'];
    Post::where('post_id',$id)->delete();

    if(File::exists(public_path().'/postImage/'.$dbImageName)){
        // dd('image have');
        File::delete(public_path().'/postImage/'.$dbImageName);
    }
    return back();
 }
//update post page
 public function updatePostPage($id){
    $category =Category::get();
    $post=Post::get();
    $updatePost=Post::where('post_id',$id)->first();
    // dd($updatePost);
    return view('admin.post.update',compact('category','post','updatePost'));
 }
//update post
 public function updatePost($id,Request $request){
    // dd($request->postImage);
    $this->postValidationCheck($request);
    $data = $this->requestUpdatePostData($request);
    if(isset($request->postImage)){
        $this->storeNewUpdateImage($id,$request,$data);
        // dd('true');
    }else{
       Post::where('post_id',$id)->update($data,);
        // dd('false');
    }
     return back();
 }
 //store new update image
 private function storeNewUpdateImage($id,$request,$data){
    //get client data
    $file=$request->file('postImage');
    // dd($file);
    $fileName = uniqid().'_'.$file->getClientOriginalName();

    //put new image to data array
    $data['image']=$fileName;

    //get image name form database
    $postData=Post::where('post_id',$id)->first();
    $dbImageName=$postData['image'];


    //delete image from public folder
    if(File::exists(public_path().'/postImage/'.$dbImageName)){
        File::delete(public_path().'/postImage/'.$dbImageName);
    }
    //store new image in public folder
    $file->move(public_path().'/postImage',$fileName);
    //update new data with new image
    Post::where('post_id',$id)->update($data);
}
//update post date
 private function requestUpdatePostData($request){
  return[
    'title'=>$request->postName,
    'description'=>$request->postDescription,
    'category_id'=>$request->postCategory,
    'created_at'=>Carbon::now(),
    'updated_at'=>Carbon::now()
  ];
 }

//get post data
 private function getPostData($request,$fileName){
    return [
        'title' =>$request->postName,
        'description' =>$request->postDescription,
        'image'=>$fileName,
        'category_id'=>$request->postCategory,
        'created_at'=>Carbon::now(),
        'updated_at'=>Carbon::now()
    ];
 }
//validation create post
 private function postValidationCheck($request){
    $validationRule = [
        'postName'=>'required',
        'postDescription'=>'required',
        'postCategory'=>'required',
    ];
    Validator::make($request->all(),$validationRule)->validate();

 }
}
