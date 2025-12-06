<?php

namespace App\Services\Admin;

use App\Models\Client;
use App\Models\Project;
use App\Models\Task;
use App\Models\Team;
use App\Models\User;
use Illuminate\Contracts\View\View;

class TaskService
{
    /**
     * Shared dropdowns (cached) for create/edit forms.
     */
    private function dropdowns(): array
    {
        $clients = Client::query()
            ->select('id', 'name')
            ->orderBy('name')
            ->pluck('name', 'id')
            ->toArray();

        $users = User::query()
            ->select('id', 'name')
            ->orderBy('name')
            ->pluck('name', 'id')
            ->toArray();

        // $assignees where hs is a team leader only
        $leaders = Team::query()
            ->distinct()
            ->join('users', 'teams.leader_id', '=', 'users.id')
            ->select('users.id', 'users.name')
            ->orderBy('users.name')
            ->pluck('users.name', 'users.id')
            ->toArray();

        $tasks = Task::all()->pluck('title', 'id')->toArray();

        return compact('clients', 'users', 'tasks', 'leaders');
    }

    /**
     * Static page meta shared between create/edit.
     */
    private function basePageData(): array
    {
        return [
            'active'     => 'tasks',
            'title'      => __('admin.tasks'),
            'singleName' => 'task',
            'route'      => route('admin.tasks.index'),
        ];
    }

    /**
     * Helper to render create/edit with merged data.
     */
    private function renderForm(string $view, array $data = []): View
    {
        return view($view, array_merge(
            $this->basePageData(),
            $this->dropdowns(),
            $data
        ));
    }

    public function create(): View
    {
        return $this->renderForm('admin.tasks.create', [
            'subTitle'   => __('admin.create'),
            'storeRoute' => route('admin.tasks.store'),
        ]);
    }

    public function edit(Task $task): View
    {
        $task->load('project');
        $projects = [];

        if ($task->project && $task->project->client_id) {
            $locale = app()->getLocale();
            $projects = Project::where('client_id', $task->project->client_id)
                ->toBase()
                ->select('id')
                ->selectRaw("JSON_UNQUOTE(JSON_EXTRACT(name, '$.\"$locale\"')) as name")
                ->orderBy('name')
                ->pluck('name', 'id')
                ->toArray();
        }

        return $this->renderForm('admin.tasks.edit', [
            'subTitle'    => __('admin.edit'),
            'updateRoute' => route('admin.tasks.update', $task->id),
            'model'       => $task,
            'projects'    => $projects,
        ]);
    }
}
