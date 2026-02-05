<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Media; // Agar aapka custom Media model hai to
use Spatie\MediaLibrary\MediaCollections\Models\Media as SpatieMedia;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\MediaUpload;

class MediaController extends Controller
{

    /**
     * Display a listing of all media files.
     */
    public function index(Request $request)
    {
        $title = "Media Library";
        $media = SpatieMedia::query();

        // Search functionality
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $media->where(function ($q) use ($search) {
                $q->where('file_name', 'LIKE', "%{$search}%")
                    ->orWhere('name', 'LIKE', "%{$search}%")
                    ->orWhere('mime_type', 'LIKE', "%{$search}%");
            });
        }

        // Filter by type
        if ($request->has('type') && $request->type != 'all') {
            $type = $request->type;
            if ($type == 'image') {
                $media->where('mime_type', 'LIKE', 'image/%');
            } elseif ($type == 'video') {
                $media->where('mime_type', 'LIKE', 'video/%');
            } elseif ($type == 'pdf') {
                $media->where('mime_type', 'LIKE', 'application/pdf');
            } elseif ($type == 'document') {
                $media->whereIn('mime_type', [
                    'application/msword',
                    'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                    'application/vnd.ms-excel',
                    'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                    'application/vnd.ms-powerpoint',
                    'application/vnd.openxmlformats-officedocument.presentationml.presentation'
                ]);
            }
        }

        // Sort functionality
        if ($request->has('sort')) {
            switch ($request->sort) {
                case 'oldest':
                    $media->orderBy('created_at', 'asc');
                    break;
                case 'largest':
                    $media->orderBy('size', 'desc');
                    break;
                case 'smallest':
                    $media->orderBy('size', 'asc');
                    break;
                case 'name_asc':
                    $media->orderBy('file_name', 'asc');
                    break;
                case 'name_desc':
                    $media->orderBy('file_name', 'desc');
                    break;
                default: // 'newest'
                    $media->orderBy('created_at', 'desc');
                    break;
            }
        } else {
            $media->orderBy('created_at', 'desc');
        }

        // Get paginated results
        $media = $media->paginate(48)->withQueryString();

        // Get recent media for the sidebar (latest 5 files)
        $recentMedia = SpatieMedia::latest()->take(5)->get();

        // Get statistics
        $totalImages = SpatieMedia::where('mime_type', 'LIKE', 'image/%')->count();
        $totalVideos = SpatieMedia::where('mime_type', 'LIKE', 'video/%')->count();
        $totalDocuments = SpatieMedia::whereIn('mime_type', [
            'application/pdf',
            'application/msword',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'application/vnd.ms-excel',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'application/vnd.ms-powerpoint',
            'application/vnd.openxmlformats-officedocument.presentationml.presentation'
        ])->count();
        $totalOthers = SpatieMedia::whereNotIn('mime_type', [
            'image/%',
            'video/%',
            'application/pdf',
            'application/msword',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'application/vnd.ms-excel',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'application/vnd.ms-powerpoint',
            'application/vnd.openxmlformats-officedocument.presentationml.presentation'
        ])->count();

        // Get collection names for filter (if needed)
        $collections = SpatieMedia::distinct()->pluck('collection_name')->filter()->values();

