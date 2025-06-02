<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Mistake;
use App\Models\Article;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class StatsController extends Controller
{
    public function index()
    {
        $days = 30;
        $endDate = Carbon::now();
        $startDate = $endDate->copy()->subDays($days);

        $dates = [];
        for ($date = $startDate->copy(); $date <= $endDate; $date->addDay()) {
            $dates[$date->format('Y-m-d')] = 0;
        }

        $usersData = $this->getDailyStats(
            User::query(),
            $startDate,
            $endDate,
            $dates
        );

        $mistakesData = $this->getDailyStats(
            Mistake::query(),
            $startDate,
            $endDate,
            $dates
        );

        // Изменён запрос для статей
        $articlesData = $this->getDailyStats(
            Article::query(), // Теперь берём все статьи
            $startDate,
            $endDate,
            $dates
        );

        return view('admin.sections.stats', [
            'usersData' => $usersData,
            'mistakesData' => $mistakesData,
            'postsData' => $articlesData, // Переименовали переменную для ясности
            'days' => $days
        ]);
    }

    protected function getDailyStats($query, $startDate, $endDate, $dates)
    {
        $dbData = $query
            ->select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('count(*) as count')
            )
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->pluck('count', 'date')
            ->toArray();

        // Исправленный расчёт накопленной суммы
        $cumulativeSum = 0;
        $result = [];

        foreach ($dates as $date => $count) {
            $dailyCount = $dbData[$date] ?? 0;
            $cumulativeSum += $dailyCount;

            $result[] = [
                'date' => $date,
                'count' => $dailyCount,
                'cumulative' => $cumulativeSum
            ];
        }

        return $result;
    }
}
