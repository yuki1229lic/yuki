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

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home.index');

Route::get('/search', [App\Http\Controllers\HomeController::class, 'search'])->name('home.search');
Route::get('/keyword_search', [App\Http\Controllers\HomeController::class, 'keyword_search'])->name('home.keyword_search');
Route::get('/area_search/{area}', [App\Http\Controllers\HomeController::class, 'area_search'])->name('home.area_search');
Route::get('/city_group_search/{city_group_id}', [App\Http\Controllers\HomeController::class, 'city_group_search'])->name('home.city_group_search');
Route::get('/category_search/{category}', [App\Http\Controllers\HomeController::class, 'category_search'])->name('home.category_search');
Route::get('/dsp_jober_list', [App\Http\Controllers\HomeController::class, 'dsp_jober_list'])->name('home.dsp_jober_list');
Route::get('/jobList/{joberId}', [App\Http\Controllers\HomeController::class, 'jobList'])->name('home.jobList');
Route::get('/jobAppForm/{job_id}', [App\Http\Controllers\HomeController::class, 'jobAppForm'])->name('home.jobAppForm');
Route::post('/email-check', [App\Http\Controllers\HomeController::class, 'emailCheck'])->name('home.emailCheck');;
Route::post('/bid_post_unauth',  [App\Http\Controllers\HomeController::class, 'bid_post_unauth'])->name('bid_post_unauth');

Route::get('/advantage', [App\Http\Controllers\HomeController::class, 'advantage'])->name('home.advantage');
Route::get('/service', [App\Http\Controllers\HomeController::class, 'service'])->name('home.service');
Route::get('/privacy', [App\Http\Controllers\HomeController::class, 'privacy'])->name('home.privacy');
Route::get('/terms_and_service', [App\Http\Controllers\HomeController::class, 'terms_and_service'])->name('home.terms_and_service');
Route::get('/first', [App\Http\Controllers\HomeController::class, 'first'])->name('home.first');
Route::get('/company', [App\Http\Controllers\HomeController::class, 'company'])->name('home.company');
Route::get('/business', [App\Http\Controllers\HomeController::class, 'business'])->name('home.business');
Route::get('/about-oiwaikin', [App\Http\Controllers\HomeController::class, 'about_oiwaikin'])->name('home.about_oiwaikin');

Route::get('/contact', [App\Http\Controllers\HomeController::class, 'contact'])->name('home.contact');
Route::post('/send_contact_mail', [App\Http\Controllers\HomeController::class, 'send_contact_mail'])->name('home.send_contact_mail');

Route::get('/advertising', [App\Http\Controllers\HomeController::class, 'oubo'])->name('home.oubo');
Route::post('/advertising_confirm', [App\Http\Controllers\HomeController::class, 'oubo_confirm'])->name('home.oubo_confirm');
Route::post('/send_company_mail', [App\Http\Controllers\HomeController::class, 'send_company_mail'])->name('home.send_company_mail');

Route::get('/job_detail/{id}/{page?}', [App\Http\Controllers\HomeController::class, 'job_detail'])->name('home.job_detail');

Route::get('/blog_detail/{id}', [App\Http\Controllers\HomeController::class, 'blog_detail'])->name('home.blog_detail');
Route::get('/blog_list', [App\Http\Controllers\HomeController::class, 'blog_list'])->name('home.blog_list');

Route::get('/notification_detail/{id}', [App\Http\Controllers\HomeController::class, 'notification_detail'])->name('home.notification_detail');

Route::get('/special_detail/{id}', [App\Http\Controllers\HomeController::class, 'special_detail'])->name('home.special_detail');
Route::get('/special_list', [App\Http\Controllers\HomeController::class, 'special_list'])->name('home.special_list');

Route::get('/user_profile/{user_id}', [App\Http\Controllers\HomeController::class, 'user_profile'])->name('home.user_profile');
Route::post('/user_profile_db/', [App\Http\Controllers\HomeController::class, 'user_profile_db'])->name('home.user_profile_db');

Route::get('/verify', [App\Http\Controllers\Auth\RegisterController::class ,'verifyUser'])->name('verify.user');

Auth::routes();


