<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Mistake;
use App\Models\Section;
use Illuminate\Support\Facades\DB;

class StatsController extends Controller
{
    public function index()
    {
        // Статистика пользователей за последние 30 дней
        $usersData = User::select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('count(*) as count')
        )
            ->where('created_at', '>=', now()->subDays(30))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // Статистика ошибок за последние 30 дней
        $mistakesData = Mistake::select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('count(*) as count')
        )
            ->where('created_at', '>=', now()->subDays(30))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // Статистика статей за последние 30 дней
        $postsData = Section::where('type', 'blog')->select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('count(*) as count')
        )
            ->where('created_at', '>=', now()->subDays(30))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        return view('admin.sections.stats', compact('usersData', 'mistakesData', 'postsData'));
    }
}
