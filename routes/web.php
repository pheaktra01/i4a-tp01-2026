<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return response()->json([
        'message' => 'welcome deployed by Pheaktra using Jenkins'
    ]);
});
