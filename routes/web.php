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
    Route::delete('designations_perma_del/{id}', ['uses' => 'Admin\DesignationsController@perma_del', 'as' => 'designations.perma_del']);
    Route::resource('participants', 'Admin\ParticipantsController');
    Route::post('participants_mass_destroy', ['uses' => 'Admin\ParticipantsController@massDestroy', 'as' => 'participants.mass_destroy']);
    Route::post('participants_restore/{id}', ['uses' => 'Admin\ParticipantsController@restore', 'as' => 'participants.restore']);
    Route::delete('participants_perma_del/{id}', ['uses' => 'Admin\ParticipantsController@perma_del', 'as' => 'participants.perma_del']);
    Route::get('search/participant', ['uses' => 'Admin\ParticipantsController@search', 'as' => 'trainings.search']);

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




 
});