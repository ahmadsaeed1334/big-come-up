<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\SettingsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function edit(SettingsService $settings)
    {
        $title = "General Setting";

        $data = $settings->getAll();
        return view('admin.settings.edit', compact('data', 'title'));
    }

    public function update(Request $request, SettingsService $settings)
    {
        $data = $settings->getAll();

        $validated = $request->validate([
            // General text fields
            'company_name' => ['nullable', 'string', 'max:255'],
            'company_description' => ['nullable', 'string', 'max:500'],
            'email' => ['nullable', 'email', 'max:255'],
            'website' => ['nullable', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50'],
            'fax' => ['nullable', 'string', 'max:50'],
            'address' => ['nullable', 'string', 'max:500'],

            'system_timezone' => ['nullable', 'string', 'max:100'],
            'default_password' => ['nullable', 'string', 'max:255'],

            'per_page_items' => ['nullable', 'integer', 'min:1', 'max:200'],
            'date_format' => ['nullable', 'string', 'max:50'],
            'layout' => ['nullable', 'string', 'max:50'],
            'primary_color' => ['nullable', 'string', 'max:50'],
            'default_language' => ['nullable', 'string', 'max:50'],

            // SweetAlert
            'sa_default_title' => ['nullable', 'string', 'max:255'],
            'sa_default_message' => ['nullable', 'string', 'max:500'],
            'sa_display_time' => ['nullable', 'integer', 'min:500', 'max:10000'],
            'sa_background_color' => ['nullable', 'string', 'max:20'],
            'sa_position' => ['nullable', 'string', 'max:50'],

            // Email settings
            'from_name' => ['nullable', 'string', 'max:255'],
            'from_email' => ['nullable', 'email', 'max:255'],
            'reply_to_name' => ['nullable', 'string', 'max:255'],
            'reply_to_email' => ['nullable', 'email', 'max:255'],

            // Files
            'white_logo' => ['nullable', 'image', 'mimes:png,jpg,jpeg,webp', 'max:2048'],
            'black_logo' => ['nullable', 'image', 'mimes:png,jpg,jpeg,webp', 'max:2048'],
            'favicon' => ['nullable', 'image', 'mimes:png,jpg,jpeg,webp,ico', 'max:1024'],
        ]);

        // ---------- Uploads ----------
        $data['general']['white_logo'] = $this->handleImage(
            $request,
            'white_logo',
            $data['general']['white_logo']
        );

        $data['general']['black_logo'] = $this->handleImage(
            $request,
            'black_logo',
            $data['general']['black_logo']
        );

        $data['general']['favicon'] = $this->handleImage(
            $request,
            'favicon',
            $data['general']['favicon']
        );

        // ---------- General ----------
        $data['general']['company_name'] = $validated['company_name'] ?? $data['general']['company_name'];
        $data['general']['company_description'] = $validated['company_description'] ?? $data['general']['company_description'];

        $data['general']['email'] = $validated['email'] ?? $data['general']['email'];
        $data['general']['website'] = $validated['website'] ?? $data['general']['website'];
        $data['general']['phone'] = $validated['phone'] ?? $data['general']['phone'];
        $data['general']['fax'] = $validated['fax'] ?? $data['general']['fax'];
        $data['general']['address'] = $validated['address'] ?? $data['general']['address'];

        $data['general']['system_timezone'] = $validated['system_timezone'] ?? $data['general']['system_timezone'];
        $data['general']['default_password'] = $validated['default_password'] ?? $data['general']['default_password'];

        $data['general']['per_page_items'] = $validated['per_page_items'] ?? $data['general']['per_page_items'];
        $data['general']['date_format'] = $validated['date_format'] ?? $data['general']['date_format'];
        $data['general']['layout'] = $validated['layout'] ?? $data['general']['layout'];
        $data['general']['primary_color'] = $validated['primary_color'] ?? $data['general']['primary_color'];
        $data['general']['default_language'] = $validated['default_language'] ?? $data['general']['default_language'];

        // ---------- SweetAlert ----------
        $data['sweetalert']['default_title'] = $validated['sa_default_title'] ?? $data['sweetalert']['default_title'];
        $data['sweetalert']['default_message'] = $validated['sa_default_message'] ?? $data['sweetalert']['default_message'];
        $data['sweetalert']['display_time'] = $validated['sa_display_time'] ?? $data['sweetalert']['display_time'];
        $data['sweetalert']['background_color'] = $validated['sa_background_color'] ?? $data['sweetalert']['background_color'];
        $data['sweetalert']['position'] = $validated['sa_position'] ?? $data['sweetalert']['position'];

        // ---------- Email ----------
        $data['email_settings']['from_name'] = $validated['from_name'] ?? $data['email_settings']['from_name'];
        $data['email_settings']['from_email'] = $validated['from_email'] ?? $data['email_settings']['from_email'];
        $data['email_settings']['reply_to_name'] = $validated['reply_to_name'] ?? $data['email_settings']['reply_to_name'];
        $data['email_settings']['reply_to_email'] = $validated['reply_to_email'] ?? $data['email_settings']['reply_to_email'];

        // Save JSON
        $settings->putAll($data);

        toast_updated('Settings');

        return back();
    }

    private function handleImage(Request $request, string $key, ?string $oldPath): ?string
    {
        if (!$request->hasFile($key)) {
            return $oldPath;
        }

        // delete old
        if ($oldPath && Storage::disk('public')->exists($oldPath)) {
            Storage::disk('public')->delete($oldPath);
        }

        // store new
        return $request->file($key)->store('settings', 'public');
    }
}
