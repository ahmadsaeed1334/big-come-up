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
        'text_color' => '#000000',
        'border_color' => '#e6b800',
        'icon_color' => '#ffffff',
        'position' => 'top-end',
        'icon' => 'success',
        'show_confirm_button' => false,
        'timer_progress_bar' => true,
        'animation' => 'slide-from-top',
        'width' => '350px',
        'padding' => '1rem',
      ],

      'toast_messages' => [
        'created' => ':record created successfully.',
        'updated' => ':record updated successfully.',
        'deleted' => ':record deleted successfully.',
        'error' => 'Something went wrong.',
        'success' => 'Operation completed successfully.',
        'warning' => 'Please check your input.',
        'info' => 'Here is some information.',
      ],

      'toast_colors' => [
        'success_bg' => '#28a745',
        'success_text' => '#ffffff',
        'error_bg' => '#dc3545',
        'error_text' => '#ffffff',
        'warning_bg' => '#ffc107',
        'warning_text' => '#000000',
        'info_bg' => '#17a2b8',
        'info_text' => '#ffffff',
      ],

      'toast_positions' => [
        'success_position' => 'top-end',
        'error_position' => 'top-end',
        'warning_position' => 'top-end',
        'info_position' => 'top-end',
      ],

      'email_settings' => [
        'from_name' => '',
        'from_email' => '',
        'reply_to_name' => '',
        'reply_to_email' => '',
      ],
    ];
  }

  /**
   * Get toast message by key
   */
  public function getToastMessage(string $key, array $replace = []): string
  {
    $data = $this->getAll();
    $message = $data['toast_messages'][$key] ?? '';

    // Replace placeholders
    foreach ($replace as $placeholder => $value) {
      $message = str_replace(":{$placeholder}", $value, $message);
    }

    return $message;
  }

  /**
   * Get toast colors for specific type
   */
  public function getToastColors(string $type = 'success'): array
  {
    $data = $this->getAll();

    return match ($type) {
      'error' => [
        'background' => $data['toast_colors']['error_bg'] ?? '#dc3545',
        'text' => $data['toast_colors']['error_text'] ?? '#ffffff',
        'border' => $this->adjustColor($data['toast_colors']['error_bg'] ?? '#dc3545', -20),
      ],
      'warning' => [
        'background' => $data['toast_colors']['warning_bg'] ?? '#ffc107',
        'text' => $data['toast_colors']['warning_text'] ?? '#000000',
        'border' => $this->adjustColor($data['toast_colors']['warning_bg'] ?? '#ffc107', -20),
      ],
      'info' => [
        'background' => $data['toast_colors']['info_bg'] ?? '#17a2b8',
        'text' => $data['toast_colors']['info_text'] ?? '#ffffff',
        'border' => $this->adjustColor($data['toast_colors']['info_bg'] ?? '#17a2b8', -20),
      ],
      default => [
        'background' => $data['toast_colors']['success_bg'] ?? '#28a745',
        'text' => $data['toast_colors']['success_text'] ?? '#ffffff',
        'border' => $this->adjustColor($data['toast_colors']['success_bg'] ?? '#28a745', -20),
      ],
    };
  }

  /**
   * Get toast position for specific type
   */
  public function getToastPosition(string $type = 'success'): string
  {
    $data = $this->getAll();

    return match ($type) {
      'error' => $data['toast_positions']['error_position'] ?? 'top-end',
      'warning' => $data['toast_positions']['warning_position'] ?? 'top-end',
      'info' => $data['toast_positions']['info_position'] ?? 'top-end',
      default => $data['toast_positions']['success_position'] ?? 'top-end',
    };
  }

  /**
   * Get SweetAlert configuration
   */
  public function getSweetAlertConfig(): array
  {
    $data = $this->getAll();
    return $data['sweetalert'];
  }

  /**
   * Get complete toast configuration
   */
  public function getToastConfig(string $type = 'success'): array
  {
    $data = $this->getAll();
    $sweetalert = $data['sweetalert'];
    $colors = $this->getToastColors($type);
    $position = $this->getToastPosition($type);

    return [
      'background' => $colors['background'],
      'text_color' => $colors['text'],
      'border_color' => $colors['border'],
      'position' => $position,
      'time' => $sweetalert['display_time'],
      'icon' => $sweetalert['icon'] ?? $type,
      'show_confirm_button' => $sweetalert['show_confirm_button'] ?? false,
      'timer_progress_bar' => $sweetalert['timer_progress_bar'] ?? true,
      'animation' => $sweetalert['animation'] ?? 'slide-from-top',
      'width' => $sweetalert['width'] ?? '350px',
      'padding' => $sweetalert['padding'] ?? '1rem',
      'icon_color' => $sweetalert['icon_color'] ?? '#ffffff',
    ];
  }

  /**
   * Adjust color brightness
   */
  private function adjustColor(string $hexColor, int $percent): string
  {
    $hexColor = ltrim($hexColor, '#');

    if (strlen($hexColor) !== 6) {
      return '#' . $hexColor;
    }

    // Convert hex to RGB
    $r = hexdec(substr($hexColor, 0, 2));
    $g = hexdec(substr($hexColor, 2, 2));
    $b = hexdec(substr($hexColor, 4, 2));

    // Adjust brightness
    $r = max(0, min(255, $r + $r * $percent / 100));
    $g = max(0, min(255, $g + $g * $percent / 100));
    $b = max(0, min(255, $b + $b * $percent / 100));

    // Convert back to hex
    return '#' . str_pad(dechex($r), 2, '0', STR_PAD_LEFT)
      . str_pad(dechex($g), 2, '0', STR_PAD_LEFT)
      . str_pad(dechex($b), 2, '0', STR_PAD_LEFT);
  }
}
