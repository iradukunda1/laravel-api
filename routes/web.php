<?php

use App\Post;
use App\User;
use App\Country;
use App\Photo;
use App\Tag;
use Carbon\Carbon;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
 Route::get("/", "Controller@home");
 Route::get("/post/{id}" , "Controller@showPost");

 Route::get('/',array( 'as' => 'Welcome' ,function () {
     return view('welcome');
 }));

//Create Route With params and provide it a name

  Route::get('/post/{id}', array('as'=>'Post',function($id) {
     return "This my post Number". $id;
  }));


/*
|--------------------------------------------------------------------------
| SQL Raw For Posts Table To CRUD Action
|--------------------------------------------------------------------------
|
*/
//Insert data into posts table
 Route::get('/insert',function(){

     DB::insert('insert into posts(title,content) values(?, ?)', ['Laravel is awesome','laravel is the best awesome frame work']);
 });

 Route::get('/read',function(){

     $result = DB::select('select * from posts where id=?',[1]);

     foreach( $result as $post){

        return $post->content;

     }
 });

 Route::get('/update',function(){

     $updated = DB::update('update posts set title = "Updated title" where id = ?',[1]);

     return $updated;

 });
 Route::get('/delete', function(){

     $delete = DB::delete('delete from posts where id = ?', [1]);

     return $delete;

 });


/*
|--------------------------------------------------------------------------
| Eloquent (ORM) Find All DB record using model
|--------------------------------------------------------------------------
|
*/

 Route::get('/read', function(){
     $post = Post::all() ;

     foreach( $post as $pos){
         return $pos->title;
     }
 });
 Route::get('/find',function(){

     $result = Post::find(2);
     return $result->title;
 });


 Route::get('/findWhere',function(){

     $result = Post::where('id',2)->orderBy('id','desc')->take(1)->get() ;
     return $result;
 });

 Route::get('/findmore', function(){

     // $posts = Post::findOrFail(1);
     // return $posts;
     $posts = Post::where('users_count','<', 50)->firstOrFail();
 });

//insert data using eloquent which is the best
 Route::get('/basicinsert', function(){
     $post = new Post;
     $post->title = "New ORM Eloquent insert";
     $post->content = "Woow eloquent is super cool";
     $post->save();
 });

//update using eloquent
 Route::get('/basicupdate', function(){
     $post = Post::find(4);
     $post->title = "New ORM Eloquent updated";
     $post->content = "Woow eloquent is super cool look the update";
     $post->save();

 });

//create mostly used in forms
 Route::get('/create',function(){
     Post::create(['title'=>'the create method','content'=>'Woow I\' am learning alot php']);
 });

//update form data
 Route::get('/update', function(){
     Post::where('id',2)->where('is_admin',0)->update(['title'=>'New Php Title','content'=>'New PHP content for laravel']);
 });

//delete using eloquent
 Route::get('/delete', function(){
     Post::where('id',3)->delete();
 });

//delete multiple item using eloquent using id
 Route::get('/delete', function(){
     Post::destory([2,4]);
 });

 Route::get('/softdelete', function(){
     Post::find(4)->delete();
 });

//read deleted object
 Route::get('/softread',function(){
     //read all item item include deleted
    $result = Post::withTrashed()->where('is_admin',0)->get();
     //read only deleted item
    $result = Post::onlyTrashed()->where('is_admin',0)->get();
    return $result;
 });

//restore deleted item
 Route::get('/restore', function(){
     Post::onlyTrashed()->where('is_admin', 0)->restore();
 });

//delete item parmanentely
 Route::get('/forcedelete', function(){
     Post::onlyTrashed()->where('is_admin',0)->forceDelete();
 });

/*
|--------------------------------------------------------------------------
| Eloquent Relation ship
|--------------------------------------------------------------------------
|
*/

//one to one relationships
 Route::get('/user/{user_id}/post', function($user_id){
     return User::find($user_id)->post;
 });

// //reveser relationship for one to one
 Route::get('/post/{id}/user',function($id){
     return Post::find($id)->user->name;
 });

//one to many relation ship
 Route::get('/posts', function(){
     $result = User::find(1);
     foreach($result->posts as $post){
        echo $post->title ."<br>";
     }
 });

//Many to Many relationship
 Route::get('/user/{id}/role', function($id){
   $users = User::find($id);
   foreach($users->roles as $role){
       echo $role . "</br>";
   }

 });

// //Accessing the pivot table / intermediate table
 Route::get('/user/pivot',function(){
     $users = User::find(1);

     foreach($users->roles as $role){
         echo $role->pivot->created_at ."<br>";
     }
 });

// //find post using country id
 Route::get('user/country',function(){

     $country = Country::find(1);

     foreach($country->posts as $post){
         echo $post->title ."<br>";
     }
 });

// //Polymorphic Relationship
 Route::get('user/photo', function(){
     $user = User::find(1);
     foreach($user->photos as $photo){
         return $photo;
     }
 });
 Route::get('post/{id}/photo', function($id){
     $post = Post::find($id);
     foreach($post->photos as $photo){
         echo $photo ."<br>";
     }
 });

 Route::get('/photo/{id}/user',function($id){
   $photo = Photo::findOrFail($id);
     echo $photo->imageable ."<br>";
 });

//Polymorphic Many to Many
Route::get('/post/tag', function(){
    $post = Post::find(1);
    foreach($post->tags as $tag){
        echo $tag->name ."<br>";
    }
});
Route::get('/tag/post', function(){
    $tag = Tag::find(2);
    foreach($tag->posts as $post){
        echo $post ."<br>";
    }
});

/*
|--------------------------------------------------------------------------
| CRUD Application with Form
|--------------------------------------------------------------------------
|
*/
//route for crud which also has middleware for security as protection and error handle control

Route::group(['middleware'=>'web'], function (){
    Route::resource('/posts','Controller');
    Route::get('/dates',function (){
        $date = new DateTime('+1 week');
        echo $date->format('d-y-m');
        echo'<br>';
        echo Carbon::now()->yesterday();
    });
});

//route for getting data after manipulation
Route::get('getname', function (){
    $user = User::find(1);
        echo $user->name;
});
//route for save name with first UpperCase mutator
Route::get('setname', function (){
    $user = User::find(1);
     $user->name = 'iradukunda jean de Dieu';
    $user->save();
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
