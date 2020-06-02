<?php
/**
 * Created by PhpStorm.
 * User: win10
 * Date: 2018/5/16
 * Time: 17:09
 */

Route::group([
    'prefix'=>'callback',
    'middleware' => ['web'],
    'as' => 'callback.',
    'namespace'=>'Xbhub\ShopDouyin\Http\Controllers'
], function(){

    Route::post('/shopDouyin', 'ShopDouyinController@callback')->name('shopDouyin');
});