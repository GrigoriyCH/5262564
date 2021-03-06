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

Route::get('posts/aut/{Aut_alias?}',['uses'=>'PostsController@author','as'=>'postsAut'])->where('postsAut','[\w]+');

Route::get('search',['uses'=>'PostsController@search','as'=>'search']);

Route::get('rules',['uses'=>'SitenewsController@siterules','as'=>'rules']);

Route::get('comments/{id_post?}/{idp?}',['uses'=>'CommentsController@index','as'=>'commentsAjax']);

Route::get('newscomments/{id_post?}/{idp?}',['uses'=>'NewsCommentsController@index','as'=>'newscommentsAjax']);

Route::resource('comment','CommentController',['only'=>['store']]);
Route::resource('newscomment','NewsCommentController',['only'=>['store']]);

Route::match(['get','post'],'/contacts',['uses'=>'ContactsController@index','as'=>'contacts']);

Route::get('news',['uses'=>'PostsController@allnews','as'=>'allnews']);
Route::get('review',['uses'=>'PostsController@allreview','as'=>'allreview']);
Route::get('different',['uses'=>'PostsController@alldifferent','as'=>'allopinion']);
/**/
Route::get('rss-animation',['uses'=>'RssController@animation','as'=>'rss-animation']);
Route::get('rss-movies',['uses'=>'RssController@movies','as'=>'rss-movies']);
Route::get('dzen-rss',['uses'=>'RssController@dzen','as'=>'dzen-rss']);
/**/
Route::auth();
/*
Route::get('/home', 'HomeController@index');
*/
//admin panel
Route::group(['prefix'=>'admin','middleware'=>'auth'],function(){
	Route::get('/',['uses'=>'Admin\IndexController@index','as'=>'adminIndex']);
	
	//articles
	Route::resource('/posts','Admin\PostsController');
	//sitenews
	Route::resource('/sitenews','Admin\SitenewsController');
	//permissions
	Route::resource('/permissions','Admin\PermissionsController');
	//menu
	Route::resource('/menus','Admin\MenusController');
	//users
	Route::resource('/users','Admin\UsersController');
});

Route::group(['prefix'=>'user','middleware'=>'auth'],function(){
	Route::get('/',['uses'=>'User\IndexController@index','as'=>'userIndex']);
	
	//articles
	Route::get('/post/edit',function(){
		return redirect('/user');/*extra redirect*/
	});
	
	Route::resource('/post','User\PostController');
	
	Route::resource('/name', 'User\NameAvatarController');
});

