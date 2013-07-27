<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

/** ------------------------------------------
 *  Route model binding
 *  ------------------------------------------
 */
Route::model('user', 'User');
Route::model('comment', 'Comment');
Route::model('post', 'Post');
Route::model('role', 'Role');
Route::model('advertiser', 'Advertiser');
Route::model('type', 'Type');
Route::model('ad', 'Ad');
Route::model('organization', 'Organization');
Route::model('interaction', 'Interaction');

/** ------------------------------------------
 *  Admin Routes
 *  ------------------------------------------
 */
Route::group(array('prefix' => 'admin', 'before' => 'auth'), function()
{

    # Comment Management
    Route::get('comments/{comment}/edit', 'AdminCommentsController@getEdit')
        ->where('comment', '[0-9]+');
    Route::post('comments/{comment}/edit', 'AdminCommentsController@postEdit')
        ->where('comment', '[0-9]+');
    Route::get('comments/{comment}/delete', 'AdminCommentsController@getDelete')
        ->where('comment', '[0-9]+');
    Route::post('comments/{comment}/delete', 'AdminCommentsController@postDelete')
        ->where('comment', '[0-9]+');
    Route::controller('comments', 'AdminCommentsController');

    # Blog Management
    Route::get('blogs/{post}/show', 'AdminBlogsController@getShow')
        ->where('post', '[0-9]+');
    Route::get('blogs/{post}/edit', 'AdminBlogsController@getEdit')
        ->where('post', '[0-9]+');
    Route::post('blogs/{post}/edit', 'AdminBlogsController@postEdit')
        ->where('post', '[0-9]+');
    Route::get('blogs/{post}/delete', 'AdminBlogsController@getDelete')
        ->where('post', '[0-9]+');
    Route::post('blogs/{post}/delete', 'AdminBlogsController@postDelete')
        ->where('post', '[0-9]+');
    Route::controller('blogs', 'AdminBlogsController');

    # User Management
    Route::get('users/{user}/show', 'AdminUsersController@getShow')
        ->where('user', '[0-9]+');
    Route::get('users/{user}/edit', 'AdminUsersController@getEdit')
        ->where('user', '[0-9]+');
    Route::post('users/{user}/edit', 'AdminUsersController@postEdit')
        ->where('user', '[0-9]+');
    Route::get('users/{user}/delete', 'AdminUsersController@getDelete')
        ->where('user', '[0-9]+');
    Route::post('users/{user}/delete', 'AdminUsersController@postDelete')
        ->where('user', '[0-9]+');
    Route::controller('users', 'AdminUsersController');

    # User Role Management
    Route::get('roles/{role}/show', 'AdminRolesController@getShow')
        ->where('role', '[0-9]+');
    Route::get('roles/{role}/edit', 'AdminRolesController@getEdit')
        ->where('role', '[0-9]+');
    Route::post('roles/{role}/edit', 'AdminRolesController@postEdit')
        ->where('role', '[0-9]+');
    Route::get('roles/{role}/delete', 'AdminRolesController@getDelete')
        ->where('role', '[0-9]+');
    Route::post('roles/{role}/delete', 'AdminRolesController@postDelete')
        ->where('role', '[0-9]+');
    Route::controller('roles', 'AdminRolesController');

      # Advertisers  Management
    Route::get('advertisers/{advertiser}/show', 'AdminAdvertisersController@getShow')
        ->where('advertiser', '[0-9]+');
    Route::get('advertisers/{advertiser}/edit', 'AdminAdvertisersController@getEdit')
        ->where('advertiser', '[0-9]+');
    Route::post('advertisers/{advertiser}/edit', 'AdminAdvertisersController@postEdit')
        ->where('advertiser', '[0-9]+');
    Route::get('advertisers/{advertiser}/delete', 'AdminAdvertisersController@getDelete')
        ->where('advertiser', '[0-9]+');
    Route::post('advertisers/{advertiser}/delete', 'AdminAdvertisersController@postDelete')
        ->where('advertiser', '[0-9]+');
    Route::controller('advertisers', 'AdminAdvertisersController');

    # Types  Management
    Route::get('types/{type}/show', 'AdminTypesController@getShow')
        ->where('type', '[0-9]+');
    Route::get('types/{type}/edit', 'AdminTypesController@getEdit')
        ->where('type', '[0-9]+');
    Route::post('types/{type}/edit', 'AdminTypesController@postEdit')
        ->where('type', '[0-9]+');
    Route::get('types/{type}/delete', 'AdminTypesController@getDelete')
        ->where('type', '[0-9]+');
    Route::post('types/{type}/delete', 'AdminTypesController@postDelete')
        ->where('type', '[0-9]+');
    Route::controller('types', 'AdminTypesController');

    # Ads  Management
    Route::get('ads/{ad}/show', 'AdminAdsController@getShow')
        ->where('ad', '[0-9]+');
    Route::get('ads/{ad}/edit', 'AdminAdsController@getEdit')
        ->where('ad', '[0-9]+');
    Route::post('ads/{ad}/edit', 'AdminAdsController@postEdit')
        ->where('ad', '[0-9]+');
    Route::get('ads/{ad}/delete', 'AdminAdsController@getDelete')
        ->where('ad', '[0-9]+');
    Route::post('ads/{ad}/delete', 'AdminAdsController@postDelete')
        ->where('ad', '[0-9]+');
    Route::controller('ads', 'AdminAdsController');

    # Organizations  Management
    Route::get('organizations/{organization}/show', 'AdminOrganizationsController@getShow')
        ->where('organization', '[0-9]+');
    Route::get('organizations/{organization}/edit', 'AdminOrganizationsController@getEdit')
        ->where('organization', '[0-9]+');
    Route::post('organizations/{organization}/edit', 'AdminOrganizationsController@postEdit')
        ->where('organization', '[0-9]+');
    Route::get('organizations/{organization}/delete', 'AdminOrganizationsController@getDelete')
        ->where('organization', '[0-9]+');
    Route::post('organizations/{organization}/delete', 'AdminOrganizationsController@postDelete')
        ->where('organization', '[0-9]+');
    Route::controller('organizations', 'AdminOrganizationsController');


    # Interactions  Management
    Route::get('interactions/{interaction}/show', 'AdminInteractionsController@getShow')
        ->where('interaction', '[0-9]+');
 //   Route::get('organizations/{organization}/edit', 'AdminOrganizationsController@getEdit')
   //     ->where('organization', '[0-9]+');
 //   Route::post('organizations/{organization}/edit', 'AdminOrganizationsController@postEdit')
   //     ->where('organization', '[0-9]+');
   // Route::get('organizations/{organization}/delete', 'AdminOrganizationsController@getDelete')
     //   ->where('organization', '[0-9]+');
   // Route::post('organizations/{organization}/delete', 'AdminOrganizationsController@postDelete')
     //   ->where('organization', '[0-9]+');
    Route::controller('interactions', 'AdminInteractionsController');

    #For use cases involving successful deletion of a database record
      # Admin Dashboard
    Route::get('successful-delete', 'AdminDashboardController@getSuccessfulDelete');

    # Admin Dashboard
    Route::controller('/', 'AdminDashboardController');
});


