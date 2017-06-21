<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::resource('/','IndexController',[
                           'only' =>['index'],
                           'names'=>['index'=>'home'] 
                                      ]);
                                      
Route::resource('sitenews','SitenewsController',[
                           'parameters' => ['sitenews' => 'id']
                                                ]);                                      

Route::resource('posts','PostsController',[
                           'parameters' => ['posts' => 'id']
                                          ]);
                                          
Route::get('posts/cat/{cat_alias?}',['uses'=>'PostsController@index','as'=>'postsCat'])->where('postsCat','[\w]+');

Route::get('comments/{id_post?}/{idp?}',['uses'=>'CommentsController@index','as'=>'commentsAjax']);

Route::get('newscomments/{id_post?}/{idp?}',['uses'=>'NewsCommentsController@index','as'=>'newscommentsAjax']);

Route::resource('comment','CommentController',['only'=>['store']]);
Route::resource('newscomment','NewsCommentController',['only'=>['store']]);

Route::match(['get','post'],'/contacts',['uses'=>'ContactsController@index','as'=>'contacts']);

Route::get('news',['uses'=>'PostsController@allnews','as'=>'allnews']);
Route::get('review',['uses'=>'PostsController@allreview','as'=>'allreview']);
Route::get('opinion',['uses'=>'PostsController@allopinion','as'=>'allopinion']);
////////////////////////////////////////////////////
Route::auth();

Route::get('/home', 'HomeController@index');

//admin panel
Route::group(['prefix'=>'admin','middleware'=>'auth'],function(){
	Route::get('/',['uses'=>'Admin\IndexController@index','as'=>'adminIndex']);
	
	//articles
	Route::resource('/posts','Admin\PostsController');
	//articles
	Route::resource('/sitenews','Admin\SitenewsController');
	//permissions
	Route::resource('/permissions','Admin\PermissionsController');
	//menu
	Route::resource('/menus','Admin\MenusController');
	//users
	Route::resource('/users','Admin\UsersController');
});

