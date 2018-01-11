<?php

/**
 * 后台路由
 */

# 首页
Route::get('/manage/user/login', 'Manage\UsersController@loginPage');
Route::post('/manage/user/login', 'Manage\UsersController@login');
Route::get('/redis','Manage\UsersController@redis');
Route::group(['prefix' => '/manage', 'namespace' => 'Manage', 'middleware' => 'login'], function ($app) {
    # 首页
    $app->get('/', 'Home\IndexController@index');
    # Menu
    $app->resource('menu', 'Home\MenuController');

    # Service
    $app->group(['prefix' => 'service', 'namespace' => 'Service'], function ($app) {
        # 搬家
        $app->resource('HouseMove', 'HouseMoveController');
        $app->patch('HouseMove/hide/{id}', 'HouseMoveController@hide');
        $app->patch('HouseMove/audit/{id}', 'HouseMoveController@audit');
        # 租房
        $app->resource('Rental', 'RentalController');
        $app->patch('Rental/hide/{id}', 'RentalController@hide');
        $app->patch('Rental/audit/{id}', 'RentalController@audit');
    });
    #送水
    $app->resource('DeliverWater','Management\DeliverWaterController');
    $app->patch('DeliverWater/hide/{id}', 'Management\DeliverWaterController@hide');
    $app->patch('DeliverWater/audit/{id}', 'Management\DeliverWaterController@audit');
    #煤气
    $app->resource('CoalGas','Management\CoalGassesController');
    $app->patch('CoalGas/hide/{id}', 'Management\CoalGassesController@hide');
    $app->patch('CoalGas/audit/{id}', 'Management\CoalGassesController@audit');
    #回收
    $app->resource('Recovery','Management\RecoveriesController');
    $app->patch('Recovery/hide/{id}', 'Management\RecoveriesController@hide');
    $app->patch('Recovery/audit/{id}', 'Management\RecoveriesController@audit');
    #开锁
    $app->resource('Unlock','Management\UnlockController');
    $app->patch('Unlock/hide/{id}', 'Management\UnlockController@hide');
    $app->patch('Unlock/audit/{id}', 'Management\UnlockController@audit');
    #公厕
    $app->resource('PublicToilet','Management\PublicToiletsController');
    $app->patch('PublicToilet/hide/{id}', 'Management\PublicToiletsController@hide');
    $app->patch('PublicToilet/audit/{id}', 'Management\PublicToiletsController@audit');
     #用户
    $app->resource('users','UsersController');
    #投诉
    $app->resource('complaints','ComplaintsController');
    $app->patch('complaints/audit/{id}', 'ComplaintsController@audit');
    $app->resource('reasons','ReasonsController');
});

