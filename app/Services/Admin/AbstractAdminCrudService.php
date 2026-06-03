<?php

namespace App\Services\Admin;

use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

abstract class AbstractAdminCrudService
{
    abstract protected function modelClass(): string;

    abstract protected function activeKey(): string;

    abstract protected function routeKey(): string;

    abstract protected function singleName(): string;

    protected function dropdowns(): array
    {
        return [];
    }

    protected function dashboardModule(): string
    {
        return dashboard_module_key($this->routeKey());
    }

    protected function basePageData(): array
    {
        return [
            'active'     => $this->activeKey(),
            'title'      => __("dashboard.{$this->dashboardModule()}.index"),
            'singleName' => $this->singleName(),
            'route'      => route("admin.{$this->routeKey()}.index"),
        ];
    }

    protected function renderForm(string $view, array $data = []): View
    {
        return view($view, array_merge($this->basePageData(), $this->dropdowns(), $data));
    }

    public function create(): View
    {
        return $this->renderForm("admin.{$this->routeKey()}.create", [
            'subTitle'   => __("dashboard.{$this->dashboardModule()}.create"),
            'storeRoute' => route("admin.{$this->routeKey()}.store"),
        ]);
    }

    public function edit(Model $model): View
    {
        return $this->renderForm("admin.{$this->routeKey()}.edit", [
            'subTitle'    => __("dashboard.{$this->dashboardModule()}.edit"),
            'updateRoute' => route("admin.{$this->routeKey()}.update", $model->id),
            'model'       => $model,
        ]);
    }

    public function store(array $data): array
    {
        ($this->modelClass())::create($data);

        return ['key' => 'success', 'msg' => __("dashboard.{$this->dashboardModule()}.created_successfully")];
    }

    public function update(Model $model, array $data): array
    {
        $model->update($data);

        return ['key' => 'success', 'msg' => __("dashboard.{$this->dashboardModule()}.updated_successfully")];
    }

    public function delete(Model $model): array
    {
        $model->delete();

        return ['key' => 'success', 'msg' => __("dashboard.{$this->dashboardModule()}.deleted_successfully")];
    }

    public function changeStatus(Model $model, int $status): array
    {
        $model->update(['status' => $status]);

        return ['key' => 'success', 'msg' => __("dashboard.{$this->dashboardModule()}.status_updated_successfully")];
    }

    public function indexExtraData(Request $request): array
    {
        return [];
    }
}
