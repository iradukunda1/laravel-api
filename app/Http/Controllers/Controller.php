<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePostRequest;
use App\Post;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function home(){
        return view("welcome");
    }
    //import createPostRequest which contain guards for required input
    public  function  store(CreatePostRequest $request){
//        $file = $request->file('file');
//        echo '<br>';
//        return $file->get();
//        return $request->title;
//        Post::create($request->all());
        $post = new Post();
        $post->title =  $request->title;
        $post->save();
        return redirect('posts');
    }
    public function  index(){
        $posts = Post::latest()->get();
        return  view('posts.index',compact('posts'));
    }
    public function  create(){
        return view('posts.create');
    }
    public function  show($id){
        $post = Post::findOrFail($id);
        return view('posts.show', compact('post'));
    }
    public function  update(Request $request ,$id){
        $post = Post::findOrFail($id);
       $post->update($request->all());
       return redirect('/posts');

    }
    public function  edit($id){
        $post = Post::findOrFail($id);
        return view('posts.edit',compact('post'));
    }
    public function  destroy($id){
        $post = Post::findOrFail($id);
        $post->delete();
        return redirect('/posts');
    }

    public function showPost($id){

//         return view("post")->with('id',$id);
        $people = ["Fred","Shema","Sheja","Alain"];
        return view("post", compact('id',"people"));

    }
}
