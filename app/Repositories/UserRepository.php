<?php

namespace App\Repositories;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class UserRepository
{
    /**
     * Obtém os totais de estudantes a partir de uma determinada data.
     *
     * Esta função recupera os totais de estudantes registrados após uma data específica.
     * Ela conta quantos estudantes foram criados em cada mês, a partir da data fornecida,
     * e retorna um array associativo onde as chaves são no formato "ANO-MÊS" e os valores são
     * os totais de estudantes para esse mês.
     *
     * @param Carbon $fromDate Data a partir da qual os totais de estudantes serão calculados.
     * @return \Illuminate\Support\Collection Um objeto Collection contendo os totais de estudantes por mês.
     */
    public function getStudentTotalsFromDate(Carbon $fromDate)
    {
        // Query para totais mensais
        $monthlyTotals = User::role('student')
            ->select(DB::raw('YEAR(created_at) as year, MONTH(created_at) as month, COUNT(*) as total'))
            ->where('created_at', '>=', $fromDate)
            ->groupBy(DB::raw('YEAR(created_at), MONTH(created_at)'))
            ->get()
            ->keyBy(function ($date) {
                return $date->year . '-' . $date->month;
            });

        // Subquery para o total de alunos
        $totalStudents = User::role('student')->count();

        return [
            'monthlyTotals' => $monthlyTotals,
            'totalStudents' => $totalStudents
        ];
    }

    /**
     * Retorna uma lista paginada de alunos filtrados com base em uma pesquisa e quantidade de páginas.
     *
     * @param string $search A string de pesquisa para filtrar os alunos.
     * @param int $pages O número de alunos por página a ser exibido.
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getFilteredStudents($search = '', $pages = 20)
    {
        return User::search($search)
            ->query(function ($query) {
                $query->role('student')
                    ->whereDoesntHave('roles', function ($q) {
                        $q->whereIn('name', ['admin', 'teacher']);
                    });
            })
            ->paginate($pages);
    }

    public function createNewUser($data)
    {
        return User::create($data);
    }
}
