<?php

namespace App\Services\Admin;

use Alkoumi\LaravelHijriDate\Hijri;
use App\Enums\StatusModelsEnum;
use App\Enums\TaskStatusTypeEnum;
use App\Models\Admin;
use App\Models\Task;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardService
{
    public function getDashboardData()
    {
        Hijri::setLang(defaultLang());

        return [
            'active'        => 'dashboard',
            'title'         => __('admin.AdminPanel'),
            'dataHijri'     => Hijri::Date('j F  Y'),
            'usersCount'    => User::count(),
            'adminsCount'   => Admin::count(),
            // 'tasksCount'    => Task::count(),
            // 'projectsCount' => DB::table('projects')->count(),

            // 'tasks_TODO'        => $this->getValuesChart($this->getTasksChart(TaskStatusTypeEnum::TODO->value)),
            // 'tasks_IN_PROGRESS' => $this->getValuesChart($this->getTasksChart(TaskStatusTypeEnum::IN_PROGRESS->value)),
            // 'tasks_DONE'        => $this->getValuesChart($this->getTasksChart(TaskStatusTypeEnum::DONE->value)),
            'usersStatistics'   => $this->getValuesChart(DB::table('users')
                ->select(DB::raw('DATE_FORMAT(created_at, "%m") AS month'), DB::raw('COUNT(id) as count'))
                ->groupBy('month')
                ->get()),
        ];
    }

    // private function getTasksChart($status)
    // {
    //     return DB::table('tasks')
    //         ->select(DB::raw('DATE_FORMAT(created_at, "%m") AS month'), DB::raw('COUNT(id) as count'))
    //         ->where('status', $status)
    //         ->groupBy('month')
    //         ->get();
    // }

    private function getValuesChart($countTasks)
    {
        $start  = Carbon::parse('2023-01-01');
        $end    = Carbon::parse('2023-12-01');
        $months = [];
        for ($i = 0; $i <= $start->diffInMonths($end); $i++) {
            $months[] = $start->copy()->addMonths($i)->format('m');
        }

        $monthsArray         = $countTasks->pluck('month')->toArray();
        $countArray          = $countTasks->pluck('count')->toArray();
        $monthsAndTotalArray = array_combine($monthsArray, $countArray);
        $values              = [];

        foreach ($months as $key => $month) {
            $values[$key] = $monthsAndTotalArray[$month] ?? 0;
        }

        return $values;
    }
}
