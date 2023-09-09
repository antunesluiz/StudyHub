<?php

namespace App\Helpers;

use Carbon\Carbon;

class ChartHelper
{
    /**
     * Formata os dados para o gráfico com base nos totais de estudantes e no intervalo de datas.
     *
     * @param \Illuminate\Support\Collection $totals Totais de estudantes.
     * @param Carbon $currentMonth Data do mês atual.
     * @param int $numberOfMonths Número de meses para formatar os dados.
     * @return array Retorna um array contendo totais e nomes de meses.
     */
    public function formatChartData($data, Carbon $currentMonth, int $numberOfMonths): array
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