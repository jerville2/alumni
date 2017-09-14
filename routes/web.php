<?php
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
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'PostController@home');
Route::get('/events/{slug}', 'PostController@events');
Route::get('news/{slug}', 'PostController@news');
Route::get('events', 'PostController@eventsAll');
Route::get('news', 'PostController@newsAll');
Route::get('announcement/{slug}', 'PostController@ann');
Route::get('announcements', 'PostController@annAll');
Route::get('post', 'PostController@tab');
Route::get('q', 'PostController@search');
Route::get('reunions', 'PostController@reuAll');
Route::get('reunion/{slug}', 'PostController@reu');
Route::get('about_us', 'PostController@about');
Route::prefix('about_us')->group(function () {
    Route::get('organization', 'PostController@org');
    Route::get('coordinators', 'PostController@coor');
    Route::get('faai', 'PostController@faai');
});
Route::get('services', 'PostController@services');
Route::prefix('services')->group(function () {
    Route::get('idcard', 'PostController@idcard');
});
Route::get('download/{id}', 'PostController@download');
Route::get('/error',function(){
    abort(404);
});

//Account profile Controller
Route::group(['middleware' => 'isGuest'], function (){
    Route::group(['middleware' => 'isEmailVerified'], function () {
        Route::get('/my_profile', 'AccountController@myProfile');
        Route::get('account', 'AccountController@myAccount');
        Route::post('update_info', 'AccountController@profileUpdate');
        Route::post('update_emp', 'AccountController@empUpdate');
        Route::post('deleteEmp/{id}', 'AccountController@deleteEmp');
        Route::get('change_pass', 'AccountController@cPassword');
        Route::post('update_pass', 'AccountController@updatePassword');
        Route::post('eligibility', 'AccountController@eligibility');
        Route::post('organization', 'AccountController@organization');
        Route::post('publication', 'AccountController@publication');
        Route::post('award', 'AccountController@award');
        Route::post('upimage', 'AccountController@imageUp');
        Route::get('resize', 'AccountController@resize');
        Route::get('jcrop', function()
        {
            return view('Account.jcrop');
        });
        Route::get('watermark', 'AccountController@waterMark');
        Route::post('upjcrop', 'AccountController@jcropUp');
        Route::get('/city', 'AccountController@cityMap');
        Route::get('/brgy', 'AccountController@brgyMap');
        Route::get('/degreeList', 'DirectoryController@degreeMap');
        Route::get('alumni', 'DirectoryController@allAlumni');
        Route::get('alumni/qAlumni', 'DirectoryController@searchAlum');
        Route::get('alumni/view/{id}', 'DirectoryController@viewProfile');
        Route::get('jobs/{id}', 'PostController@job');
        Route::get('jobs', 'PostController@jobsAll');
        Route::get('gallery', 'PostController@galleryAll');
        Route::get('gallery/album/{id}', 'PostController@imageAll');
        Route::post('post-share', 'AccountController@myPost');
        Route::get('alumni/home', 'DirectoryController@timeLine');
        Route::get('alumni/post/{id}', 'DirectoryController@viewPost');
        Route::post('report-post', 'DirectoryController@report');
        Route::post('deletePost/{id}', 'AccountController@deletePost');
        Route::post('delete-post', 'AccountController@deleteMyPost');
        Route::get('my_profile/myPost', 'AccountController@allMyPost');

        Route::get('post/like/{id}/{owner}', ['as' => 'post.like', 'uses' => 'LikeController@likePost']);
        Route::get('notification/{id}', 'DirectoryController@viewNotification');
        Route::get('read-all', 'DirectoryController@markAll');

        //GTS
        Route::get('/gts/{id}/{c}', 'GTS\GTSController@gts')->name('gts');
        Route::post('/gts', 'GTS\GTSController@store')->name('save');

        //category 1

        Route::get('/gtsdeg/{id}', 'GTS\GTSController@loadDeg')->name('load-deg');
        Route::post('/educ','GTS\EducController@store')->name('educ-save');
        Route::delete('/educ/{id}','GTS\EducController@destroy')->name('ed-delete');
        Route::post('/educ/{id}','GTS\EducController@destroy')->name('ed-delete');
        Route::get('/getEduc/{id}', 'GTS\EducController@loadEduc')->name('load-educ');
//exams
        Route::post('/prof','GTS\ExamController@store')->name('exam-save');
        Route::delete('/exams/{id}','GTS\ExamController@destroy')->name('prof-delete');
        Route::get('/getExams/{id}', 'GTS\ExamController@loadExam')->name('load-exam');
        Route::get('/exam/{id}','GTS\ExamController@destroy')->name('prof-del');
//skills

        Route::post('/skills','GTS\SkillsController@store')->name('skills-save');
        Route::delete('/skills/{id}','GTS\SkillsController@destroy')->name('skills-delete');
        Route::post('/skills/{id}','GTS\SkillsController@destroy')->name('skills-delete');
        Route::get('/loadSkills/{id}', 'GTS\SkillsController@loadSkills')->name('load-skills');
//training
        Route::post('/training','GTS\TrainingsController@store')->name('training-save');
        Route::delete('/training/{id}','GTS\TrainingsController@destroy')->name('training-delete');
        Route::post('/training/{id}','GTS\TrainingsController@destroy')->name('training-delete');
        Route::get('/loadTraining/{id}', 'GTS\TrainingsController@loadTrainings')->name('load-trainings');
    });
    Route::get('/resendCode', 'AccountController@resend');
    Route::get('/edit-user', 'AccountController@viewForm');
    Route::post('/update-user', 'AccountController@updateUsersEmail');
});

