<?php

use Illuminate\Support\Facades\Route;

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

Route::group(['namespace' => 'Api'], function () {

    //auth apis
    Route::post('signup', 'AuthController@signup'); //user signup
    Route::post('login', 'AuthController@login'); //user/admin login

    Route::group(['middleware' => ['jwt.verify','json.response']], function() {

        //user apis
        Route::post('logout', 'AuthController@logout'); //user/admin logout

        //loan seeker apis
        Route::group(['middleware' => ['loan.seeker']], function() {
            Route::post('loan/application','LoanController@loanApplication'); //loan applocation from user(loan seeker)
            Route::post('loan/repay','LoanController@loanRepay'); //repay loan by weekly installment
        });

        //admin apis
        Route::group(['middleware' => ['admin']], function() {
            Route::post('loans','AdminController@loans'); // all loan applications
            Route::post('loan/action','AdminController@loanAction'); // loan action accept/reject
        });

    });
});
