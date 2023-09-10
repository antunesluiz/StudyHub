<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\AdminStudentResource;
use App\Services\Admin\AdminStudentService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminStudentController extends Controller
{
    /**
     * Exibe a página principal de alunos.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Inertia\Response
     */
    public function index(Request $request)
    {
        return Inertia::render('Admin/User/Student/Index', [
            'students'  => AdminStudentResource::collection((new AdminStudentService)->getStudents($request->get('filter'))),
            'filter'    => $request->get('filter') ?? ''
        ]);
    }

    /**
     * Exibe a página de criação de um novo aluno.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        return Inertia::render('Admin/User/Student/Create');
    }
}
