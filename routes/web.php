<?php

use Illuminate\Support\Facades\Route;

Route::get('/', fn() => redirect()->route('filament.doctor.auth.login'));
