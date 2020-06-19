<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
use App\Image;

Route::get('/', function () {


    /*

    $images = image::all();
    foreach($images as $image){
        echo $image->image_path.'<br>';
        echo $image->description.'<br>';
        echo $image->user->name.' '.$image->user->surname.'<br>'; 
        echo '<hr>';

        if(count($image->comments) >=1){

            
            echo "<strong>Comentarios</strong><br>";
            foreach($image->comments as $comment){
                echo $comment->user->name.' '.$comment->user_surname.'<br>';
                echo $comment->content.'<br>';
            }
        }

        echo 'LIKES:'.count($image->likes);
        echo '<br>';
        
    }
    die();

    */

    return view('welcome');
});

//GENERALES
Auth::routes();
Route::get('/', 'HomeController@index')->name('home');

//USUARIOS
Route::get('/configuracion','UserController@config')->name('config');
Route::post('/user/update','UserController@update')->name('user.update');
Route::get('/user/avatar/{filename}','UserController@getImage')->name('user.avatar');
Route::get('/perfil/{id}', 'UserController@profile')->name('profile');
Route::get('user/index/{search?}', 'UserController@index')->name('user.index');


//IMAGEN
Route::get('/subir-imagen', 'ImageController@create')->name('image.create');
Route::post('/image/save', 'ImageController@save')->name('image.save');
Route::get('/image/file/{filename}', 'ImageController@getImage')->name('image.file');
Route::get('/imagen/{id}', 'ImageController@detail')->name('image.detail');
Route::get('image/delete/{id}', 'ImageController@delete')->name('image.delete');
Route::get('image/edit/{id}', 'ImageController@edit')->name('image.edit');
Route::post('image/update', 'ImageController@update')->name('image.update');

//COMENTARIOS
Route::post('/comment/save', 'CommentController@save')->name('comment.save');
Route::get('/comment/delete/{id}', 'CommentController@delete')->name('comment.delete');

//LIKES
Route::get('/like/{image_id}', 'LikeController@like')->name('like.save');
Route::get('/dislike/{image_id}', 'LikeController@dislike')->name('like.delete');
Route::get('/likes', 'LikeController@index')->name('likes');

