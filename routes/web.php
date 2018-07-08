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
//Auth::routes();

Route::get('/', function () {
    return view('welcome');
});

//Route::get('/login', function () {
//    return view('/auth/login');
//});

//认证路由
Route::group(['prefix'=>'auth'],function(){

    Route::get('login', 'Auth\LoginController@showLoginForm');  //获取登录界面视图

    Route::get('register', 'Auth\RegisterController@showRegistrationForm'); //获取注册页面视图

    Route::get('logout','Auth\LoginController@logout'); //退出登录
});



Route::get('/code/captcha/{tmp}','Auth\LoginController@captcha');//获取登录验证码


//登录权限页面路由
//Route::group(['middleware'=>'auth'],function (){
//    Route::post('/auth/login', 'Auth\LoginController@login');
//    Route::post('/auth/register', 'Auth\RegisterController@register');
//
//
//});


//管理员系统的登录、注册页面
Route::post('/auth/login', 'Auth\LoginController@login');
Route::post('/auth/register', 'Auth\RegisterController@register');
Route::get('/home', 'Admin\HomeController@index')->name('home');


//显示管理员用户页面
Route::get('/user', 'Admin\UserController@index');
//添加管理员信息
Route::post('/user', 'Admin\UserController@store');
//删除管理员信息
Route::post('/user/delete', 'Admin\UserController@delete');
//编辑管理员信息
Route::post('/user/edit', 'Admin\UserController@edit');
//搜索管理员信息
Route::post('/user/search', 'Admin\UserController@search');
//导出管理员表
Route::get('/user/export', 'Admin\UserController@export');






//显示驻村干部用户页面
Route::get('/cadre', 'Admin\CadreController@index');
//存储驻村干部信息
Route::post('/cadre', 'Admin\CadreController@store');
//更改驻村干部审核状态
Route::post('/cadre/editStatus', 'Admin\CadreController@editStatus');
//删除驻村干部信息
Route::post('/cadre/delete', 'Admin\CadreController@delete');
//编辑驻村干部信息
Route::post('/cadre/edit', 'Admin\CadreController@edit');
//搜索驻村干部信息
Route::post('/cadre/search', 'Admin\CadreController@search');



//显示个人评价表页面
Route::post('/comment', 'Admin\CommentController@index');
//编辑评论
Route::post('/comment/edit', 'Admin\CommentController@edit');
//增加评论
Route::post('/comment/add', 'Admin\CommentController@store');
//删除评论
Route::post('/comment/delete', 'Admin\CommentController@delete');


//显示总体评价表
Route::get('/comment_total', 'Admin\CommentTotalController@index');
//搜索总体评价表
Route::post('/comment/search', 'Admin\CommentTotalController@search');



//显示属地信息管理页面
Route::get('/area', 'Admin\AreaController@index');
//添加属地信息
Route::post('/area', 'Admin\AreaController@store');
//删除属地信息
Route::post('/area/delete', 'Admin\AreaController@delete');
//编辑属地信息
Route::post('/area/edit', 'Admin\AreaController@edit');
//搜索属地信息
Route::post('/area/search', 'Admin\AreaController@search');





//显示第一书记统计表首页
Route::get('/stats/firstCadre', 'Admin\StatsFirstCadreController@index');
//搜索第一书记
Route::post('/stats/firstCadre/search', 'Admin\StatsFirstCadreController@search');
//导出第一书记统计表
Route::get('/firstcadre/export', 'Admin\StatsFirstCadreController@export');
//显示省级驻村队员首页
Route::get('/stats/provinceCadre', 'Admin\StatsProvinceCadreController@index');
//搜索省级驻村队员
Route::post('/stats/provinceCadre/search', 'Admin\StatsProvinceCadreController@search');
//显示驻村名册干部首页
Route::get('/stats/villageCadre', 'Admin\StatsVillageCadreController@index');
//搜索驻村干部名册
Route::post('/stats/villageCadre/search', 'Admin\StatsVillageCadreController@search');
//显示驻村（不含第一书记）统计表
Route::get('/stats/nonfirstCadre', 'Admin\StatsNonFirstCadreController@index');



//统计表饼状图
Route::get('get_chart', 'Admin\StatsFirstCadreController@GetChartData_index');
Route::get('get_chart_data', 'Admin\StatsFirstCadreController@GetChartData');




/*-------------------------驻村干部管理系统-----------------------------------*/
//实现驻村干部登录界面
Route::get('/cadre/login', 'Cadre\CadreLoginController@showLoginForm');
Route::post('/cadre/login', 'Cadre\CadreLoginController@login');
//显示驻村干部用户首页
Route::get('/cadre/index', 'Cadre\CadreHomeController@index');
//驻村干部退出登录
Route::get('/cadre/logout', 'Cadre\CadreLoginController@logout');
//显示驻村干部用户资料
Route::get('/cadre/info', 'Cadre\IndexController@showInfo');
//修改驻村干部资料
Route::get('/cadre/editInfo', 'Cadre\IndexController@showEditInfo');
Route::post('/cadre/editInfo', 'Cadre\IndexController@editInfo');
//显示评论页面
Route::get('/cadre/comment', 'Cadre\IndexController@showComment');