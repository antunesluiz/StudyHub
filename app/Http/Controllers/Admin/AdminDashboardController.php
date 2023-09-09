<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\AdminDashboardService;
use Inertia\Inertia;

class AdminDashboardController extends Controller
{
    /**
     * Página inicial do painel de administração.
     *
     * Esta função é responsável por renderizar a página inicial do painel de administração.
     *
     * @param AdminDashboardService $adminDashboardService Uma instância do serviço de painel de administração.
     * @return \Inertia\Response A resposta Inertia que renderiza a página do painel de administração com dados do gráfico de estudantes.
    */
    public function index(AdminDashboardService $adminDashboardService)
    {
        return Inertia::render('Admin/Index', [
            'studentChart' => $adminDashboardService->getStudentChart(),
            'CoursesChart' => $adminDashboardService->getCoursesChart(),
            'classesChart' => $adminDashboardService->getClassesChart()
        ]);
    }
}
