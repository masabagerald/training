<?php
Route::get('/', function () { return redirect('/admin/home'); });

// Authentication Routes...
$this->get('login', 'Auth\LoginController@showLoginForm')->name('auth.login');
$this->post('login', 'Auth\LoginController@login')->name('auth.login');
$this->post('logout', 'Auth\LoginController@logout')->name('auth.logout');

// Change Password Routes...
$this->get('change_password', 'Auth\ChangePasswordController@showChangePasswordForm')->name('auth.change_password');
$this->patch('change_password', 'Auth\ChangePasswordController@changePassword')->name('auth.change_password');

// Password Reset Routes...
$this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('auth.password.reset');
$this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('auth.password.reset');
$this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
$this->post('password/reset', 'Auth\ResetPasswordController@reset')->name('auth.password.reset');
Route::group(['middleware' => ['auth'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/home', 'HomeController@index');



    Route::get('try', function () {

    });






    Route::get('/calendar', 'Admin\SystemCalendarController@index');

    Route::resource('roles', 'Admin\RolesController');
    Route::post('roles_mass_destroy', ['uses' => 'Admin\RolesController@massDestroy', 'as' => 'roles.mass_destroy']);
    Route::resource('users', 'Admin\UsersController');
    Route::post('users_mass_destroy', ['uses' => 'Admin\UsersController@massDestroy', 'as' => 'users.mass_destroy']);
    Route::resource('designations', 'Admin\DesignationsController');
    Route::post('designations_mass_destroy', ['uses' => 'Admin\DesignationsController@massDestroy', 'as' => 'designations.mass_destroy']);
    Route::post('designations_restore/{id}', ['uses' => 'Admin\DesignationsController@restore', 'as' => 'designations.restore']);

    Route::post('designations_import', ['uses' => 'Admin\DesignationsController@import', 'as' => 'designations.import']);


    Route::delete('designations_perma_del/{id}', ['uses' => 'Admin\DesignationsController@perma_del', 'as' => 'designations.perma_del']);
    Route::resource('participants', 'Admin\ParticipantsController');
    Route::post('participants_mass_destroy', ['uses' => 'Admin\ParticipantsController@massDestroy', 'as' => 'participants.mass_destroy']);
    Route::post('participants_restore/{id}', ['uses' => 'Admin\ParticipantsController@restore', 'as' => 'participants.restore']);
    Route::delete('participants_perma_del/{id}', ['uses' => 'Admin\ParticipantsController@perma_del', 'as' => 'participants.perma_del']);
    Route::get('search/participant', ['uses' => 'Admin\ParticipantsController@search', 'as' => 'trainings.search']);

    Route::post('check_userpin', ['uses' => 'Admin\ParticipantsController@check_userpin', 'as' => 'participants.check_userpin']);


    Route::resource('trainings', 'Admin\TrainingsController');
    Route::post('trainings_mass_destroy', ['uses' => 'Admin\TrainingsController@massDestroy', 'as' => 'trainings.mass_destroy']);
    Route::post('trainings_restore/{id}', ['uses' => 'Admin\TrainingsController@restore', 'as' => 'trainings.restore']);
    Route::delete('trainings_perma_del/{id}', ['uses' => 'Admin\TrainingsController@perma_del', 'as' => 'trainings.perma_del']);

    Route::get('training/participants', ['uses' => 'Admin\TrainingsController@participant_page', 'as' => 'trainings.participant_page']);

    Route::get('save_and_add_part', ['uses' => 'Admin\TrainingsController@save_and_add', 'as' => 'trainings.save_and_add']);
    Route::post('saveParticipant', ['uses' => 'Admin\TrainingsController@saveParticipant', 'as' => 'trainings.saveParticipant']);
    Route::get('try/{training}', ['uses' => 'Admin\TrainingsController@page', 'as' => 'trainings.page']);

    Route::post('attach/participants', ['uses' => 'Admin\TrainingsController@attachparts', 'as' => 'trainings.attachparts']);
    Route::post('upload', ['uses' => 'Admin\ParticipantsController@uploadExcel', 'as' => 'trainings.uploadExcel']);

    Route::post('import', ['uses' => 'Admin\ParticipantsController@import', 'as' => 'trainings.import']);

    Route::post('grade/participants', ['uses' => 'Admin\TrainingsController@gradeparts', 'as' => 'trainings.gradeparts']);
    Route::post('updatepivot', ['uses' => 'Admin\TrainingsController@updatepivot', 'as' => 'trainings.updatepivot']);

    Route::post('addParticipant', ['uses' => 'Admin\TrainingsController@addParticipant', 'as' => 'trainings.addParticipant']);






    //Route::get('attach/participants', ['uses' => 'Admin\TrainingsController@attachparts', 'as' => 'trainings.attachpart']);


    //Route::get('/home', 'TrainingsController@page');




    Route::get('/admin/tryme', function () {return view('admin.trainings.participant_page');});

    //  Route::get('/tryme', ['uses' => 'function () {return view(\'admin.trainings.participant_page\');}', 'as' => 'trainings.tryme']);




    Route::resource('user_actions', 'Admin\UserActionsController');
    Route::post('/spatie/media/upload', 'Admin\SpatieMediaController@create')->name('media.upload');
    Route::post('/spatie/media/remove', 'Admin\SpatieMediaController@destroy')->name('media.remove');

    Route::resource('results', 'Admin\ResultsController');
    Route::post('results_mass_destroy', ['uses' => 'Admin\ResultsController@massDestroy', 'as' => 'results.mass_destroy']);

    Route::resource('training_types', 'Admin\TrainingTypeController');
    Route::post('training_types_mass_destroy', ['uses' => 'Admin\TrainingTypeController@massDestroy', 'as' => 'training_types.mass_destroy']);

    Route::resource('facilities', 'Admin\FacilitiesController');
    Route::post('facilities_import', ['uses' => 'Admin\FacilitiesController@import', 'as' => 'facilities.import']);

    Route::resource('interviewees', 'Admin\IntervieweeController');
    Route::resource('assessments', 'Admin\AssessmentController');
    Route::resource('categories', 'Admin\CategoryController');
    Route::resource('subcategories', 'Admin\SubcategoryController');

    Route::resource('reports', 'Admin\ReportController');
    Route::post('reports_mass_destroy', ['uses' => 'Admin\ReportController@massDestroy', 'as' => 'reports.mass_destroy']);
    Route::post('reports_restore/{id}', ['uses' => 'Admin\ReportController@restore', 'as' => 'reports.restore']);
    Route::delete('reports_perma_del/{id}', ['uses' => 'Admin\ReportController@perma_del', 'as' => 'reports.perma_del']);


    Route::resource('mentorship', 'Admin\MentorshipController');
    Route::post('mentorship_mass_destroy', ['uses' => 'Admin\MentorshipController@massDestroy', 'as' => 'mentorship.mass_destroy']);
    Route::post('mentorship_restore/{id}', ['uses' => 'Admin\MentorshipController@restore', 'as' => 'mentorship.restore']);
    Route::delete('mentorship_perma_del/{id}', ['uses' => 'Admin\MentorshipController@perma_del', 'as' => 'mentorship.perma_del']);

    Route::resource('mentorship_categories', 'Admin\MentorshipCategoryController');
    Route::post('category_mass_destroy', ['uses' => 'Admin\MentorshipCategoryController@massDestroy', 'as' => 'mentorship_categories.mass_destroy']);
    Route::post('category_restore/{id}', ['uses' => 'Admin\MentorshipCategoryControllerr@restore', 'as' => 'mentorship_categories.restore']);
    Route::delete('category_perma_del/{id}', ['uses' => 'Admin\MentorshipCategoryControllerr@perma_del', 'as' => 'mentorship_categories.perma_del']);











});
