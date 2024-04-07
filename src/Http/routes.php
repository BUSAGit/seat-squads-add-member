<?php

Route::group([
    'namespace'  => 'Api',
    'middleware' => ['api.request', 'api.auth'],
    'prefix'     => 'api',
], function () {

    Route::group(['prefix' => 'squads'], function () {
        Route::post('/{squad_id}/add-member')->uses('SquadsController@addMember');
        Route::post('/{squad_id}/remove-member')->uses('SquadsController@removeMember');
    });

});
