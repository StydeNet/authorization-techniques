<?php

Route::get('/', 'Dashboard@index')->name('client_dashboard');

Route::get('/events', function () {
    return 'Client Events';
})->name('client_events');