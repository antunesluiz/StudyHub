<?php

namespace App\Services\Admin;

use App\Helpers\ChartHelper;
use App\Helpers\DateHelper;
use App\Repositories\CourseRepository;
use App\Repositories\UserRepository;
use Carbon\Carbon;

class AdminDashboardService
{
    /**
     * Assistente de datas.
     *
     * @var DateHelper
     */
    protected $dateHelper;

    /**
     * Assistente de datas.
     *
     * @var ChartHelper
     */
    protected $chartHelper;

    /**
     * Construtor da classe.
     *
     * @param UserRepository $userRepository Instância do repositório de usuários.
     * @param DateHelper $dateHelper Instância do assistente de datas.
     */
    public function __construct(DateHelper $dateHelper, ChartHelper $chartHelper)
    {
        $this->dateHelper = $dateHelper;
        $this->chartHelper = $chartHelper;
    }

    /**
     * Obtém os dados do gráfico de estudantes.
     *
     * Esta função recupera os totais de estudantes a partir de uma data específica
     * e formata os dados para o gráfico.
     *
     * @param int $numberOfMonths Número de meses para incluir no gráfico (opcional, padrão é 4).
     * @return array Retorna um array contendo os totais de estudantes e os nomes dos meses.
     */
    public function getStudentChart(int $numberOfMonths = 4): array
    {
        $currentMonth = Carbon::now()->startOfMonth();

        $totals = (new UserRepository)->getStudentTotalsFromDate($this->dateHelper->getStartingMonth($currentMonth, $numberOfMonths));

        return $this->chartHelper->formatChartData($totals, $currentMonth, $numberOfMonths);
    }

    public function getCoursesChart(int $numberOfMonths = 4)
    {
        $currentMonth = Carbon::now()->startOfMonth();

        $totals = (new CourseRepository)->getCoursesTotalsFromDate($this->dateHelper->getStartingMonth($currentMonth, $numberOfMonths));

        return $this->chartHelper->formatChartData($totals, $currentMonth, $numberOfMonths);
    }

    public function getClassesChart(int $numberOfMonths = 4)
    {
        $currentMonth = Carbon::now()->startOfMonth();

        // $totals = $this->userRepository->getStudentTotalsFromDate($this->dateHelper->getStartingMonth($currentMonth, $numberOfMonths));

        //return $this->chartHelper->formatChartData($totals, $currentMonth, $numberOfMonths);
    }
}
