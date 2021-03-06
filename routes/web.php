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

Route::get('/','PublicController@index');

//注册 登录 忘记密码
Auth::routes();

//发送验证码
Route::post('/sendValidatorCode', 'ValidatorController@sendValidatorCode');

//实名认证
Route::post('/verifiedUser', 'UsersController@verifiedUser');

//计算配资
Route::post('/computeFunding', 'UsersController@computeFunding');

//提交配资
Route::post('/fundingApplication', 'UsersController@fundingApplication');

//后台管理
Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

//首页
Route::get('/index', 'PublicController@index');

//实名认证
Route::get('/securityInfo','UsersController@securityInfo');

//个人信息
Route::get('/userinfo', function () {
    return view('home.userinfo');
});

//公司介绍
Route::get('/gsjs', function () {
    return view('home.gsjs');
});

//企业文化
Route::get('/qywh', function () {
    return view('home.qywh');
});

//企业风采
Route::get('/qyfc', function () {
    return view('home.qyfc');
});

//我要配资
Route::get('/wypz', function () {
    return view('home.wypz');
});

//月月有余
Route::get('/yyyouyu','UsersController@showFunding');

//登录页面
Route::get('/login', function () {
    return view('home.login');
});


//啥叫股票配资
Route::get('/sjgppz', function () {
    return view('home.sjgppz');
});

//股票咨询
Route::get('/gpzx', function () {
    return view('home.gpzx');
});

//股票资讯列表
Route::get('/gpzixun/{type}','PublicController@getList');



//啥叫期货配资
Route::get('/sjqhpz', function () {
    return view('home.sjqhpz');
});

//投资学院
Route::get('/tzxy','PublicController@getInvestmentList');

//公司优势列表
Route::get('/gsys','PublicController@getCompanyList');

//下载专区
Route::get('/xzzq', 'PublicController@getDownloadList');

//获取最新新闻
Route::post('/findNewsList','PublicController@findNewsList');

//验证是否登录
Route::post('/homeIslogin','PublicController@homeIslogin');

//验证手机号是否可行
Route::post('/verifyPhone','PublicController@verifyPhone');

//股票配资技巧
Route::get('/gppzjq','PublicController@getSkillList');

//股票配资解答
Route::get('/gppzjd','PublicController@getAnswerList');

//期货配资
Route::get('/qhpz','PublicController@getFundingList');

//期货配资解答
Route::get('/qhpzjd','PublicController@getQhpzjdList');

//机构评论
Route::get('/jgpl', 'PublicController@getQhpzjdList');

//名家观点
Route::get('/mjgd', 'PublicController@getFamousList');

//忘记密码
Route::get('/forgetpw', function () {
    return view('home.forgetpw');
});

//注册
Route::get('/register', function () {
    return view('home.register');
});

//公司介绍
Route::get('/gsjs', function () {
    return view('home.gsjs');
});

//配资流程
Route::get('/pzlc', function () {
    return view('home.pzlc');
});

//免责申明
Route::get('/mzsm', function () {
    return view('home.mzsm');
});


//站点地图
Route::get('/zddt', function () {
    return view('home.zddt');
});

//联系我们
Route::get('/lxwm', function () {
    return view('home.lxwm');
});

//详情模板
Route::get('/xiangqing/{type}/{id}', 'PublicController@getDetails');