Route::middleware(['auth','user'])->group( function(){
    Route::get('/user/dashboard', [App\Http\Controllers\UserController::class, 'index'])->name('user.dashboard');

    Route::get('/user/web_history_main', [App\Http\Controllers\UserController::class, 'web_history_main'])->name('user.web_history_main');
    Route::post('/user/web_history_main_db', [App\Http\Controllers\UserController::class, 'web_history_main_db'])->name('user.web_history_main_db');

    Route::get('/user/web_history_experience', [App\Http\Controllers\UserController::class, 'web_history_experience'])->name('user.web_history_experience');
    Route::post('/user/web_history_experience_db', [App\Http\Controllers\UserController::class, 'web_history_experience_db'])->name('user.web_history_experience_db');

    Route::get('/user/web_history_qualification', [App\Http\Controllers\UserController::class, 'web_history_qualification'])->name('user.web_history_qualification');
    Route::post('/user/web_history_qualification_db', [App\Http\Controllers\UserController::class, 'web_history_qualification_db'])->name('user.web_history_qualification_db');

    Route::get('/user/web_history_skill', [App\Http\Controllers\UserController::class, 'web_history_skill'])->name('user.web_history_skill');
    Route::post('/user/web_history_skill_db', [App\Http\Controllers\UserController::class, 'web_history_skill_db'])->name('user.web_history_skill_db');

    Route::get('/user/web_history_aspect', [App\Http\Controllers\UserController::class, 'web_history_aspect'])->name('user.web_history_aspect');
    Route::post('/user/web_history_aspect_db', [App\Http\Controllers\UserController::class, 'web_history_aspect_db'])->name('user.web_history_aspect_db');

    Route::get('/user/history_resume', [App\Http\Controllers\UserController::class, 'history_resume'])->name('user.history_resume');
    Route::get('/user/resume_contact', [App\Http\Controllers\UserController::class, 'resume_contact'])->name('user.resume_contact');
    Route::post('/user/pdf_mail', [App\Http\Controllers\UserController::class, 'pdf_mail'])->name('user.pdf_mail');

    Route::get('/user/user_profile', [App\Http\Controllers\UserController::class, 'user_profile'])->name('user.user_profile');
    Route::get('/user/user_profile_update', [App\Http\Controllers\UserController::class, 'user_profile_update'])->name('user.user_profile_update');
    Route::post('/user/user_profile_update_db', [App\Http\Controllers\UserController::class, 'user_profile_update_db'])->name('user.user_profile_update_db');

    Route::get('/user/user_password_update', [App\Http\Controllers\UserController::class, 'user_password_update'])->name('user.user_password_update');
    Route::post('/user/user_password_update_db', [App\Http\Controllers\UserController::class, 'user_password_update_db'])->name('user.user_password_update_db');

    Route::get('/user/user_delete', [App\Http\Controllers\UserController::class, 'user_delete'])->name('user.user_delete');
    Route::post('/user/message_page', [App\Http\Controllers\UserController::class, 'message_page'])->name('user.message_page');

    Route::post('/user/favorite/{job}', [App\Http\Controllers\UserController::class, 'favoriteJob']);
    Route::post('/user/unfavorite/{job}', [App\Http\Controllers\UserController::class, 'unFavoriteJob']);
    Route::get('/user/my_favorites',  [App\Http\Controllers\UserController::class, 'myFavorites'])->name('user.myFavorites');
    Route::get('/user/remove_favorite/{job_id}',  [App\Http\Controllers\UserController::class, 'remove_favorite'])->name('user.remove_favorite');

    Route::get('/jobAppForm/auth/{job_id}', [App\Http\Controllers\HomeController::class, 'jobAppForm'])->name('home.jobAppForm_auth');
    Route::get('/user/bid_content/{job_id}',  [App\Http\Controllers\UserController::class, 'bid_content'])->name('user.bid_content');
    Route::post('/user/bid_post',  [App\Http\Controllers\UserController::class, 'bid_post'])->name('user.bid_post');
    Route::get('/user/bid_list',  [App\Http\Controllers\UserController::class, 'bid_list'])->name('user.bid_list');
    Route::get('/user/account_delete',  [App\Http\Controllers\UserController::class, 'account_delete'])->name('user.account_delete');
});


