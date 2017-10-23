<?php

Route::get('/', 'Dashboard@index')->name('admin_dashboard');

Route::get('/events', function () {
    return 'Admin Events';
})->name('admin_events');