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
                'brands'            => BrandsController::class,
                // 'sliders'           => SlidersController::class,
                'contacts'          => ContactsController::class,
                'users'             => UsersController::class,
                'settings'          => SettingsController::class
            ]);

            Route::post('categories/update', 'CategoriesController@update')->name('categories.update');
            Route::get('categories/destroy/{id}', 'CategoriesController@destroy');
            Route::get('categories/force/{id}', 'CategoriesController@force');
            Route::get('categories/restore/{id}', 'CategoriesController@restore');
            Route::delete('categories/destroy/all', 'CategoriesController@multi_delete');

            Route::post('brands/update', 'BrandsController@update')->name('brands.update');
            Route::get('brands/destroy/{id}', 'BrandsController@destroy');
            Route::delete('brands/destroy/all', 'BrandsController@multi_delete');

            // Route::post('sliders/update', 'SlidersController@update')->name('sliders.update');
            // Route::get('sliders/destroy/{id}', 'SlidersController@destroy');
            // Route::delete('sliders/destroy/all', 'SlidersController@multi_delete');

            Route::get('contacts/destroy/{id}', 'ContactsController@destroy');

            Route::get('users/destroy/{id}', 'UsersController@destroy');
            Route::delete('users/destroy/all', 'UsersController@multi_delete');

            Route::get('settings', 'SettingsController@index')->name('settings.index');
            Route::post('settings', 'SettingsController@update')->name('settings.update');
        });
    }
);

Route::get('/categories/trashed', [App\Http\Controllers\Admin\CategoriesController::class, 'trashed'])
    ->name('categories.trashed')->middleware('auth');
Route::get('/brands/trashed', [App\Http\Controllers\Admin\BrandsController::class, 'trashed'])
    ->name('brands.trashed')->middleware('auth');
