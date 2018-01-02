<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the 'web' middleware group. Now create something great!
|
*/

Route::get("/",'IndexController@index');
Route::get("/a/{id}",'IndexController@index');
Route::get("/show/{id}","IndexController@show");

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home') ;

//后台
Route::group(['prefix' => 'admin','namespace' => 'Admin'],function ($router)
{

    $router->get('login', 'LoginController@showLoginForm')->name('admin.login');
    $router->post('login', 'LoginController@login');
    $router->post('logout', 'LoginController@logout');
    $router->any('logout', 'LoginController@logout');
    $router->get('welcome', 'WelcomeController@index');


    //网站设置
    $router->get('webInfo','SetController@webInfo');
    $router->post('saveWebInfo','SetController@saveWebInfo');

    //导航
    $router->get('navSet','SetController@navSet');
    $router->get('addNav',function(){ return view('admin/addNav');});
    $router->post('saveNav','SetController@saveNav')->name('admin.saveNav');
    $router->post('saveEditNav','SetController@saveEditNav')->name('admin.saveEditNav');
    $router->get('editNav/{id}','SetController@editNav');
    $router->get('delNav/{id}','SetController@delNav');
    $router->get('addSonNav/{id}','SetController@addSonNav');

    //幻灯片
    $router->get('webImgSet','SetController@webImgSet');
    $router->get('addWebImg',function(){ return view('admin/addWebImg');});
    $router->get('editWebImages/{id}','SetController@editWebImages');
    $router->post('saveEditWebImg','SetController@saveEditWebImg')->name('admin.saveEditWebImg');
    $router->post('saveWebImg','SetController@saveWebImg')->name('admin.saveWebImg');
    $router->get('delImage/{id}','SetController@delImage');
    $router->get('webImgPositionSet/{id}','SetController@webImgPositionSet');
    $router->get('addWebImagesPosition/{id}','SetController@addWebImagesPosition');
    $router->post('saveWebImagePosition','SetController@saveWebImagePosition')->name('admin.saveWebImagePosition');
    $router->get('delImagePosition/{id}','SetController@delImagePosition');
    $router->get('editWebImagesPosition/{id}','SetController@editWebImagesPosition');
    $router->post('saveEditWebImagesPosition','SetController@saveEditWebImagesPosition');

    //友情链接
    $router->get('webLinkSet','SetController@webLinkSet');
    $router->get('addWebLink','SetController@addWebLink');
    $router->get('delWebLink/{id}','SetController@delWebLink');
    $router->post('saveWebLink','SetController@saveWebLink');
    $router->get('editWebLink/{id}','SetController@editWebLink');
    $router->post('saveEditWebLink','SetController@saveEditWebLink');

    //用户设置
    $router->get('webUser','UserController@webUser');
    $router->get('addUser','UserController@addUser');
    $router->get('delUser/{id}','UserController@delUser');
    $router->get('editUser/{id}','UserController@editUser');
    $router->post('saveUser','UserController@saveUser');
    $router->post('saveEditUser','UserController@saveEditUser');

    //信息管理
    $router->get('article','MsgController@article');
    $router->get('addArticle','MsgController@addArticle');
    $router->get('delArticle/{id}','MsgController@delArticle');
    $router->get('editArticle/{id}','MsgController@editArticle');
    $router->post('saveArticle','MsgController@saveArticle');
    $router->post('saveEditArticle','MsgController@saveEditArticle');
    $router->post('editUploadImg','MsgController@editUploadImg');
    $router->get('articleCate','MsgController@articleCate');
    $router->get('addArticleCate','MsgController@addArticleCate');
    $router->get('addArticleCate/{id}','MsgController@addArticleCate');
    $router->post('saveArticleCate','MsgController@saveArticleCate');
    $router->post('saveEditArticleCate','MsgController@saveEditArticleCate');
    $router->get('delArticleCate/{id}','MsgController@delArticleCate');
    $router->get('editArticleCate/{id}','MsgController@editArticleCate');

    //单页
    $router->get('page','MsgController@page');
    $router->get('addPage','MsgController@addPage');
    $router->get('delPage/{id}','MsgController@delPage');
    $router->get('editPage/{id}','MsgController@editPage');
    $router->post('savePage','MsgController@savePage');
    $router->post('saveEditPage','MsgController@saveEditPage');

    //投票问卷
    $router->get('vote','MsgController@vote');
    $router->get('addVote','MsgController@addVote');
    $router->get('delVote/{id}','MsgController@delVote');
    $router->get('editVote/{id}','MsgController@editVote');
    $router->post('saveEditVote','MsgController@saveEditVote');
    $router->post('saveVote','MsgController@saveVote');
    $router->get('voteInfo/{id}','MsgController@voteInfo');
    $router->get('addVoteInfo/{id}','MsgController@addVoteInfo');
    $router->post('saveVoteInfo','MsgController@saveVoteInfo');
    $router->get('delVoteInfo/{id}/{vid}','MsgController@delVoteInfo');
    $router->get('editVoteInfo/{id}/{vid}','MsgController@editVoteInfo');
    $router->post('saveEditVoteInfo','MsgController@saveEditVoteInfo');
    $router->get('lookVote/{id}','MsgController@lookVote');
    $router->get('viewVote/{id}','MsgController@viewVote');

    $router->get('message','MsgController@message');

    //其他设置
    $router->get('adminSet','AdminSetController@adminSet');
    $router->get('addAdmin','AdminSetController@addAdmin');
    $router->get('delAdmin/{id}','AdminSetController@delAdmin');
    $router->get('editAdmin/{id}','AdminSetController@editAdmin');
    $router->post('saveAdmin','AdminSetController@saveAdmin');
    $router->post('saveEditAdmin','AdminSetController@saveEditAdmin');
});
