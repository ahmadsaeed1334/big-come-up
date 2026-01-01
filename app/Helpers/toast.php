<?php

if (! function_exists('toast')) {
  /**
   * Flash SweetAlert2 toast.
   *
   * @param  string  $type  success|error|warning|info|question
   * @param  string  $message
   * @param  string|null  $title
   */
  function toast(string $type, string $message, ?string $title = null): void
  {
    session()->flash('toast', [
      'type' => $type,
      'message' => $message,
      'title' => $title ?? '',
    ]);
  }
}

if (! function_exists('toast_created')) {
  function toast_created(string $what = 'Record'): void
  {
    toast('success', "{$what} created successfully.");
  }
}

if (! function_exists('toast_updated')) {
  function toast_updated(string $what = 'Record'): void
  {
    toast('success', "{$what} updated successfully.");
  }
}

if (! function_exists('toast_deleted')) {
  function toast_deleted(string $what = 'Record'): void
  {
    toast('success', "{$what} deleted successfully.");
  }
}

if (! function_exists('toast_error')) {
  function toast_error(string $message = 'Something went wrong.'): void
  {
    toast('error', $message);
  }

  if (!function_exists('getContrastColor')) {
    function getContrastColor($hexColor)
    {
      // Remove # if present
      $hexColor = ltrim($hexColor, '#');

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
}
