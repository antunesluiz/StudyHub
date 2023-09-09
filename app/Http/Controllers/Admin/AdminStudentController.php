<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminStudentController extends Controller
{
    public function index() {
        return Inertia::render('Admin/User/Student/Index', [
        ]);
    }
}
