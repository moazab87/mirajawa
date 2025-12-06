<?php

namespace App\Services\Admin;

use App\Models\Client;
use App\Models\project;
use App\Models\Team;
use Illuminate\Contracts\View\View;

class ProjectService
{
    /**
     * Shared dropdowns (cached) for create/edit forms.
     */
    private function dropdowns(): array
    {

        $teams = Team::query()
                ->select('id', 'name')
                ->orderBy('name')
                ->pluck('name', 'id')
                ->toArray();

        $clients = Client::query()
                ->select('id', 'name')
                ->orderBy('name')
                ->pluck('name', 'id')
                ->toArray();


        return compact('teams', 'clients');
    }

    /**
     * Static page meta shared between create/edit.
     */
    private function basePageData(): array
    {
        return [
            'active'     => 'projects',
            'title'      => __('route.projects.index'),
            'singleName' => 'project',
            'route'      => route('admin.projects.index'),
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
        return $this->renderForm('admin.projects.create', [
            'subTitle'   => __('route.projects.create'),
            'storeRoute' => route('admin.projects.store'),
        ]);
    }

    public function edit(Project $project): View
    {
        return $this->renderForm('admin.projects.edit', [
            'subTitle'    => __('route.projects.edit'),
            'updateRoute' => route('admin.projects.update', $project->id),
            'model'       => $project->loadMissing(['team:id,name', 'creator:id,name']),
        ]);
    }
}
