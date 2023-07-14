<?php

require_once 'App/controllers/HomeController.php';
require_once 'App/controllers/MembersController.php';
require_once 'App/controllers/InputController.php';
require_once 'App/controllers/ImageController.php';
require_once 'App/controllers/EmailController.php';

// Routing logic
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if ($_SERVER['REQUEST_URI'] === '/mvc/') {
        App\Controllers\HomeController::index();
    } elseif ($_SERVER['REQUEST_URI'] === '/mvc/members') {
        App\Controllers\MembersController::index();
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_SERVER['REQUEST_URI'] === '/mvc/input') {
        App\Controllers\InputController::form_submission();
    } elseif ($_SERVER['REQUEST_URI'] === '/mvc/check-image') {
        App\Controllers\ImageController::checkImage();
    } elseif ($_SERVER['REQUEST_URI'] === '/mvc/validate-email') {
        App\Controllers\EmailController::checkEmail();
    }
}


