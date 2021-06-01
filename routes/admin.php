<?php

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\Route;

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath'],
    ],
    function () {
        Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
            Route::get('/', [AdminController::class, 'index'])->name('index');

            Route::resources([
                'categories'        => CategoriesController::class,
                'contacts'          => ContactsController::class,
                'roles'             => RolesController::class,
                'users'             => UsersController::class,
                'settings'          => SettingsController::class
            ]);

            Route::post('categories/update', 'CategoriesController@update')->name('categories.update');
            Route::get('categories/destroy/{id}', 'CategoriesController@destroy');
            Route::delete('categories/destroy/all', 'CategoriesController@multi_delete');
            Route::post('categories/updateStatus/{id}', 'CategoriesController@updateStatus');

            Route::get('contacts/destroy/{id}', 'ContactsController@destroy');

            Route::post('roles/update', 'RolesController@update')->name('roles.update');
            Route::get('roles/destroy/{id}', 'RolesController@destroy');
            Route::delete('roles/destroy/all', 'RolesController@multi_delete');

            Route::post('users/update', 'UsersController@update')->name('users.update');
            Route::get('users/destroy/{id}', 'UsersController@destroy');
            Route::delete('users/destroy/all', 'UsersController@multi_delete');
            Route::post('users/updateStatus/{id}', 'UsersController@updateStatus');

            Route::get('settings', 'SettingsController@index')->name('settings.index');
            Route::post('settings', 'SettingsController@update')->name('settings.update');
        });
    }
);
