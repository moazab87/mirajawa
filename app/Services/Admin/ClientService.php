<?php

namespace App\Services\Admin;

use App\Models\Client;
use App\Models\User;
use Illuminate\Contracts\View\View;

class ClientService
{
    /**
     * Shared dropdowns (cached) for create/edit forms.
     */
    private function dropdowns(): array
    {
        $users = User::all();

        return compact('users');
    }

    /**
     * Static page meta shared between create/edit.
     */
    private function basePageData(): array
    {
        return [
            'active'     => 'clients',
            'title'      => __('route.clients.index'),
            'singleName' => 'client',
            'route'      => route('admin.clients.index'),
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
        return $this->renderForm('admin.clients.create', [
            'subTitle'   => __('route.clients.create'),
            'storeRoute' => route('admin.clients.store'),
        ]);
    }

    public function edit(Client $client): View
    {
        return $this->renderForm('admin.clients.edit', [
            'subTitle'    => __('route.clients.edit'),
            'updateRoute' => route('admin.clients.update', $client->id),
            'model'       => $client,
        ]);
    }
}