Route::middleware(['auth','jober'])->group( function(){
    Route::get('/jober/dashboard', [App\Http\Controllers\JoberController::class, 'index'])->name('jober.dashboard');
    Route::get('/jober/jober_profile', [App\Http\Controllers\JoberController::class, 'jober_profile'])->name('jober.jober_profile');
    Route::post('/jober/jober_profile_db', [App\Http\Controllers\JoberController::class, 'jober_profile_db'])->name('jober.jober_profile_db');

    Route::get('/jober/job_register', [App\Http\Controllers\JoberController::class, 'job_register'])->name('jober.job_register');
    Route::post('/jober/job_register_db', [App\Http\Controllers\JoberController::class, 'job_register_db'])->name('jober.job_register_db');

    Route::get('/jober/job_update/{id}', [App\Http\Controllers\JoberController::class, 'job_update'])->name('jober.job_update');
    Route::get('/jober/job_update_copy/', [App\Http\Controllers\JoberController::class, 'job_update_copy'])->name('jober.job_update_copy');
    Route::post('/jober/job_update_copy/', [App\Http\Controllers\JoberController::class, 'job_update_copy'])->name('jober.job_update_copy');
    Route::post('/jober/job_update_db', [App\Http\Controllers\JoberController::class, 'job_update_db'])->name('jober.job_update_db');

    Route::post('/jober/job_status_change', [App\Http\Controllers\JoberController::class, 'job_status_change'])->name('jober.job_status_change');
    Route::get('/jober/job_start/{job_id}', [App\Http\Controllers\JoberController::class, 'job_start'])->name('jober.job_start');
    Route::get('/jober/job_stop/{job_id}', [App\Http\Controllers\JoberController::class, 'job_stop'])->name('jober.job_stop');
    Route::get('/jober/job_tempory_stop/{job_id}', [App\Http\Controllers\JoberController::class, 'job_tempory_stop'])->name('jober.job_tempory_stop');

    Route::get('/jober/job_list', [App\Http\Controllers\JoberController::class, 'job_list'])->name('jober.job_list');
    Route::get('/jober/job_delete/{id}', [App\Http\Controllers\JoberController::class, 'job_delete'])->name('jober.job_delete');

    Route::get('/jober/bid_list', [App\Http\Controllers\JoberController::class, 'bid_list'])->name('jober.bid_list');
    Route::get('/jober/job_detail/{job_id}', [App\Http\Controllers\JoberController::class, 'job_detail'])->name('jober.job_detail');
    Route::post('/jober/job_detail/{job_id}', [App\Http\Controllers\JoberController::class, 'job_detail'])->name('jober.job_detail');

    Route::get('/jober/jober_password_update', [App\Http\Controllers\JoberController::class, 'jober_password_update'])->name('jober.jober_password_update');
    Route::post('/jober/jober_password_update_db', [App\Http\Controllers\JoberController::class, 'jober_password_update_db'])->name('jober.jober_password_update_db');

    Route::post('/jober/hire', [App\Http\Controllers\JoberController::class, 'hire'])->name('jober.hire');
    Route::post('/jober/hire_status_change', [App\Http\Controllers\JoberController::class, 'hire_status_change'])->name('jober.hire_status_change');
    Route::get('/jober/hire_stop/{bid_id}', [App\Http\Controllers\JoberController::class, 'hire_stop'])->name('jober.hire_stop');
    Route::get('/jober/hire_list', [App\Http\Controllers\JoberController::class, 'hire_list'])->name('jober.hire_list');
});

