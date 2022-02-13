<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PostModel;
use Illuminate\Support\Facades\Validator;
use Auth;
use Redirect,Response;
use App\Models\PostCommentModel;

class PostController extends Controller
{
   
    public function index()
    {
        //
    }

    
    public function create()
    {
        return view('edit_post');
    }

  
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'post_title' => 'required|regex:/(^[A-Za-z0-9 ]+$)+/|max:255',
            'post_description' => 'required',
        ]);
 
        if ($validator->fails()) {
            return redirect('/create_post')
                        ->withErrors($validator)
                        ->withInput();
        }

        $data_stored =  PostModel::create(['post_title'=>$request->post_title,'post_description'=>$request->post_description,'author_id'=>Auth::user()->id]);

         if($data_stored){
            return redirect()->route('home')->with('success','Post has been created successfully.');
         }else{
            return redirect()->route('home')->with('error','Somthing Went Wrong.');
         }

    }

   
    public function show($id)
    {

      $post_data = PostModel::where('id',$id)->with(['Author','comments'=>function($q){
           $q->with('commented_by');
      }])->first();
    //   dd($post_data);
      return view('show_post',compact('post_data'));
    }

    
    public function edit($id)
    {
        $post_data =  PostModel::where('id',$id)->first();
        if($post_data){
            return view('edit_post',compact('post_data'));
        }else{
            return redirect()->route('home')->with('error','Data not found');      
        }
    }

    
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'post_title' => 'required|regex:/(^[A-Za-z0-9 ]+$)+/|max:255',
            'post_description' => 'required',
        ]);
 
        if ($validator->fails()) {
            return redirect(route('edit_post',$id))
                        ->withErrors($validator)
                        ->withInput();
        }

        $data_stored =  PostModel::where('id',$id)->update(['post_title'=>$request->post_title,'post_description'=>$request->post_description]);

         if($data_stored){
            return redirect()->route('home')->with('success','Post has been Updated successfully.');
         }else{
            return redirect()->route('home')->with('error','Somthing Went Wrong.');
         }
    }

  
    public function destroy($id)
    {
        if($id){
             PostModel::where('id',$id)->delete();
             return Response::json(['success'=>'Post Deleted Successfully.']);
        }else{
            return Response::json(['error'=>'Post Not Deleted Successfully.']);  
        }
    }


    public function commentStore(Request $request,$id){
        $validator = Validator::make($request->all(), [
            'comment_post' => 'required',
        ]);
 
        if ($validator->fails()) {
            return redirect(route('edit_post',$id))
                        ->withErrors($validator)
                        ->withInput();
        }

        $data_stored =  PostCommentModel::create(['post_comment'=> $request->comment_post,'post_id'=>$id ,'user_id' => Auth::user()->id]);

         if($data_stored){
            return redirect()->route('show',$id)->with('success','Comment has been Added successfully.');
         }else{
            return redirect()->route('show',$id)->with('error','Somthing Went Wrong.');
         }
    }
    public function commentDelete($id)
    {
        if($id){
            PostCommentModel::where('id',$id)->delete();
             return Response::json(['success'=>'Comment Deleted Successfully.']);
        }else{
            return Response::json(['error'=>'Comment Not Deleted Successfully.']);  
        }
    }
    
}
