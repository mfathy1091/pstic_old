<?php

use Illuminate\Support\Facades\Route;

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

Route::middleware(['auth', 'is_active_user'])->group(function () {

    Route::group(['prefix' => 'vue'], function(){
        Route::get('get-individuals', 'Api\IndividualController@getIndividuals')->name('vue.get-individuals');
    });

    
    // Home
    Route::get('/', 'Individual\SearchController@index')->name('home');
    
    Route::get('/add_referral', 'ReferralController@someMethod')->name('add-referral');

    // users and roles
    Route::middleware(['auth'])->group(function () {
        Route::resource('users', UserController::class);
        Route::resource('roles', RoleController::class);
    });
    
    // Individuals
    Route::get('vuelivesearch', 'Api\IndividualController@getIndividuals')->name('vuelivesearch');

    Route::get('individuals/search', 'Individual\SearchController@index')->name('individuals.search');
    Route::get('individuals/search/action', 'Individual\SearchController@action')->name('individuals.search.action');
    
    Route::get('/individuals/create/{id}', 'Individual\IndividualController@create')->name('individuals.create');
    Route::resource('/individuals', 'Individual\IndividualController', ['except' => ['create']], ['names' => 'individuals']);


    // Files
    Route::resource('files', File\FileController::class);
    
    // Beneficiary
    Route::resource('beneficiaries', Beneficiary\BeneficiaryController::class);
    Route::get('beneficiaries/action', 'Beneficiary\BeneficiaryController@create')->name('beneficiaries.action');

    
    // Benefits
    Route::group(['prefix' => 'ajax-offers'], function(){
        Route::resource('benefits', BenefitController::class);
        Route::post('delete', 'BenefitController@delete')->name('benefits.delete');
    });
    
    // Emergencies
    Route::group(['prefix' => ''], function(){
        Route::resource('emergencies', EmergencyController::class);
        Route::post('delete', 'EmergencyController@delete')->name('emergencies.delete');
    });

    // Individuals
    //Route::prefix('individuals')->group( function () {
        
        //Route::resource('/psscases', Supervisor\PssCaseController::class);
        //Route::resource('/statistics', Supervisor\StatisticController::class);
    //});
    
    
    // Referrals
    Route::resource('referrals', ReferralController::class);
    
    // PSS Cases
    Route::get('/psscases/create/{id}', 'PssCaseController@create')->name('psscases.create');
    Route::resource('/psscases', PssCaseController::class, ['except' => ['create']]);
    
    // Employees
    Route::resource('employees', Employee\EmployeeController::class);
    
    // Teams
    Route::namespace('Team')->group(function () {
        Route::resource('teams', 'TeamController');
    });
    
    
    
    // Statistics
    Route::prefix('statistics')->name('statistics.')->group( function () {
    });
    
    
    
    //PSW
    Route::prefix('psw')->name('psw.')->middleware(['is_ps_worker'])->group( function () {
        Route::get('/psscases/create/{id}', 'Psw\PssCaseController@create')->name('psscases.create');
        Route::resource('/psscases', Psw\PssCaseController::class, ['except' => ['create']]);
    });
    
    
    
    //for now, create the CaseController inside the PSWorkers controllers namespace
    //then check how to add cases using the adim user (I think admin shouldn't add cases for workers)
    
    
    
    //==============================Identity Cards============================
    Route::group(['namespace' => 'IdentityCards'], function () {
        Route::resource('identitycards', 'IdentityCardController');
    });
    
    //==============================Nationality============================
    Route::namespace('Nationality')->group(function () {
        Route::resource('nationalities', 'NationalityController');
    });
    
    //==============================Referral Sources============================
    Route::namespace('ReferralSources')->group(function () {
        Route::resource('referralsources', 'ReferralSourceController');
    });
    
    
    //==============================Case Types============================
    Route::namespace('CaseTypes')->group(function () {
        Route::resource('casetypes', 'CaseTypeController');
    });
    
    //==============================Follow Ups============================
    Route::namespace('FollowUp')->group(function () {
        Route::resource('followups', 'FollowUpController');
    });
    
    
    
    
    
    
    //==============================Surveys============================
    Route::namespace('Surveys')->group(function () {
        Route::resource('surveys', 'SurveyController');
    });
});




