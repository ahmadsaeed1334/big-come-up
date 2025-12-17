<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class SettingsService
{
  private string $disk = 'local';
  private string $path = 'settings.json';

  public function getAll(): array
  {
    if (!Storage::disk($this->disk)->exists($this->path)) {
      $this->putAll($this->defaults());
    }

    $raw = Storage::disk($this->disk)->get($this->path);
    $data = json_decode($raw, true);

    if (!is_array($data)) {
      $data = $this->defaults();
      $this->putAll($data);
    }

    // merge defaults so missing keys don't break UI
    return array_replace_recursive($this->defaults(), $data);
  }

  public function putAll(array $data): void
  {
    // ensure json pretty
    Storage::disk($this->disk)->put(
      $this->path,
      json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES)
    );
  }

  public function defaults(): array
  {
    return [
      'general' => [
        'white_logo' => null,
        'black_logo' => null,
        'favicon' => null,

        'company_name' => '',
        'company_description' => '',

        'email' => '',
        'website' => '',
        'phone' => '',
        'fax' => '',
        'address' => '',

        'system_timezone' => 'UTC',
        'default_password' => '',

        'per_page_items' => 10,
        'date_format' => 'd/m/Y',

        'layout' => '-fluid',
        'primary_color' => 'Primary',
        'default_language' => 'English',
      ],

      'sweetalert' => [
        'default_title' => 'Operation Succeeded!',
        'default_message' => 'The desired outcome has been achieved.',
        'display_time' => 3000,
        'background_color' => '#ffc700',
        'position' => 'top-end',
      ],

      'email_settings' => [
        'from_name' => '',
        'from_email' => '',
        'reply_to_name' => '',
        'reply_to_email' => '',
      ],
    ];
  }
}
