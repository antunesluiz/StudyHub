<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\AdminStudentResource;
use App\Services\Admin\AdminStudentService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminStudentController extends Controller
{
    public function index(Request $request) {
        $students = (new AdminStudentService)->getStudents($request->get('filter'));

        return Inertia::render('Admin/User/Student/Index', [
            'students'  => AdminStudentResource::collection($students),
            'filter'    => $request->get('filter')
        ]);
    }
}
