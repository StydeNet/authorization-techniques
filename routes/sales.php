<?php

Route::get('/', 'Dashboard@index')->name('sales_dashboard');

Route::get('/events', function () {
    return 'Sales Events';
})->name('sales_events');