Route::group(['middleware' => 'isAdmin'], function() {
    Route::prefix('admin')->group( function () {
        Route::get('news', 'Admin\NewsController@allNews');
        Route::prefix('news')->group( function() {
            Route::get('create', 'Admin\NewsController@newNews');
            Route::get('edit/{id}', 'Admin\NewsController@editNews');
            Route::post('update/{id}', 'Admin\NewsController@updateNews');
            Route::get('delete/{id}', 'Admin\NewsController@deleteNews');
            Route::post('publish', 'Admin\NewsController@news');
        });

        Route::get('events', 'Admin\EventController@allEvents');
        Route::prefix('events')->group( function() {
            Route::get('create', 'Admin\EventController@newEvent');
            Route::get('edit/{id}', 'Admin\EventController@editEvent');
            Route::post('update/{id}', 'Admin\EventController@updateEvent');
            Route::get('delete/{id}', 'Admin\EventController@deleteEvent');
            Route::post('publish', 'Admin\EventController@event');
        });

        Route::get('announcements', 'Admin\AnnouncementController@allAnns');
        Route::prefix('announcements')->group( function() {
            Route::get('create', 'Admin\AnnouncementController@newAnn');
            Route::get('edit/{id}', 'Admin\AnnouncementController@editAnn');
            Route::post('update/{id}', 'Admin\AnnouncementController@updateAnn');
            Route::get('delete/{id}', 'Admin\AnnouncementController@deleteAnn');
            Route::post('publish', 'Admin\AnnouncementController@ann');
        });

        Route::get('opportunities', 'Admin\OpportunityController@allOpps');
        Route::prefix('opportunities')->group( function () {
            Route::get('create', 'Admin\OpportunityController@newOpp');
            Route::get('edit/{id}', 'Admin\OpportunityController@editOpp');
            Route::post('update/{id}', 'Admin\OpportunityController@updateOpp');
            Route::get('delete/{id}', 'Admin\OpportunityController@deleteOpp');
            Route::post('publish', 'Admin\OpportunityController@opp');
        });

        Route::get('reunions', 'Admin\ReunionController@allReus');
        Route::prefix('reunions')->group( function (){
            Route::get('create', 'Admin\ReunionController@newReu');
            Route::get('edit/{id}', 'Admin\ReunionController@editReu');
            Route::post('update/{id}', 'Admin\ReunionController@updateReu');
            Route::get('delete/{id}', 'Admin\ReunionController@deleteReu');
            Route::post('publish', 'Admin\ReunionController@reu');
        });

        Route::get('files', 'Admin\FileController@allFiles');
        Route::prefix('files')->group( function (){
            Route::get('create', 'Admin\FileController@newFile');
            Route::get('edit/{id}', 'Admin\FileController@editFile');
            Route::post('update/{id}', 'Admin\FileController@updateFile');
            Route::get('delete/{id}', 'Admin\FileController@deleteFile');
            Route::post('publish', 'Admin\FileController@file');
        });

        Route::get('galleries', 'Admin\FileController@allAlbums');
        Route::prefix('galleries')->group( function (){
            Route::get('create', 'Admin\FileController@newAlbum');
            Route::get('edit/{id}', 'Admin\FileController@editAlbum');
            Route::post('update/{id}', 'Admin\FileController@updateAlbum');
            Route::get('delete/{id}', 'Admin\FileController@deleteAlbum');
            Route::post('publish', 'Admin\FileController@album');
            Route::get('album/image/delete/{a_id}/{id}', 'Admin\FileController@deleteImage');
            Route::get('album/{id}', 'Admin\FileController@allImages')->name('album');
            Route::get('album/{id}/upload', 'Admin\FileController@uploadImages');
            Route::post('album/{id}/upload/save', 'Admin\FileController@saveImages');
        });

        Route::get('slides', 'Admin\SlideShowController@allSlides');
        Route::prefix('slides')->group( function (){
            Route::post('upload', 'Admin\SlideShowController@upload');
            Route::get('jcrop/{id}', 'Admin\SlideShowController@viewCrop');
            Route::post('upjcrop/{id}', 'Admin\SlideShowController@jcropUp');
            Route::get('edit/{id}', 'Admin\SlideShowController@edit');
            Route::post('update/{id}', 'Admin\SlideShowController@update');
            Route::get('delete/{id}', 'Admin\SlideShowController@deleteSlide');
        });

        Route::get('users', 'Admin\AdminController@allUsers');
        Route::prefix('users')->group( function (){
            Route::get('q', 'Admin\AdminController@search');
            Route::get('info/{id}', 'Admin\AdminController@userInfo');
            Route::post('edit/{id}', 'Admin\AdminController@userPayment');
            Route::post('claim/{id}', 'Admin\AdminController@userClaim');
        });

        Route::get('post', 'Admin\AdminController@allPost');
        Route::prefix('post')->group( function () {
            Route::get('view/{id}', 'Admin\AdminController@viewPost');
            Route::get('allow/{id}', 'Admin\AdminController@allowPost');
            Route::get('delete/{id}', 'Admin\AdminController@deletePost');
        });

        Route::post('upload_image', 'Admin\FileController@ckUpload');
        //gts admin
        Route::resource('/category','GTS\CategoryController');;//->name('cat');
        Route::resource('/item','GTS\ItemsController');

        //hidden
        Route::resource('/hidden','GTS\HiddenController',[
            'only'=>['edit','store','destroy']
        ]);
        //load choices
        Route::get('/hidden/loadCh/{id}','HiddenController@loadChoices')->name('loadChoices');
        });
        //choices controller
        Route::resource('/choices','GTS\ChoiceController');
        //load choices
        Route::get('/hidden/loadCh/{id}','GTS\HiddenController@loadChoices')->name('loadChoices');

        //gts report

        Route::resource('/report','GTS\ReportController');
        Route::get('/report/loadCh/{id}','GTS\ReportController@loadChoices')->name('loadCh');

        Route::get('/report/dl/{file}','GTS\ReportController@download')->name('report-dl');

        // migrations
        //load items
        Route::get('/loadItems/{id}', 'GTS\MigrateChoicesController@loadItems')->name('load-items')->middleware('auth');
        //migrate
        Route::resource('/migrateChoices','GTS\MigrateChoicesController',['middleware'=>'auth',
            'only'=>['index','store']
        ]);

        //answers migrate
        Route::resource('/answersM','GTS\AnswerMController',['middleware'=>'auth',
            'only'=>['index','store']
        ]);

        //answers proffSills
        Route::resource('/profSkillsM','GTS\ProfSkillsMController',[
            'only'=>['index','store']
        ]);

        //choices controller
        Route::resource('/choices','GTS\ChoiceController');

        //trainings
        Route::resource('/trainingsM','GTS\TrainingsMController',[
            'only'=>['index','store'],
        ]);

        //trainings
        Route::resource('/educM','GTS\EducMController',[
            'only'=>['index','store']
        ]);
        //something
        Route::resource('/examM','GTS\ProfExamMController',[
            'only'=>['index','store'],
        ]);


});
//unverified accounts
Route::group(['middleware' => 'isActive'], function(){
    Route::get('/verifyemail/{token}', 'Auth\RegisterController@verify')->name('try');
});
//register Controller
Route::get('/stud', 'Auth\RegisterController@studentMap');
Route::get('/verify', function (){
    return view('verify.not-verified');
});
Route::get('email-sent', function() {
    return view('verify.change-email-verification');
});
Route::get('register-2', 'Auth\RegisterController@register2');

Route::get('notify', function (){
    $email = new \App\Mail\EmailVerification(Auth::user());
    Mail::to(Auth::user()->email)->send($email);
    return "Event has been sent!";
});
