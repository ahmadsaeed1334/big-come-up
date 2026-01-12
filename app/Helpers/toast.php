<?php

use App\Services\SettingsService;
use Illuminate\Support\Facades\Log;

if (! function_exists('toast')) {
  /**
   * Flash SweetAlert2 toast with dynamic settings.
   */
  function toast(string $type, string $message, ?string $title = null, array $config = []): void
  {
    $settings = app(SettingsService::class);
    $typeConfig = $settings->getToastConfig($type);

    // Debugging: Log the config
    Log::info('Toast Function Called', [
      'type' => $type,
      'message' => $message,
      'title' => $title,
      'config_from_settings' => $typeConfig,
    ]);

    // Use custom title if provided, otherwise use default from settings
    if ($title === null) {
      $sweetalert = $settings->getSweetAlertConfig();
      $title = $sweetalert['default_title'] ?? '';
    }

    // Merge custom config with type-specific config
    $finalConfig = array_merge($typeConfig, $config);

    Log::info('Toast Session Data', [
      'final_config' => $finalConfig,
    ]);

    session()->flash('toast', [
      'type' => $type,
      'message' => $message,
      'title' => $title,
      'config' => $finalConfig,
    ]);
  }
}

if (! function_exists('toast_created')) {
  function toast_created(string $what = 'Record'): void
  {
    $settings = app(SettingsService::class);
    $message = $settings->getToastMessage('created', ['record' => $what]);

    if (empty($message)) {
      $message = "{$what} created successfully.";
    }

    Log::info('Toast Created Called', ['what' => $what, 'message' => $message]);
    toast('success', $message);
  }
}

if (! function_exists('toast_updated')) {
  function toast_updated(string $what = 'Record'): void
  {
    $settings = app(SettingsService::class);
    $message = $settings->getToastMessage('updated', ['record' => $what]);

    if (empty($message)) {
      $message = "{$what} updated successfully.";
    }

    Log::info('Toast Updated Called', ['what' => $what, 'message' => $message]);
    toast('success', $message);
  }
}

if (! function_exists('toast_deleted')) {
  function toast_deleted(string $what = 'Record'): void
  {
    $settings = app(SettingsService::class);
    $message = $settings->getToastMessage('deleted', ['record' => $what]);

    if (empty($message)) {
      $message = "{$what} deleted successfully.";
    }

    toast('success', $message);
  }
}

if (! function_exists('toast_error')) {
  function toast_error(?string $message = null): void
  {
    $settings = app(SettingsService::class);

    if ($message === null) {
      $message = $settings->getToastMessage('error');
      if (empty($message)) {
        $message = 'Something went wrong.';
      }
    }

    toast('error', $message);
  }
}

if (! function_exists('toast_success')) {
  function toast_success(?string $message = null): void
  {
    $settings = app(SettingsService::class);

    if ($message === null) {
      $message = $settings->getToastMessage('success');
      if (empty($message)) {
        $message = 'Operation completed successfully.';
      }
    }

    toast('success', $message);
  }
}

if (! function_exists('toast_warning')) {
  function toast_warning(?string $message = null): void
  {
    $settings = app(SettingsService::class);

    if ($message === null) {
      $message = $settings->getToastMessage('warning');
      if (empty($message)) {
        $message = 'Please check your input.';
      }
    }

    toast('warning', $message);
  }
}

if (! function_exists('toast_info')) {
  function toast_info(?string $message = null): void
  {
    $settings = app(SettingsService::class);

    if ($message === null) {
      $message = $settings->getToastMessage('info');
      if (empty($message)) {
        $message = 'Here is some information.';
      }
    }

    toast('info', $message);
  }
}

if (! function_exists('getContrastColor')) {
  function getContrastColor($hexColor)
  {
    // Remove # if present
    $hexColor = ltrim($hexColor, '#');

    // Ensure valid hex color
    if (strlen($hexColor) !== 6) {
      return '#000000';
    }

    // Convert hex to RGB
    $r = hexdec(substr($hexColor, 0, 2));
    $g = hexdec(substr($hexColor, 2, 2));
    $b = hexdec(substr($hexColor, 4, 2));

    // Calculate luminance
    $luminance = (0.299 * $r + 0.587 * $g + 0.114 * $b) / 255;

    // Return black or white based on luminance
    return $luminance > 0.5 ? '#000000' : '#FFFFFF';
  }
}
