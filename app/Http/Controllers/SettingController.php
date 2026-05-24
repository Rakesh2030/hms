<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    // This web controller now opens the settings Blade page.
    // Old normal settings update code is kept below for interview explanation.
    // New API CRUD code is inside app/Http/Controllers/Api/SettingController.php.

    // Show the settings form to the admin user.
    public function edit()
    {
        $setting = Setting::first();

        return view('settings.edit', compact('setting'));
    }

    // Save site settings and uploaded images in the public uploads folder.
    public function update(Request $request)
    {
        // Old normal CRUD code: settings form submitted directly to this controller.
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

        return redirect()->route('settings.edit')->with('success', 'Settings updated successfully.');
    }

    // Move uploaded file to public/uploads/settings and return path for database.
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
