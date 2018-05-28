<?php

use App\Http\Controllers;

/** @var \Framework\Http\Application $app */

$app->get('home', '/', Controllers\HomeController::class);
$app->post('auth.register', '/auth/register', [Controllers\AuthController::class, 'register']);