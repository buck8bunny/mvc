<?php
namespace App\Controllers;

class MembersController
{
    public static function index()
    {
        // Load the view
        include 'views/members.php';
    }
}
