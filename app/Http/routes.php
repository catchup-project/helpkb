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

Route::controllers([
  'auth' => 'Auth\AuthController',
  'password' => 'Auth\PasswordController',
]);



/* 404 page */
// Route::get('404', 'error\ErrorController@error404');
/*
 |============================================================= 
 |  Error Routes
 |=============================================================
 */
Route::get('503', function () {
  return view('errors.503');
});
Route::get('404', function () {
  return view('errors.404');
});




/*
|-------------------------------------------------------------------------------
| Admin Routes
|-------------------------------------------------------------------------------
| Here is defining entire routes for the Admin Panel
|
 */

/*
|------------------------------------------------------------------
|Agent Routes
|--------------------------------------------------------------------
| Here defining entire Agent Panel routers
|
|
 */

$router->group(['prefix' => '/admin', 'middleware' => 'auth'], function () {

/*  For the crud of catogory  */
Route::resource('category', 'Agent\kb\CategoryController');
Route::get('category/delete/{id}', 'Agent\kb\CategoryController@destroy');



/*  For the crud of article  */
Route::resource('article', 'Agent\kb\ArticleController');
Route::get('article/delete/{id}', 'Agent\kb\ArticleController@destroy');


Route::resource('page', 'Agent\kb\PageController');
Route::get('get-pages', ['as' => 'api.page', 'uses' => 'Agent\kb\PageController@getData']);
Route::get('page/delete/{id}', ['as' => 'pagedelete', 'uses' => 'Agent\kb\PageController@destroy']);


/* get settings */
Route::get('kb/settings', ['as' => 'settings', 'uses' => 'Agent\kb\SettingsController@settings']);
/* post settings */
Route::patch('postsettings/{id}', 'Agent\kb\SettingsController@postSettings');




Route::get('get-articles', ['as' => 'api.article', 'uses' => 'Agent\kb\ArticleController@getData']);
Route::get('get-categorys', ['as' => 'api.category', 'uses' => 'Agent\kb\CategoryController@getData']);

Route::post('image', 'Agent\kb\SettingsController@image');
});



/* get the article list */
Route::get('article-list', ['as' => 'article-list', 'uses' => 'Client\kb\UserController@getArticle']);
// /* get search values */
Route::get('search', ['as' => 'search', 'uses' => 'Client\kb\UserController@search']);
/* get the selected article */
Route::get('show/{slug}', ['as' => 'show', 'uses' => 'Client\kb\UserController@show']);
Route::get('category-list', ['as' => 'category-list', 'uses' => 'Client\kb\UserController@getCategoryList']);
/* get the categories with article */
Route::get('category-list/{id}', ['as' => 'categorylist', 'uses' => 'Client\kb\UserController@getCategory']);




/* get the home page */
Route::get('/', ['as' => 'home', 'uses' => 'Client\kb\UserController@home']);
Route::get('knowledgebase', ['as' => 'home', 'uses' => 'Client\kb\UserController@home']);

/* get the cantact page to user */
Route::get('contact', ['as' => 'contact', 'uses' => 'Client\kb\UserController@contact']);
/* post the cantact page to controller */
Route::post('post-contact', ['as' => 'post-contact', 'uses' => 'Client\kb\UserController@postContact']);

//to get the value for page content
Route::get('p/{name}', ['as' => 'pages', 'uses' => 'Client\kb\UserController@getPage']);


