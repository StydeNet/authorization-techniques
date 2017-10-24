<?php

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

Route::catch(function () {
    throw new NotFoundHttpException;
});

Route::get('/', 'Dashboard@index')->name('admin_dashboard');

Route::get('/events', function () {
    return 'Admin Events';
})->name('admin_events');

Route::post('/events/create', function () {
    return 'Event created!';
});