Route::middleware(['auth','admin'])->group( function(){
    Route::get('/admin/dashboard', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.dashboard');

    Route::get('/admin/password', [App\Http\Controllers\AdminController::class, 'admin_password'])->name('admin.password');
    Route::post('/admin/password_update', [App\Http\Controllers\AdminController::class, 'admin_password_update'])->name('admin.password_update');

    Route::get('/admin/user_list', [App\Http\Controllers\AdminController::class, 'user_list'])->name('admin.user_list');
    Route::get('/admin/user_detail/{id}', [App\Http\Controllers\AdminController::class, 'user_detail'])->name('admin.user_detail');

    Route::get('/admin/user_add', [App\Http\Controllers\AdminController::class, 'user_add'])->name('admin.user_add');
    Route::post('/admin/user_add_db', [App\Http\Controllers\AdminController::class, 'user_add_db'])->name('admin.user_add_db');
    Route::get('/admin/user_profile/{id}', [App\Http\Controllers\AdminController::class, 'get_user_profile'])->name('admin.get_user_profile');
    Route::post('/admin/user_profile_update', [App\Http\Controllers\AdminController::class, 'user_profile_update'])->name('admin.user_profile_update');

    Route::get('/admin/user_delete/{id}', [App\Http\Controllers\AdminController::class, 'user_delete'])->name('admin.user_delete');

    Route::get('/admin/user_password/{id}', [App\Http\Controllers\AdminController::class, 'user_password'])->name('admin.user_password');
    Route::post('/admin/user_password_update', [App\Http\Controllers\AdminController::class, 'user_password_update'])->name('admin.user_password_update');

    Route::get('/admin/enterprise_add', [App\Http\Controllers\AdminController::class, 'enterprise_add'])->name('admin.enterprise_add');
    Route::post('/admin/enterprise_add_db', [App\Http\Controllers\AdminController::class, 'enterprise_add_db'])->name('admin.enterprise_add_db');

    Route::get('/admin/enterprise_list', [App\Http\Controllers\AdminController::class, 'enterprise_list'])->name('admin.enterprise_list');
    Route::get('/admin/dspEnterprise_list', [App\Http\Controllers\AdminController::class, 'dsp_enterprise_list'])->name('admin.dsp_enterprise_list');
    Route::get('/admin/enterprise_profile/{id}', [App\Http\Controllers\AdminController::class, 'enterprise_profile'])->name('admin.enterprise_profile');
    Route::post('/admin/enterprise_profile_update', [App\Http\Controllers\AdminController::class, 'enterprise_profile_update'])->name('admin.enterprise_profile_update');

    Route::get('/admin/enterprise_job_list/{id}', [App\Http\Controllers\AdminController::class, 'enterprise_job_list'])->name('admin.enterprise_job_list');

    Route::get('/admin/enterprise_hire_list/{jober_id}', [App\Http\Controllers\AdminController::class, 'enterprise_hire_list'])->name('admin.enterprise_hire_list');

    Route::get('/admin/job_detail/{id}', [App\Http\Controllers\AdminController::class, 'job_detail'])->name('admin.job_detail');

    Route::get('/admin/job_register/{id}', [App\Http\Controllers\AdminController::class, 'job_register'])->name('admin.job_register');
    Route::post('/admin/job_register_db', [App\Http\Controllers\AdminController::class, 'job_register_db'])->name('admin.job_register_db');

    Route::get('/admin/job_update/{id}', [App\Http\Controllers\AdminController::class, 'job_update'])->name('admin.job_update');
    Route::post('/admin/job_update_db', [App\Http\Controllers\AdminController::class, 'job_update_db'])->name('admin.job_update_db');

    Route::get('/admin/job_delete/{id}', [App\Http\Controllers\AdminController::class, 'job_delete'])->name('admin.job_delete');

    Route::get('/admin/enterprise_password/{id}', [App\Http\Controllers\AdminController::class, 'enterprise_password'])->name('admin.enterprise_password');
    Route::post('/admin/enterprise_password_update', [App\Http\Controllers\AdminController::class, 'enterprise_password_update'])->name('admin.enterprise_password_update');

    Route::get('/admin/public_job_list', [App\Http\Controllers\AdminController::class, 'public_job_list'])->name('admin.public_job_list');
    Route::get('/admin/old_job_list', [App\Http\Controllers\AdminController::class, 'old_job_list'])->name('admin.old_job_list');
    Route::get('/admin/featured_job_list', [App\Http\Controllers\AdminController::class, 'featured_job_list'])->name('admin.featured_job_list');
    Route::post('/admin/featured_job_setting', [App\Http\Controllers\AdminController::class, 'featured_job_setting'])->name('admin.featured_job_setting');

    Route::get('/admin/article_setting', [App\Http\Controllers\AdminController::class, 'article_setting'])->name('admin.article_setting');
    Route::get('/admin/article_list', [App\Http\Controllers\AdminController::class, 'article_list'])->name('admin.article_list');
    Route::post('/admin/article_add', [App\Http\Controllers\AdminController::class, 'article_add'])->name('admin.article_add');
    Route::get('/admin/article_update/{id}', [App\Http\Controllers\AdminController::class, 'article_update'])->name('admin.article_update');
    Route::post('/admin/article_update_db', [App\Http\Controllers\AdminController::class, 'article_update_db'])->name('admin.article_update_db');
    Route::post('/admin/article_imageUpload', [App\Http\Controllers\AdminController::class, 'article_imageUpload'])->name('admin.article_imageUpload');
    Route::get('/admin/article_delete/{id}', [App\Http\Controllers\AdminController::class, 'article_delete'])->name('admin.article_delete');

    Route::get('/admin/notification_list', [App\Http\Controllers\AdminController::class, 'notification_list'])->name('admin.notification_list');
    Route::get('/admin/notification_add', [App\Http\Controllers\AdminController::class, 'notification_add'])->name('admin.notification_add');
    Route::post('/admin/notification_add_db', [App\Http\Controllers\AdminController::class, 'notification_add_db'])->name('admin.notification_add_db');
    Route::get('/admin/notification_delete/{id}', [App\Http\Controllers\AdminController::class, 'notification_delete'])->name('admin.notification_delete');

    Route::get('/admin/category_list', [App\Http\Controllers\AdminController::class, 'category_list'])->name('admin.category_list');
    Route::get('/admin/category_add', [App\Http\Controllers\AdminController::class, 'category_add'])->name('admin.category_add');
    Route::post('/admin/category_add_db', [App\Http\Controllers\AdminController::class, 'category_add_db'])->name('admin.category_add_db');
    Route::get('/admin/category_update/{id}', [App\Http\Controllers\AdminController::class, 'category_update'])->name('admin.category_update');
    Route::post('/admin/category_update_db', [App\Http\Controllers\AdminController::class, 'category_update_db'])->name('admin.category_update_db');
    Route::get('/admin/category_delete/{id}', [App\Http\Controllers\AdminController::class, 'category_delete'])->name('admin.category_delete');

    Route::get('/admin/area_list', [App\Http\Controllers\AdminController::class, 'area_list'])->name('admin.area_list');
    Route::get('/admin/area_add', [App\Http\Controllers\AdminController::class, 'area_add'])->name('admin.area_add');
    Route::post('/admin/area_add_db', [App\Http\Controllers\AdminController::class, 'area_add_db'])->name('admin.area_add_db');
    Route::get('/admin/area_update/{id}', [App\Http\Controllers\AdminController::class, 'area_update'])->name('admin.area_update');
    Route::post('/admin/area_update_db', [App\Http\Controllers\AdminController::class, 'area_update_db'])->name('admin.area_update_db');
    Route::get('/admin/area_delete/{id}', [App\Http\Controllers\AdminController::class, 'area_delete'])->name('admin.area_delete');

    Route::post('/admin/special_imageUpload', [App\Http\Controllers\AdminController::class, 'special_imageUpload'])->name('admin.special_imageUpload');
    Route::get('/admin/special_add', [App\Http\Controllers\AdminController::class, 'special_add'])->name('admin.special_add');
    Route::post('/admin/special_add_db', [App\Http\Controllers\AdminController::class, 'special_add_db'])->name('admin.special_add_db');
    Route::get('/admin/special_list', [App\Http\Controllers\AdminController::class, 'special_list'])->name('admin.special_list');
    Route::get('/admin/special_update/{id}', [App\Http\Controllers\AdminController::class, 'special_update'])->name('admin.special_update');
    Route::post('/admin/special_update_db', [App\Http\Controllers\AdminController::class, 'special_update_db'])->name('admin.special_update_db');
    Route::get('/admin/special_delete/{id}', [App\Http\Controllers\AdminController::class, 'special_delete'])->name('admin.special_delete');
    Route::post('/admin/impersonate', [App\Http\Controllers\AdminController::class, 'impersonate'])->name('admin.impersonate');
});

Route::middleware(['auth'])->group( function(){
    Route::get('/chatting', [App\Http\Controllers\ChatController::class, 'chatting'])->name('chatting');
    Route::post('/send_first_message/{session}', [App\Http\Controllers\ChatController::class, 'send_first_message'])->name('send_first_message');

    Route::post('/getFriends', [App\Http\Controllers\ChatController::class, 'getFriends']);
    Route::post('/session/create', [App\Http\Controllers\SessionController::class,'create'])->name('session.create');
    Route::post('/session/{session}/chats', [App\Http\Controllers\ChatController::class, 'chats']);
    Route::post('/session/{session}/read', [App\Http\Controllers\ChatController::class, 'read']);
    Route::post('/session/{session}/clear', [App\Http\Controllers\ChatController::class, 'clear']);
    Route::post('/session/{session}/block', [App\Http\Controllers\BlockController::class, 'block']);
    Route::post('/session/{session}/unblock', [App\Http\Controllers\BlockController::class, 'unblock']);
    Route::post('/send/{session}', [App\Http\Controllers\ChatController::class, 'send']);


    Route::post('/get_unread_notification/', [App\Http\Controllers\PushController::class, 'get_unread_notification']);
    Route::post('/get_unread_message/', [App\Http\Controllers\PushController::class, 'get_unread_message']);
    Route::get('/read_notification/{id}', [App\Http\Controllers\PushController::class, 'read_notification']);

});
