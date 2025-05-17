<?php

use App\Http\Controllers\backend\AccountSetting\CompanyProfileController;
use App\Http\Controllers\backend\AccountSetting\ContactPersonContoller;
use App\Http\Controllers\backend\BlogController;
use App\Http\Controllers\backend\CVController;
use App\Http\Controllers\backend\HomeController as BackendHomeController;
use App\Http\Controllers\backend\JobPostingController;
use App\Http\Controllers\backend\LocationContorller;
use App\Http\Controllers\CV_PDFController;
use App\Http\Controllers\frontend\AboutusController;
use App\Http\Controllers\frontend\BlogController as FrontendBlogController;
use App\Http\Controllers\frontend\ContactusController;
use App\Http\Controllers\frontend\HomeController;
use App\Http\Controllers\frontend\JobController;
use App\Http\Controllers\frontend\UserController;
use App\Models\Location;
use GuzzleHttp\Promise\Create;
use Illuminate\Support\Facades\Route;

// Frontend Routes
Route::prefix('/')->name('frontend.')->group(function () {
    Route::controller(HomeController::class)->group(function () {
        Route::get('/', 'index')->name('home');
    });

    Route::controller(UserController::class)->group(function () {
        Route::get('login', 'login')->name('login');
        Route::post('do-login', 'do_login')->name('do-login');
        Route::get('register', 'register')->name('register');
        Route::post('registration', 'registration')->name('registration');
        Route::get('company-register', 'company_register')->name('company-register');
        Route::post('company-registration', 'company_registration')->name('company-registration');
        Route::get('logout', 'logout')->name('logout');
    });

    Route::controller(AboutusController::class)->group(function () {
        Route::get('about', 'index')->name('about');
    });
    Route::controller(FrontendBlogController::class)->group(function () {
        Route::get('companyActivities', 'index')->name('companyActivities');
        Route::get('csr', 'csr')->name('csr');
        Route::get('blog_detail/{id}/{status}', 'blog_detail')->name('blog_detail');
    });

    Route::controller(ContactusController::class)->group(function () {
        Route::get('contact', 'index')->name('contact');
        Route::post('/send-telegram-message', 'sendTelegramMessage')->name('send_telegram_message');
    });

    Route::controller(JobController::class)->group(function () {
        Route::get('job_list', 'index')->name('job_list');
        Route::get('/job_list/{id}','show')->name('job_details');
    });

    // Route::get('/pdf', [PDFController::class, 'generatePDF']);
    Route::controller(CV_PDFController::class)->group(function () {
        Route::get('create_CV', 'index')->name('create_CV');
        Route::post('/cv/download-pdf', 'downloadPDF')->name('downloadPDF');
        Route::post('/cv/preview', 'previewPDF')->name('previewPDF');
    });
});

// Backend Routes
Route::prefix('admin')->middleware('user.auth')->group(function () {
    Route::controller(BackendHomeController::class)->group(function () {
        Route::get('/', 'index')->name('admin_home');
        Route::get('/add_job', 'add_job')->name('add_job');
        Route::post('/post_job', 'post_job')->name('post_job');

        Route::get('/showProvince', 'showProvince')->name('showProvince');
        Route::get('/districts', 'fetchDistricts')->name('districts');
        
        Route::get('/fectEmployerContact', 'fectEmployerContact')->name('fectEmployerContact');
        Route::get('/showJobsCategory', 'showJobsCategory')->name('showJobsCategory');
    });
    Route::controller(CVController::class)->group(function () {
        Route::get('cv', 'index')->name('cv');
    });
    Route::controller(CompanyProfileController::class)->group(function () {
        Route::get('/company-profile', 'index')->name('company_profile');
        Route::put('/company-profile/update', 'update')->name('update_company_profile');
    });
    Route::controller(ContactPersonContoller::class)->group(function () {
        Route::get('contactPerson', 'index')->name('contactPerson');
        Route::get('contactPerson/create', 'create')->name('create_person');
        Route::post('contactPerson/store', 'store')->name('store_person');
        Route::put('/update-person/{id}', 'update')->name('update_person');
        Route::get('contactPerson/edit/{id}', 'edit')->name('edit_person');
        Route::delete('/contact-person/delete/{id}', 'destroy')->name('delete_person');
    });
    Route::controller(JobPostingController::class)->group(function () {
        Route::get('job', 'index')->name('job');
        Route::get('job/create', 'create')->name('create_job');
        Route::post('job/store', 'store')->name('store_job');
        Route::get('job/edit/{id}', 'edit')->name('edit_job');
        Route::put('job/update/{id}', 'update')->name('update_job');
        Route::delete('/jobs/{id}', 'destroy')->name('jobs.destroy');
        Route::post('/jobs/{id}/copy', 'copy')->name('jobs.copy');
        

        Route::post('/jobs/{job}/close', 'closeJob')->name('jobs.close');
        Route::post('/jobs/{job}/renew', [JobPostingController::class, 'renewJob'])->name('jobs.renew');

        Route::get('/job-categories/search', 'search')->name('job-categories.search');
        
    });
    Route::controller(BlogController::class)->group(function(){
        Route::get('blog','index')->name('blog');
        Route::get('blog_add','add_blog')->name('add_blog');
        Route::post('store_add_blog','store_add_blog')->name('store_add_blog');
        Route::get('blog_edit/{id}','edit')->name('edit_blog');
        Route::post('update_blog/{id}','update')->name('update_blog');
        Route::post('delete_blog/{id}','destroy')->name('delete_blog');


    });
    Route::get('/api/districts/{provinceId}', [LocationContorller::class, 'getDistricts'])->name('districts');
});
