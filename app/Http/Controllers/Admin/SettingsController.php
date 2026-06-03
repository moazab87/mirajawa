<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Response;

class SettingsController extends Controller
{
    public function index()
    {
        return view('admin.settings.index',
            [
                'title'         => __('dashboard.settings.index'),
                'active'        => 'settings',
                'settings'      => Settings::get()->keyBy('key')->all(),
            ]);
    }

    public function update(Request $request)
    {
        $inputs = $request->except('_token');
        $files  = $request->allFiles();

        DB::beginTransaction();

        try {
            foreach ($inputs as $key => $value) {
                $setting = Settings::firstOrNew(['key' => $key]);
                $setting->value = $value;
                $setting->save();
            }

            // Handle file uploads
            foreach ($files as $key => $file) {
                if ($request->hasFile($key)) {
                    $setting = Settings::firstOrNew(['key' => $key]);

                    if (!empty($setting->value)) {
                        deleteImage(public_path("uploads/settings/{$setting->value}"));
                    }

                    $setting->value = uploadImage('settings', $request->file($key));
                    $setting->save();
                }
            }

            DB::commit();

            session()->flash('success', __('dashboard.settings.updated_successfully'));
        } catch (\Exception $e) {
            dd($e->getMessage());
            DB::rollBack();
            session()->flash('error', __('dashboard.messages.error'));
        }

        return back();
    }


    public function deleteSettingPhoto($key)
    {
        $setting = Settings::where('key', $key)->first();

        if ($setting != '') {
            deleteImage(public_path("uploads/settings/$setting->value"));
            $setting->value = '';
            $setting->update();
        }

        session()->flash('success', trans('common.successMessageText'));
        return back();
    }

}
