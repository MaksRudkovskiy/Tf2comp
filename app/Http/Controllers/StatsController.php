<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Mistake;
use App\Models\Article;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\Shared\Html;

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

        $articlesData = $this->getDailyStats(
            Article::query(),
            $startDate,
            $endDate,
            $dates
        );

        return view('admin.sections.stats', [
            'usersData' => $usersData,
            'mistakesData' => $mistakesData,
            'postsData' => $articlesData,
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

    public function exportToWord()
    {
        $data = $this->getStatsData();

        $phpWord = new PhpWord();
        $section = $phpWord->addSection();

        $section->addText(
            'Статистика за последние 30 дней',
            ['bold' => true, 'size' => 16],
            ['alignment' => 'center']
        );

        $this->addStatSection($phpWord, $section, 'Регистрации пользователей', $data['usersData']);

        $this->addStatSection($phpWord, $section, 'Сообщенные ошибки', $data['mistakesData']);

        $this->addStatSection($phpWord, $section, 'Добавленные статьи', $data['articlesData']);

        $filename = 'statistics_' . date('Y-m-d') . '.docx';
        header("Content-Description: File Transfer");
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
        header('Content-Transfer-Encoding: binary');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Expires: 0');

        $objWriter = IOFactory::createWriter($phpWord, 'Word2007');
        $objWriter->save('php://output');
        exit;
    }

    protected function getStatsData()
    {
        $days = 30;
        $endDate = Carbon::now();
        $startDate = $endDate->copy()->subDays($days);

        $dates = [];
        for ($date = $startDate->copy(); $date <= $endDate; $date->addDay()) {
            $dates[$date->format('Y-m-d')] = 0;
        }

        return [
            'usersData' => $this->getDailyStats(User::query(), $startDate, $endDate, $dates),
            'mistakesData' => $this->getDailyStats(Mistake::query(), $startDate, $endDate, $dates),
            'articlesData' => $this->getDailyStats(Article::query(), $startDate, $endDate, $dates),
        ];
    }

    protected function addStatSection($phpWord, $section, $title, $data)
    {
        $section->addTextBreak();
        $section->addText(
            $title,
            ['bold' => true, 'size' => 14],
            ['alignment' => 'left']
        );

        $table = $section->addTable(['borderSize' => 6, 'borderColor' => '000000']);
        $table->addRow();
        $table->addCell(2000)->addText('Дата', ['bold' => true]);
        $table->addCell(2000)->addText('Количество', ['bold' => true]);
        $table->addCell(2000)->addText('Накопленная сумма', ['bold' => true]);

        foreach ($data as $item) {
            $table->addRow();
            $table->addCell()->addText($item['date']);
            $table->addCell()->addText($item['count']);
            $table->addCell()->addText($item['cumulative']);
        }

        $section->addTextBreak();
    }
}
