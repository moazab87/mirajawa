<?php

namespace App\Services\Admin;

use App\Models\ContactInformation;
use Illuminate\Database\Eloquent\Model;

class ContactInformationService extends AbstractAdminCrudService
{
    protected function modelClass(): string
    {
        return ContactInformation::class;
    }

    protected function activeKey(): string
    {
        return 'contactInformation';
    }

    protected function routeKey(): string
    {
        return 'contactInformation';
    }

    protected function singleName(): string
    {
        return 'contactInformation';
    }

    public function store(array $data): array
    {
        $data = $this->handleImage($data);
        ContactInformation::create($data);

        return ['key' => 'success', 'msg' => __('dashboard.contact_information.created_successfully')];
    }

    public function update(Model $model, array $data): array
    {
        $data = $this->handleImage($data, $model);

        return parent::update($model, $data);
    }

    private function handleImage(array $data, ?ContactInformation $model = null): array
    {
        if (isset($data['image']) && is_file($data['image'])) {
            if ($model?->image) {
                deleteImage(public_path('uploads/contact_information/' . $model->image));
            }
            $data['image'] = uploadImage(ContactInformation::IMAGEPATH, $data['image']);
        } else {
            unset($data['image']);
        }

        return $data;
    }
}
