<?php

namespace App\Helpers;

use Illuminate\Support\Str;

class MediaHelper
{
  /**
   * Get file extension from filename
   */
  public static function getExtension($filename)
  {
    return Str::afterLast($filename, '.');
  }

  /**
   * Get file icon based on mime type
   */
  public static function getFileIcon($mimeType)
  {
    if (str_starts_with($mimeType, 'image/')) {
      return 'fa-image text-primary';
    } elseif (str_starts_with($mimeType, 'video/')) {
      return 'fa-video text-success';
    } elseif ($mimeType == 'application/pdf') {
      return 'fa-file-pdf text-danger';
    } elseif (str_contains($mimeType, 'word')) {
      return 'fa-file-word text-primary';
    } elseif (str_contains($mimeType, 'excel') || str_contains($mimeType, 'spreadsheet')) {
      return 'fa-file-excel text-success';
    } elseif (str_contains($mimeType, 'powerpoint') || str_contains($mimeType, 'presentation')) {
      return 'fa-file-powerpoint text-warning';
    } else {
      return 'fa-file text-secondary';
    }
  }

  /**
   * Format bytes to human readable format
   */
  public static function formatBytes($bytes, $precision = 2)
  {
    $units = ['B', 'KB', 'MB', 'GB', 'TB'];
    $bytes = max($bytes, 0);
    $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
    $pow = min($pow, count($units) - 1);
    $bytes /= pow(1024, $pow);
    return round($bytes, $precision) . ' ' . $units[$pow];
  }

  /**
   * Get file type category
   */
  public static function getFileTypeCategory($mimeType)
  {
    if (str_starts_with($mimeType, 'image/')) {
      return 'image';
    } elseif (str_starts_with($mimeType, 'video/')) {
      return 'video';
    } elseif ($mimeType == 'application/pdf') {
      return 'pdf';
    } elseif (
      str_contains($mimeType, 'word') ||
      str_contains($mimeType, 'excel') ||
      str_contains($mimeType, 'powerpoint') ||
      str_contains($mimeType, 'msword') ||
      str_contains($mimeType, 'spreadsheet') ||
      str_contains($mimeType, 'presentation')
    ) {
      return 'document';
    } else {
      return 'other';
    }
  }
  /**
   * Get readable file type name
   */
  public static function getFileType($mimeType)
  {
    if (str_starts_with($mimeType, 'image/')) {
      return 'Image';
    } elseif (str_starts_with($mimeType, 'video/')) {
      return 'Video';
    } elseif ($mimeType === 'application/pdf') {
      return 'PDF';
    } elseif (
      str_contains($mimeType, 'word') ||
      str_contains($mimeType, 'excel') ||
      str_contains($mimeType, 'powerpoint') ||
      str_contains($mimeType, 'spreadsheet') ||
      str_contains($mimeType, 'presentation')
    ) {
      return 'Document';
    } else {
      return 'File';
    }
  }
}
