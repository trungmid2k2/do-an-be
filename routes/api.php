<?php

use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\CompanyController;
use App\Http\Controllers\Api\Jobs\JobController;
use App\Http\Controllers\Api\Jobs\SubscribeJobController;
use App\Http\Controllers\Api\ListingController;
use App\Http\Controllers\Api\MemberController;
use App\Http\Controllers\Api\NewPasswordController;
use App\Http\Controllers\Api\POWController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\StatisticsController;
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

Route::get('/comment', [CommentController::class, 'get'])
    ->name('comment.get');

Route::put('/reset_password/{token}', [NewPasswordController::class, 'resetPassword']);
Route::post('/forgot_password', [NewPasswordController::class, 'forgot_password']);

Route::put('/company/update_company', [CompanyController::class, 'updateCompany']);


Route::middleware(['auth:api', 'verified'])->group(function () {
    Route::post('/user/update', [UserController::class, 'update'])
        ->name('user.update');
    Route::post('/user/edit', [UserController::class, 'edit'])
        ->name('user.edit');
    Route::delete('/user/delete', [UserController::class, 'deleteUser']);

    Route::post('/user/change_password', [UserController::class, 'change_password'])
        ->name('user.change_password');
    Route::get('/user/get_all_users', [UserController::class, 'getAllUsers']);



    Route::get('/admin/statistics', [StatisticsController::class, 'getStatistics']);
    Route::get('/admin/get_quantity', [StatisticsController::class, 'getQuantity']);
    Route::get('/admin/get_data_created', [StatisticsController::class, 'getDataCreated']);
    Route::get('/admin/get_data_created_month', [StatisticsController::class, 'getDataCreatedByMonth']);



    Route::post('/admin/edit_user', [UserController::class, 'adminEditUser']);

    // ->name('user.getAllUsers');


    Route::post('/pow/create', [POWController::class, 'create'])
        ->name('pow.create');
    Route::get('/pow/get', [POWController::class, 'get'])
        ->name('pow.get');
    Route::post('/pow/edit', [POWController::class, 'edit'])
        ->name('pow.edit');

    Route::post('/userCompanies', [UserController::class, 'getuserCompanies'])
        ->name('user.getuserCompanies');

    Route::post('/company/create', [CompanyController::class, 'createCompany'])
        ->name('company.createCompany');
    Route::post('/company/list', [CompanyController::class, 'listCompany'])
        ->name('company.listCompany');
    Route::get('/company/get_list_companies', [CompanyController::class, 'getListCompanies']);
    Route::get('/company/jobs_company', [CompanyController::class, 'jobsCompany']);
    Route::delete('/company/delete', [CompanyController::class, 'deleteCompany']);






    Route::get('/members', [MemberController::class, 'getMember'])
        ->name('member.getMember');
    Route::post('/members/invite', [MemberController::class, 'inviteMember'])
        ->name('member.inviteMember');
    Route::post('/members/accept/', [MemberController::class, 'acceptInvite'])
        ->name('member.acceptInvite');
    Route::delete('/members/delete', [MemberController::class, 'deleteMember']);



    Route::post('/jobs/create', [JobController::class, 'create'])
        ->name('job.create');
    Route::get('/jobs', [JobController::class, 'index'])
        ->name('job.index');
    Route::post('/jobs/update', [JobController::class, 'update'])
        ->name('jobs.update');
    Route::delete('/jobs/delete_job', [JobController::class, 'deleteJob'])
        ->name('jobs.delete_job');


    Route::post('/jobs/subscribe', [SubscribeJobController::class, 'subscribe'])
        ->name('subscribe.subscribe');
    Route::get('/jobs/check_subscribe', [SubscribeJobController::class, 'check'])
        ->name('subscribe.check');

    Route::get('/jobs/user_subcribed', [SubscribeJobController::class, 'countUserSubscribedJob']);
    Route::get('/jobs/get_job', [SubscribeJobController::class, 'getJob']);

    Route::get('/jobs/list_subscribe_job', [StatisticsController::class, 'getDataSubscribesJob']);


    Route::post('/jobs/un_subscribe', [SubscribeJobController::class, 'unsubscribe'])
        ->name('subscribe.unsubscribe');
    Route::get('/jobs/get_subscribe', [SubscribeJobController::class, 'get'])
        ->name('subscribe.get');

    Route::post('/comment/create', [CommentController::class, 'create'])
        ->name('comment.create');
});