        return view('admin.media.index', compact(
            'media',
            'recentMedia',
            'totalImages',
            'totalVideos',
            'totalDocuments',
            'totalOthers',
            'collections',
            'title'
        ));
    }

    /**
     * Show media upload form.
     */
    public function create()
    {
        $title = "Upload Media";
        return view('admin.media.create', compact('title'));
    }

    /**
     * Upload new media files.
     */
    public function store(Request $request)
    {
        $request->validate([
            'files' => 'required|array',
            'files.*' => 'required|file|mimes:jpg,jpeg,png,gif,bmp,webp,svg,pdf,doc,docx,xls,xlsx,ppt,pptx,mp4,mov,avi,wmv,mp3,wav',
            'collection_name' => 'nullable|string|max:255',
            'custom_name' => 'nullable|string|max:255',
        ]);

        $collection = $request->collection_name ?: 'default';

        // ✅ One “container” model for this upload batch
        $container = MediaUpload::create();

        foreach ($request->file('files') as $file) {
            $container->addMedia($file)
                ->usingName($request->custom_name ?: pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME))
                ->usingFileName($file->hashName())
                ->toMediaCollection($collection);
        }

        toast_created('Files uploaded successfully');

        return redirect()->route('admin.media.index');
    }

    /**
     * Show single media details.
     */
    public function show($id)
    {
        $title = "Media Details";
        $media = SpatieMedia::findOrFail($id);

        // Get related media (same collection)
        $related = SpatieMedia::where('collection_name', $media->collection_name)
            ->where('id', '!=', $media->id)
            ->take(12)
            ->get();

        return view('admin.media.show', compact('media', 'related', 'title'));
    }

    /**
     * Show media edit form.
     */
    public function edit($id)
    {
        $title = "Edit Media";
        $media = SpatieMedia::findOrFail($id);
        return view('admin.media.edit', compact('media', 'title'));
    }

    /**
     * Update media details.
     */
    public function update(Request $request, $id)
    {
        $media = SpatieMedia::findOrFail($id);

        $request->validate([
            'name' => 'nullable|string|max:255',
            'collection_name' => 'nullable|string|max:255',
            'order_column' => 'nullable|integer',
            'custom_properties.key' => 'nullable|array',
            'custom_properties.value' => 'nullable|array',
        ]);

        if ($request->has('name')) {
            $media->name = $request->name;
        }

        if ($request->has('collection_name')) {
            $media->collection_name = $request->collection_name;
        }

        if ($request->has('order_column')) {
            $media->order_column = $request->order_column;
        }

        // Handle custom properties
        if ($request->has('custom_properties.key') && $request->has('custom_properties.value')) {
            $keys = $request->input('custom_properties.key', []);
            $values = $request->input('custom_properties.value', []);

            $customProperties = [];
            foreach ($keys as $index => $key) {
                if (!empty($key) && isset($values[$index])) {
                    $customProperties[$key] = $values[$index];
                }
            }

            $media->custom_properties = $customProperties;
        }

        $media->save();

        toast_updated('Media updated successfully');
        return redirect()->route('admin.media.show', $media);
    }
    /**
     * Delete media file.
     */
    // public function destroy($id)
    // {
    //     $media = SpatieMedia::findOrFail($id);
    //     $media->delete();

    //     toast_deleted('Media deleted successfully');
    //     return redirect()->route('admin.media.index');
    // }
    /**
     * Delete media file.
     */
    public function destroy($id)
    {
        try {
            $media = SpatieMedia::findOrFail($id);
            $fileName = $media->name ?: $media->file_name;
            $media->delete();

            // For AJAX requests, return JSON response
            if (request()->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'File deleted successfully',
                    'file_name' => $fileName
                ]);
            }

            // For regular requests
            toast_deleted("File deleted successfully");
            return redirect()->route('admin.media.index');
        } catch (\Exception $e) {
            if (request()->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error deleting file: ' . $e->getMessage()
                ], 500);
            }
            toast_error('Error deleting file: ' . $e->getMessage());
            return redirect()->route('admin.media.index');
        }
    }

    /**
     * Bulk delete media files.
     */
    public function bulkDestroy(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:media,id'
        ]);

        $count = SpatieMedia::whereIn('id', $request->ids)->delete();

        return response()->json([
            'success' => true,
            'message' => "{$count} files deleted successfully"
        ]);
    }

    /**
     * Download media file.
     */
    public function download($id)
    {
        $media = SpatieMedia::findOrFail($id);
        return response()->download($media->getPath(), $media->file_name);
    }

    /**
     * Get media statistics.
     */
    /**
     * Get media statistics.
     */
    public function statistics()
    {
        $title = "Media Statistics";
        $totalFiles = SpatieMedia::count();
        $totalSize = SpatieMedia::sum('size');

        // Improved Group by mime type with better categorization
        $byMimeType = SpatieMedia::selectRaw('
        CASE 
            WHEN mime_type LIKE "image/%" THEN "image"
            WHEN mime_type LIKE "video/%" THEN "video"
            WHEN mime_type LIKE "audio/%" THEN "audio"
            WHEN mime_type = "application/pdf" THEN "pdf"
            WHEN mime_type IN (
                "application/msword", 
                "application/vnd.openxmlformats-officedocument.wordprocessingml.document"
            ) THEN "word"
            WHEN mime_type IN (
                "application/vnd.ms-excel",
                "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"
            ) THEN "excel"
            WHEN mime_type IN (
                "application/vnd.ms-powerpoint",
                "application/vnd.openxmlformats-officedocument.presentationml.presentation"
            ) THEN "powerpoint"
            ELSE "other"
        END as type, 
        COUNT(*) as count
    ')
            ->groupBy('type')
            ->orderByDesc('count')
            ->get();

        // Get detailed counts for statistics cards
        $imageCount = SpatieMedia::where('mime_type', 'LIKE', 'image/%')->count();
        $videoCount = SpatieMedia::where('mime_type', 'LIKE', 'video/%')->count();
        $pdfCount = SpatieMedia::where('mime_type', 'application/pdf')->count();
        $wordCount = SpatieMedia::whereIn('mime_type', [
            'application/msword',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
        ])->count();
        $excelCount = SpatieMedia::whereIn('mime_type', [
            'application/vnd.ms-excel',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
        ])->count();
        $powerpointCount = SpatieMedia::whereIn('mime_type', [
            'application/vnd.ms-powerpoint',
            'application/vnd.openxmlformats-officedocument.presentationml.presentation'
        ])->count();

        // Total documents (all office docs + PDFs)
        $totalDocuments = $pdfCount + $wordCount + $excelCount + $powerpointCount;

        // Others (everything else)
        $otherCount = $totalFiles - ($imageCount + $videoCount + $totalDocuments);

        // Group by collection
        $byCollection = SpatieMedia::selectRaw('collection_name, COUNT(*) as count')
            ->groupBy('collection_name')
            ->orderByDesc('count')
            ->get();

        // Recent uploads
        $recentUploads = SpatieMedia::orderBy('created_at', 'desc')
            ->take(10)
            ->get();

        // Largest files
        $largestFiles = SpatieMedia::orderBy('size', 'desc')
            ->take(10)
            ->get();

        return view('admin.media.statistics', compact(
            'totalFiles',
            'totalSize',
            'byMimeType',
            'byCollection',
            'recentUploads',
            'largestFiles',
            'title',
            'imageCount',
            'videoCount',
            'totalDocuments',
            'otherCount',
            'pdfCount',
            'wordCount',
            'excelCount',
            'powerpointCount'
        ));
    }
}
