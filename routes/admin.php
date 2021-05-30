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
                'appointments'      => AppointmentsController::class,
                'patients'          => PatientsController::class,
                'services'          => ServicesController::class,
                'drugs'             => DrugsController::class,
                'tests'             => TestsController::class,
                'invoices'          => InvoicesController::class,
                'notifications'     => NotificationsController::class,
                'contacts'          => ContactsController::class,
                'countries'         => CountriesController::class,
                'cities'            => CitiesController::class,
                'districts'         => DistrictsController::class,
                'locations'         => LocationsController::class,
                'constants'         => ConstantsController::class,
                'payments'          => PaymentsController::class,
                'receipts'          => ReceiptsController::class,
                'transactions'      => TransactionsController::class,
                'roles'             => RolesController::class,
                'users'             => UsersController::class,
                'reports'           => ReportsController::class,
                'settings'          => SettingsController::class
            ]);

            Route::post('appointments/update', 'AppointmentsController@update')->name('appointments.update');
            Route::get('appointments/destroy/{id}', 'AppointmentsController@destroy');
            Route::delete('appointments/destroy/all', 'AppointmentsController@multi_delete');
            Route::post('appointments/updateStatus/{id}', 'AppointmentsController@updateStatus');

            Route::post('patients/update', 'PatientsController@update')->name('patients.update');
            Route::get('patients/destroy/{id}', 'PatientsController@destroy');
            Route::delete('patients/destroy/all', 'PatientsController@multi_delete');
            Route::post('patients/updateStatus/{id}', 'PatientsController@updateStatus');

            Route::post('services/update', 'ServicesController@update')->name('services.update');
            Route::get('services/destroy/{id}', 'ServicesController@destroy');
            Route::delete('services/destroy/all', 'ServicesController@multi_delete');
            Route::post('services/updateStatus/{id}', 'ServicesController@updateStatus');

            Route::post('drugs/update', 'DrugsController@update')->name('drugs.update');
            Route::get('drugs/destroy/{id}', 'DrugsController@destroy');
            Route::delete('drugs/destroy/all', 'DrugsController@multi_delete');
            Route::post('drugs/updateStatus/{id}', 'DrugsController@updateStatus');

            Route::post('tests/update', 'TestsController@update')->name('tests.update');
            Route::get('tests/destroy/{id}', 'TestsController@destroy');
            Route::delete('tests/destroy/all', 'TestsController@multi_delete');
            Route::post('tests/updateStatus/{id}', 'TestsController@updateStatus');

            Route::get('invoices/destroy/{id}', 'InvoicesController@destroy');

            Route::get('notifications/destroy/{id}', 'NotificationsController@destroy');

            Route::get('contacts/destroy/{id}', 'ContactsController@destroy');

            Route::post('countries/update', 'CountriesController@update')->name('countries.update');
            Route::get('countries/destroy/{id}', 'CountriesController@destroy');
            Route::delete('countries/destroy/all', 'CountriesController@multi_delete');
            Route::post('countries/updateStatus/{id}', 'CountriesController@updateStatus');

            Route::post('cities/update', 'CitiesController@update')->name('cities.update');
            Route::get('cities/destroy/{id}', 'CitiesController@destroy');
            Route::delete('cities/destroy/all', 'CitiesController@multi_delete');
            Route::post('cities/updateStatus/{id}', 'CitiesController@updateStatus');

            Route::post('districts/update', 'DistrictsController@update')->name('districts.update');
            Route::get('districts/destroy/{id}', 'DistrictsController@destroy');
            Route::delete('districts/destroy/all', 'DistrictsController@multi_delete');
            Route::post('districts/updateStatus/{id}', 'DistrictsController@updateStatus');

            Route::post('locations/update', 'LocationsController@update')->name('locations.update');
            Route::get('locations/destroy/{id}', 'LocationsController@destroy');
            Route::delete('locations/destroy/all', 'LocationsController@multi_delete');
            Route::post('locations/updateStatus/{id}', 'LocationsController@updateStatus');

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

// Select Location
Route::get('get_cities', [App\Http\Controllers\Admin\LocationsController::class, 'get_cities']);
Route::get('get_districts', [App\Http\Controllers\Admin\LocationsController::class, 'get_districts']);