/** ------------------------------------------
 *  Frontend Routes
 *  ------------------------------------------
 */

// User reset routes
Route::get('user/reset/{token}', 'UserController@getReset')
    ->where('token', '[0-9a-z]+');
// User password reset
Route::post('user/reset/{token}', 'UserController@postReset')
    ->where('token', '[0-9a-z]+');
//:: User Account Routes ::
Route::post('user/{user}/edit', 'UserController@postEdit')
    ->where('user', '[0-9]+');

//:: User Account Routes ::
Route::post('user/login', 'UserController@postLogin');

# User RESTful Routes (Login, Logout, Register, etc)
Route::controller('user', 'UserController');

//:: Application Routes ::

# Filter for detect language
Route::when('contact-us','detectLang');

# Blog Route
Route::get('blog', array('before' => 'detectLang','uses' => 'BlogController@getIndex'));

# Contact Us Static Page
Route::get('contact-us', function()
{
    // Return about us page
    return View::make('site/pages/contact-us');
});

# Posts - Second to last set, match slug
Route::get('{postSlug}', 'BlogController@getView');
Route::post('{postSlug}', 'BlogController@postView');

# Index Page - Last route, no matches
Route::get('/', function()
{
    // Return about us page
    return View::make('site/pages/home');
});





Route::resource('interactions', 'InteractionsController');