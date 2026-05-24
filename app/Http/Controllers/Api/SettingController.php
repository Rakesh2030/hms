<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        // New API CRUD: send current settings as JSON.
        $setting = Setting::first();

        return response()->json([
            'status' => true,
            'data' => $setting,
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'site_name' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'favicon' => 'nullable|image|mimes:jpg,jpeg,png,ico,webp|max:1024',
            'footer_text' => 'nullable|string|max:255',
        ]);

        $setting = Setting::firstOrCreate([]);
        $setting->site_name = $request->site_name;
        $setting->footer_text = $request->footer_text;

        if ($request->hasFile('logo')) {
            $setting->logo = $this->uploadFile($request->file('logo'), 'logo');
        }

        if ($request->hasFile('favicon')) {
            $setting->favicon = $this->uploadFile($request->file('favicon'), 'favicon');
        }

        $setting->save();

        return response()->json([
            'status' => true,
            'message' => 'Settings updated successfully.',
            'data' => $setting,
        ]);
    }

    private function uploadFile($file, $name)
    {
        $folder = public_path('uploads/settings');

        if (! file_exists($folder)) {
            mkdir($folder, 0755, true);
        }

        $fileName = $name . '-' . time() . '.' . $file->getClientOriginalExtension();
        $file->move($folder, $fileName);

        return 'uploads/settings/' . $fileName;
    }
}
