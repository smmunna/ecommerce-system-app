<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    //
    public function setting()
    {
        $settings = Setting::first(); // Assuming you have only one settings record
        return view('pages.dashboard.admin.basic_rules.settings.settings', compact('settings'));
    }

    public function update(Request $request)
    {
        $settings = Setting::first();

        // Validate the request
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'facebook' => 'nullable|string|max:255',
            'twitter' => 'nullable|string|max:255',
            'instagram' => 'nullable|string|max:255',
            'linkedin' => 'nullable|string|max:255',
            'youtube' => 'nullable|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'favicon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'currency' => 'required|string|max:255',
            'currency_symbol' => 'required|string|max:255',
        ]);

        // Update settings
        $settings->title = $request->input('title');
        $settings->description = $request->input('description');
        $settings->email = $request->input('email');
        $settings->phone = $request->input('phone');
        $settings->address = $request->input('address');
        $settings->facebook = $request->input('facebook');
        $settings->twitter = $request->input('twitter');
        $settings->instagram = $request->input('instagram');
        $settings->linkedin = $request->input('linkedin');
        $settings->youtube = $request->input('youtube');
        $settings->currency = $request->input('currency');
        $settings->currency_symbol = $request->input('currency_symbol');

        // Handle logo upload
        if ($request->hasFile('logo')) {
            // Delete the existing logo if exists
            if ($settings->logo) {
                Storage::disk('public')->delete($settings->logo);
            }

            // Store the new logo
            $logo = $request->file('logo');
            $logoPath = $logo->store('uploads/logo', 'public');
            $settings->logo = $logoPath;
        }

        // Handle favicon upload
        if ($request->hasFile('favicon')) {
            // Delete the existing favicon if exists
            if ($settings->favicon) {
                Storage::disk('public')->delete($settings->favicon);
            }

            // Store the new favicon
            $favicon = $request->file('favicon');
            $faviconPath = $favicon->store('uploads/favicon', 'public');
            $settings->favicon = $faviconPath;
        }

        $settings->save();

        return redirect()->back()->with('success', 'Settings updated successfully.');
    }
}
