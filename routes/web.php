<?php

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

// Route::get('/', function () {
// 	$name="hello 1908";
//     return view('welcome',['name'=>$name]);
// });

// Route::get('/user', 'UsersController@index');
// Route::get('/add', 'UsersController@add');
// Route::post('/adddo', 'UsersController@adddo');
// //必选参数
// Route::get('/goods/{id}', function ($goods_id) {
// 	echo $goods_id;
// });	
// //可选参数
// Route::get('goods/{name?}', function ($name = null) {
// 	echo "再见";
// echo  $name;
// });
//作业

// Route::get('/show', 'UsersController@index');
// Route::view('/shows','index');
// Route::get('/show/{id}', function ($goods_id) {
// 	echo $goods_id;
// });	
// Route::get('/show/{id}/{name}', function ($goods_id,$name) {
// 	echo $goods_id;
// 	echo $name;
// })->where(['name'=>'\w+']);
// Route::get('/brand', 'UsersController@add');
// Route::view('/brands','add');
// Route::get('/category', 'UsersController@adds');
// Route::post('/category', 'UsersController@addsdo')->name('do');

// Route::view('/categorys','adds',['fid'=>'服装']);
 Route::prefix('people')->middleware('Checklogin')->group(function(){
    Route::get('create','PeopleController@create');
    Route::post('store','PeopleController@store');
    Route::get('index','PeopleController@index');
    Route::get('edit/{id}','PeopleController@edit');
    Route::post('update/{id}','PeopleController@update');
    Route::get('destroy/{id}','PeopleController@destroy');

});

Route::prefix('news')->group(function(){
    Route::get('create','NewsController@create');
    Route::post('store','NewsController@store');
    Route::get('index','NewsController@index');
    Route::get('show/{id}','NewsController@show');
    Route::get('edit/{id}','NewsController@edit');
    Route::post('update/{id}','NewsController@update');
    Route::get('destroy','NewsController@destroy');
    Route::post('checkonly','NewsController@checkonly');

});

Route::prefix('goods')->group(function(){
    Route::get('create','GoodsController@create');
    Route::post('store','GoodsController@store');
    Route::get('index','GoodsController@index');
    Route::get('edit/{id}','GoodsController@edit');
    Route::post('update/{id}','GoodsController@update');
    Route::get('destroy/{id}','GoodsController@destroy');
    Route::post('checkonly','GoodsController@checkonly');

});

Route::prefix('card')->group(function(){
    Route::get('login','CardController@login');
    Route::post('logindo','CardController@logindo');
    Route::get('index','CardController@index');
    Route::get('edits/{id}','CardController@edits');
    Route::post('update/{id}','CardController@update');
    Route::get('destroy/{id}','CardController@destroy');
    Route::post('checkonly','CardController@checkonly');

});

Route::get('/index', 'index\IndexController@index');
Route::get('/car', 'index\CarController@car');
Route::get('/addcar', 'index\CarController@addcar');
Route::get('/login', 'index\LoginController@login');
Route::post('/login_do', 'index\LoginController@login_do');
Route::get('/register', 'index\RegisterController@register');
Route::get('/ajaxsend', 'index\RegisterController@ajaxsend');
Route::post('/register_do', 'index\RegisterController@register_do');
Route::get('/prolist/{id}', 'index\ProlistController@prolist');
Route::get('/setcookie', 'index\LoginController@setcookie');
Route::get('/proinfo/{id}', 'index\ProinfoController@proinfo');


//Route::get('/login', 'LoginController@login');
//Route::post('/login/logindo', 'LoginController@logindo');

//Route::get('/register', 'Register@register');
//Route::post('/register/registerdo', 'Register@registerdo');
//Route::get('/register/index', 'Register@index');
//Route::get('/register/edit/{id}','Register@edit');
//Route::post('/register/update/{id}','Register@update');
//Route::get('/register/destroy/{id}','Register@destroy');
//Route::post('/register/checkonly','Register@checkonly');
//
//
//Route::prefix('student')->group(function(){
//    Route::get('create','StudentController@create');
//    Route::post('store','StudentController@store');
//    Route::get('index','StudentController@index');
//    Route::get('edit/{id}','StudentController@edit');
//    Route::post('update/{id}','StudentController@update');
//    Route::get('destroy','StudentController@destroy');
//
//});
//
//Route::prefix('brand')->group(function(){
//    Route::get('create','BrandController@create');
//    Route::post('store','BrandController@store');
//    Route::get('index','BrandController@index');
//    Route::get('edit/{id}','BrandController@edit');
//    Route::post('update/{id}','BrandController@update');
//    Route::get('destroy/{id}','BrandController@destroy');
//
//});
//



