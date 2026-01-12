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

        // Position options for dropdowns
        $positionOptions = [
            'top-start' => 'Top Left',
            'top-end' => 'Top Right',
            'top-center' => 'Top Center',
            'center' => 'Center',
            'bottom-start' => 'Bottom Left',
            'bottom-end' => 'Bottom Right',
            'bottom-center' => 'Bottom Center',
        ];

        // Animation options
        $animationOptions = [
            'slide-from-top' => 'Slide from Top',
            'slide-from-bottom' => 'Slide from Bottom',
            'slide-from-left' => 'Slide from Left',
            'slide-from-right' => 'Slide from Right',
            'fade-in' => 'Fade In',
            'zoom-in' => 'Zoom In',
            'bounce' => 'Bounce',
        ];

        return view('admin.settings.edit', compact('data', 'title', 'positionOptions', 'animationOptions'));
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

            // SweetAlert Settings
            'sa_default_title' => ['nullable', 'string', 'max:255'],
            'sa_default_message' => ['nullable', 'string', 'max:500'],
            'sa_display_time' => ['nullable', 'integer', 'min:500', 'max:10000'],
            'sa_background_color' => ['nullable', 'string', 'max:20'],
            'sa_text_color' => ['nullable', 'string', 'max:20'],
            'sa_border_color' => ['nullable', 'string', 'max:20'],
            'sa_icon_color' => ['nullable', 'string', 'max:20'],
            'sa_position' => ['nullable', 'string', 'in:top-start,top-end,top-center,center,bottom-start,bottom-end,bottom-center'],
            'sa_icon' => ['nullable', 'string', 'in:success,error,warning,info,question'],
            'sa_animation' => ['nullable', 'string', 'max:50'],
            'sa_width' => ['nullable', 'string', 'max:50'],
            'sa_padding' => ['nullable', 'string', 'max:50'],
            'sa_show_confirm_button' => ['nullable', 'boolean'],
            'sa_timer_progress_bar' => ['nullable', 'boolean'],

            // Toast Messages
            'tm_created' => ['nullable', 'string', 'max:500'],
            'tm_updated' => ['nullable', 'string', 'max:500'],
            'tm_deleted' => ['nullable', 'string', 'max:500'],
            'tm_error' => ['nullable', 'string', 'max:500'],
            'tm_success' => ['nullable', 'string', 'max:500'],
            'tm_warning' => ['nullable', 'string', 'max:500'],
            'tm_info' => ['nullable', 'string', 'max:500'],

            // Toast Colors
            'tc_success_bg' => ['nullable', 'string', 'max:20'],
            'tc_success_text' => ['nullable', 'string', 'max:20'],
            'tc_error_bg' => ['nullable', 'string', 'max:20'],
            'tc_error_text' => ['nullable', 'string', 'max:20'],
            'tc_warning_bg' => ['nullable', 'string', 'max:20'],
            'tc_warning_text' => ['nullable', 'string', 'max:20'],
            'tc_info_bg' => ['nullable', 'string', 'max:20'],
            'tc_info_text' => ['nullable', 'string', 'max:20'],

            // Toast Positions
            'tp_success_position' => ['nullable', 'string', 'in:top-start,top-end,top-center,center,bottom-start,bottom-end,bottom-center'],
            'tp_error_position' => ['nullable', 'string', 'in:top-start,top-end,top-center,center,bottom-start,bottom-end,bottom-center'],
            'tp_warning_position' => ['nullable', 'string', 'in:top-start,top-end,top-center,center,bottom-start,bottom-end,bottom-center'],
            'tp_info_position' => ['nullable', 'string', 'in:top-start,top-end,top-center,center,bottom-start,bottom-end,bottom-center'],

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
        $data['sweetalert']['text_color'] = $validated['sa_text_color'] ?? $data['sweetalert']['text_color'];
        $data['sweetalert']['border_color'] = $validated['sa_border_color'] ?? $data['sweetalert']['border_color'];
        $data['sweetalert']['icon_color'] = $validated['sa_icon_color'] ?? $data['sweetalert']['icon_color'];
        $data['sweetalert']['position'] = $validated['sa_position'] ?? $data['sweetalert']['position'];
        $data['sweetalert']['icon'] = $validated['sa_icon'] ?? $data['sweetalert']['icon'];
        $data['sweetalert']['animation'] = $validated['sa_animation'] ?? $data['sweetalert']['animation'];
        $data['sweetalert']['width'] = $validated['sa_width'] ?? $data['sweetalert']['width'];
        $data['sweetalert']['padding'] = $validated['sa_padding'] ?? $data['sweetalert']['padding'];
        $data['sweetalert']['show_confirm_button'] = $request->boolean('sa_show_confirm_button', $data['sweetalert']['show_confirm_button'] ?? false);
        $data['sweetalert']['timer_progress_bar'] = $request->boolean('sa_timer_progress_bar', $data['sweetalert']['timer_progress_bar'] ?? true);

        // ---------- Toast Messages ----------
        $data['toast_messages']['created'] = $validated['tm_created'] ?? $data['toast_messages']['created'];
        $data['toast_messages']['updated'] = $validated['tm_updated'] ?? $data['toast_messages']['updated'];
        $data['toast_messages']['deleted'] = $validated['tm_deleted'] ?? $data['toast_messages']['deleted'];
        $data['toast_messages']['error'] = $validated['tm_error'] ?? $data['toast_messages']['error'];
        $data['toast_messages']['success'] = $validated['tm_success'] ?? $data['toast_messages']['success'];
        $data['toast_messages']['warning'] = $validated['tm_warning'] ?? $data['toast_messages']['warning'];
        $data['toast_messages']['info'] = $validated['tm_info'] ?? $data['toast_messages']['info'];

        // ---------- Toast Colors ----------
        $data['toast_colors']['success_bg'] = $validated['tc_success_bg'] ?? $data['toast_colors']['success_bg'];
        $data['toast_colors']['success_text'] = $validated['tc_success_text'] ?? $data['toast_colors']['success_text'];
        $data['toast_colors']['error_bg'] = $validated['tc_error_bg'] ?? $data['toast_colors']['error_bg'];
        $data['toast_colors']['error_text'] = $validated['tc_error_text'] ?? $data['toast_colors']['error_text'];
        $data['toast_colors']['warning_bg'] = $validated['tc_warning_bg'] ?? $data['toast_colors']['warning_bg'];
        $data['toast_colors']['warning_text'] = $validated['tc_warning_text'] ?? $data['toast_colors']['warning_text'];
        $data['toast_colors']['info_bg'] = $validated['tc_info_bg'] ?? $data['toast_colors']['info_bg'];
        $data['toast_colors']['info_text'] = $validated['tc_info_text'] ?? $data['toast_colors']['info_text'];

        // ---------- Toast Positions ----------
        $data['toast_positions']['success_position'] = $validated['tp_success_position'] ?? $data['toast_positions']['success_position'];
        $data['toast_positions']['error_position'] = $validated['tp_error_position'] ?? $data['toast_positions']['error_position'];
        $data['toast_positions']['warning_position'] = $validated['tp_warning_position'] ?? $data['toast_positions']['warning_position'];
        $data['toast_positions']['info_position'] = $validated['tp_info_position'] ?? $data['toast_positions']['info_position'];

        // ---------- Email ----------
        $data['email_settings']['from_name'] = $validated['from_name'] ?? $data['email_settings']['from_name'];
        $data['email_settings']['from_email'] = $validated['from_email'] ?? $data['email_settings']['from_email'];
        $data['email_settings']['reply_to_name'] = $validated['reply_to_name'] ?? $data['email_settings']['reply_to_name'];
        $data['email_settings']['reply_to_email'] = $validated['reply_to_email'] ?? $data['email_settings']['reply_to_email'];

        // Save JSON
        $settings->putAll($data);

        // Use the new toast_updated function
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
