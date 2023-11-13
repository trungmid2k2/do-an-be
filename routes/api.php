<?php

use App\Http\Controllers\Api\CompanyController;
use App\Http\Controllers\Api\Jobs\JobController;
use App\Http\Controllers\Api\Jobs\SubscribeJobController;
use App\Http\Controllers\Api\ListingController;
use App\Http\Controllers\Api\MemberController;
use App\Http\Controllers\Api\POWController;
use App\Http\Controllers\Api\UserController;
use App\Models\MemberCompany;
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

require __DIR__ . '/auth.php';

Route::middleware('auth:api')->group(function () {
    Route::get('/user', [UserController::class, 'show'])
        ->name('user.show');
});
Route::get('/getjob', [JobController::class, 'get'])
        ->name('job.get'); 
Route::get('/getjob/count_subscribe', [SubscribeJobController::class, 'count'])
        ->name('subscribe.count'); 


Route::post('/user/getAllInfo', [UserController::class, 'getAllInfo'])
    ->name('user.getAllInfo');
Route::get('/invite', [MemberController::class, 'getInvite'])
    ->name('member.getInvite');


Route::get('/listings', [ListingController::class, 'getAll'])
    ->name('Listing.getAll');


Route::middleware(['auth:api', 'verified'])->group(function () {
    Route::post('/user/update', [UserController::class, 'update'])
        ->name('user.update');
    Route::post('/user/edit', [UserController::class, 'edit'])
        ->name('user.edit');

    Route::post('/pow/create', [POWController::class, 'create'])
        ->name('pow.create');
    Route::get('/pow/get', [POWController::class, 'get'])
        ->name('pow.get');
    Route::post('/pow/edit', [POWController::class, 'edit'])
        ->name('pow.edit');

    Route::post('/userCompanies', [UserController::class, 'getUserCompanies'])
        ->name('user.getUserCompanies');

    Route::post('/company/create', [CompanyController::class, 'createCompany'])
        ->name('company.createCompany');
    Route::post('/company/list', [CompanyController::class, 'listCompany'])
        ->name('company.listCompany');

    Route::get('/members', [MemberController::class, 'getMember'])
        ->name('member.getMember');
    Route::post('/members/invite', [MemberController::class, 'inviteMember'])
        ->name('member.inviteMember');
    Route::post('/members/accept/', [MemberController::class, 'acceptInvite'])
        ->name('member.acceptInvite');

    Route::post('/jobs/create', [JobController::class, 'create'])
        ->name('job.create');  
    Route::get('/jobs', [JobController::class, 'index'])
        ->name('job.index');  

    Route::post('/jobs/subscribe', [SubscribeJobController::class, 'subscribe'])
        ->name('subscribe.subscribe');
    Route::get('/jobs/check_subscribe', [SubscribeJobController::class, 'check'])
        ->name('subscribe.check');
    Route::post('/jobs/un_subscribe', [SubscribeJobController::class, 'unsubscribe'])
        ->name('subscribe.unsubscribe');
    Route::get('/jobs/get_subscribe', [SubscribeJobController::class, 'get'])
        ->name('subscribe.get');  
    
      
    
});
