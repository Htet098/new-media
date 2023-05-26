<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    //get all post
    public function getAllPost(){
        $post = Post::get();
       return response()->json([
        'status'=>'success',
        'post'=>$post
       ]);
    }
    //post search
    public function postSearch(Request $request){
        // Logger($request->all());
        $post = Post::where('title','LIKE','%'.$request->key.'%')->get();
        return response()->json([
            'searchData' =>$post
        ]);
    }

    //post details
public function postDetails(Request $request,){
    // logger($newsId);
    $id = $request->PostId;
//    logger($request->PostId);

    $post =Post::where('post_id',$id)->first();
    // $post =Post::get();
    return response()->json([
        'post'=>$post
    ]);
    // return response()->json(['Post', $post]);
}}
