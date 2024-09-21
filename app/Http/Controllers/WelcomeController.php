<?php

namespace App\Http\Controllers;

use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class WelcomeController extends Controller
{
    use ApiResponse;

    public function index()
    {
        $data = [
            'name' => 'Prasasti To-Do List API',
            'version' => '1.0.0',
            'description' => 'A PHP with Laravel-based API for managing tasks and subtasks (Sprint Asia Technical Test)',
        ];

        return $this->successResponse($data, 'Selamat Datang!');
    }
}