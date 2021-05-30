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
                'services'          => ServicesController::class,
                'invoices'          => InvoicesController::class,
                'notifications'     => NotificationsController::class,
                'contacts'          => ContactsController::class,
                'roles'             => RolesController::class,
                'users'             => UsersController::class,
                'reports'           => ReportsController::class,
                'settings'          => SettingsController::class
            ]);

            Route::post('services/update', 'ServicesController@update')->name('services.update');
            Route::get('services/destroy/{id}', 'ServicesController@destroy');
            Route::delete('services/destroy/all', 'ServicesController@multi_delete');
            Route::post('services/updateStatus/{id}', 'ServicesController@updateStatus');

            Route::get('invoices/destroy/{id}', 'InvoicesController@destroy');

            Route::get('notifications/destroy/{id}', 'NotificationsController@destroy');

            Route::get('contacts/destroy/{id}', 'ContactsController@destroy');

            Route::post('constants/update', 'ConstantsController@update')->name('constants.update');
            Route::get('constants/destroy/{id}', 'ConstantsController@destroy');
            Route::delete('constants/destroy/all', 'ConstantsController@multi_delete');
            Route::post('constants/updateStatus/{id}', 'ConstantsController@updateStatus');

            Route::get('payments/destroy/{id}', 'PaymentsController@destroy');

            Route::get('receipts/destroy/{id}', 'ReceiptsController@destroy');

            Route::get('transactions/destroy/{id}', 'TransactionsController@destroy');

            Route::post('roles/update', 'RolesController@update')->name('roles.update');
            Route::get('roles/destroy/{id}', 'RolesController@destroy');
            Route::delete('roles/destroy/all', 'RolesController@multi_delete');

            Route::post('users/update', 'UsersController@update')->name('users.update');
            Route::get('users/destroy/{id}', 'UsersController@destroy');
            Route::delete('users/destroy/all', 'UsersController@multi_delete');
            Route::post('users/updateStatus/{id}', 'UsersController@updateStatus');

            Route::get('reports/destroy/{id}', 'ReportsController@destroy');

            Route::get('settings', 'SettingsController@index')->name('settings.index');
            Route::post('settings', 'SettingsController@update')->name('settings.update');
        });
    }
);
