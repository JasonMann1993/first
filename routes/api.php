<?php


$api = app('Dingo\Api\Routing\Router');

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



$api->version('v1', ['prefix' => '/api', 'namespace' => 'App\Api\Controllers'], function ($api) {
    # 开锁
    $api->get('unlock', 'UnlockController@index');
    $api->post('unlock/publish', 'UnlockController@publish');

//    #
//    $api->get('users/{id}', 'UserController@show');

    # 搬家
    $api->get('housemoving', 'HouseMovingController@index');
    $api->post('housemoving/publish', 'HouseMovingController@publish');

    # 租房
    $api->get('rental', 'RentalController@index');
    $api->post('rental/publish', 'RentalController@publish');

    # 回收
    $api->get('recovery', 'RecoveryController@index');
    $api->post('recovery/publish', 'RecoveryController@publish');

    # 送水
    $api->get('deliverwater', 'DeliverWaterController@index');
    $api->post('deliverwater/publish', 'DeliverWaterController@publish');

    # 煤气
    $api->get('coalgass', 'CoalGassController@index');
    $api->post('coalgass/publish', 'CoalGassController@publish');

    # 公厕
    $api->get('publictoilet', 'PublicToiletController@index');
    $api->post('publictoilet/publish', 'PublicToiletController@publish');
    #喜欢
    $api->post('like', 'LikeController@audit');

//    $api->get('search/get', 'SearchController@getlist');

    # 投诉
    $api->post('complaints','ComplaintsController@publish');
    $api->get('reasons','ComplaintsController@getReasons');

    # 获取用户openid
    $api->get('user/getOpenid','UserController@getOpenid');
    # 添加用户
    $api->post('user','UserController@handleUser');

    # 热门搜索
    $api->get('search/hot','SearchController@hot');
    # 搜索
    $api->post('search','SearchController@search');

});


