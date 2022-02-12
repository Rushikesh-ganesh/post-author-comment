<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PostModel;
use Illuminate\Support\Facades\Validator;
use Auth;
use Redirect,Response;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('edit_post');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post_data =  PostModel::where('id',$id)->first();
        if($post_data){
            return view('edit_post',compact('post_data'));
        }else{
            return redirect()->route('home')->with('error','Data not found');      
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if($id){
             PostModel::where('id',$id)->delete();
             return Response::json(['success'=>'Post Deleted Successfully.']);
        }else{
            return Response::json(['error'=>'Post Not Deleted Successfully.']);  
        }
    }
}
