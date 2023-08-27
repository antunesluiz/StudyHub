<?php

namespace App\Helpers;

use Carbon\Carbon;

class DateHelper
{
    /**
     * Obtém o mês de início com base no mês atual e no número de meses anteriores.
     *
     * Esta função calcula e retorna uma instância Carbon representando o mês de início
     * com base no mês atual e no número de meses anteriores especificado.
     *
     * @param Carbon $currentMonth O mês atual como uma instância Carbon.
     * @param int $numberOfMonths O número de meses anteriores para retroceder.
     * @return Carbon Uma instância Carbon do mês de início.
     */
    public function getStartingMonth(Carbon $currentMonth, int $numberOfMonths): Carbon
    {
        return $currentMonth->copy()->subMonths($numberOfMonths);
    }
}