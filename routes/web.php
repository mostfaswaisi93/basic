<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('admin.index');
});

Auth::routes(['register' => false]);
