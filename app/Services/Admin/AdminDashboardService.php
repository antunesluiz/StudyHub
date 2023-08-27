<?php

namespace App\Services\Admin;

use App\Helpers\DateHelper;
use App\Repositories\UserRepository;
use Carbon\Carbon;

class AdminDashboardService
{
    /**
     * Repositório de usuários.
     *
     * @var UserRepository
     */
    protected $userRepository;

    /**
     * Assistente de datas.
     *
     * @var DateHelper
     */
    protected $dateHelper;

    /**
     * Construtor da classe.
     *
     * @param UserRepository $userRepository Instância do repositório de usuários.
     * @param DateHelper $dateHelper Instância do assistente de datas.
     */
    public function __construct(UserRepository $userRepository, DateHelper $dateHelper)
    {
        $this->userRepository = $userRepository;
        $this->dateHelper = $dateHelper;
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
        $startingMonth = $this->dateHelper->getStartingMonth($currentMonth, $numberOfMonths);

        $totals = $this->userRepository->getStudentTotalsFromDate($startingMonth);

        return $this->formatChartData($totals, $currentMonth, $numberOfMonths);
    }

    /**
     * Formata os dados para o gráfico com base nos totais de estudantes e no intervalo de datas.
     *
     * @param \Illuminate\Support\Collection $totals Totais de estudantes.
     * @param Carbon $currentMonth Data do mês atual.
     * @param int $numberOfMonths Número de meses para formatar os dados.
     * @return array Retorna um array contendo totais e nomes de meses.
     */
    private function formatChartData($data, Carbon $currentMonth, int $numberOfMonths): array
    {
        $results = [];
        $monthNames = [];
        $monthlyTotals = $data['monthlyTotals'];
        $totalStudents = $data['totalStudents'];
        $totalForPeriod = 0;
    
        for ($i = 0; $i < $numberOfMonths; $i++) {
            $year = $currentMonth->year;
            $month = $currentMonth->month;
            $monthName = $currentMonth->isoFormat('MMMM');
    
            $totalForPeriod += $monthlyTotals["$year-$month"]->total ?? 0;
            $results[] = $monthlyTotals["$year-$month"]->total ?? 0;
            $monthNames[] = $monthName;
    
            $currentMonth->subMonth();
        }
    
        // Calcula a porcentagem de aumento para o período em relação ao total anterior
        $percentageIncrease = $totalStudents ? ($totalForPeriod / $totalStudents) * 100 : 0;
    
        return [
            'totals' => array_reverse($results),
            'monthNames' => array_reverse($monthNames),
            'percentageIncrease' => $percentageIncrease,
            'totalStudents' => $totalStudents
        ];
    }
}
