<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ArtistsProduct;
use App\Models\ArtistsCategory;
use App\Models\Artist;
use App\Models\Color;
use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ArtistsProductController extends Controller
{
    public function index(Request $request)
    {
        $title = "Artists Products";

        $query = ArtistsProduct::with([
            'category',
            'artist',
            'colors',
            'sizes',
            'media'
        ]);

        // Search
        if ($request->filled('q')) {
            $search = $request->q;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('slug', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Filters
        if ($request->filled('artists_category_id')) {
            $query->where('artists_category_id', $request->artists_category_id);
        }

        if ($request->filled('artist_id')) {
            $query->where('artist_id', $request->artist_id);
        }

        // ✅ PAGINATION (IMPORTANT PART)
        $products = $query
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->withQueryString();

        // Stats
        $totalProducts = ArtistsProduct::count();
        $activeProducts = ArtistsProduct::where('is_active', true)->count();
        $featuredProducts = ArtistsProduct::where('is_featured', true)->count();

        $recentProducts = ArtistsProduct::with(['category', 'artist'])
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        $artists = Artist::orderBy('name')->get();
        $categories = ArtistsCategory::orderBy('name')->get();

        return view('admin.artists-products.index', compact(
            'products',
            'title',
            'categories',
            'artists',
            'totalProducts',
            'activeProducts',
            'featuredProducts',
            'recentProducts'
        ));
    }

    public function create()
    {
        $title = "Add Artist Product";
        $categories = ArtistsCategory::orderBy('name')->get();
        $artists = Artist::orderBy('name')->get();
        $colors = Color::where('is_active', true)->orderBy('name')->get();
        $sizes = Size::where('is_active', true)->orderBy('code')->get();

        return view('admin.artists-products.create', compact('categories', 'artists', 'colors', 'sizes', 'title'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            Log::info('Creating new product', [
                'title' => $request->title,
                'has_main_image' => $request->hasFile('main_image'),
                'additional_images_count' => $request->hasFile('images') ? count($request->file('images')) : 0
            ]);

            // Validate inputs
            $data = $request->validate([
                'artists_category_id' => ['required', 'exists:artists_categories,id'],
                'artist_id' => ['required', 'exists:artists,id'],
                'title' => ['required', 'string', 'max:255', 'unique:artists_products,title'],
                'price' => ['required', 'numeric', 'min:0'],
                'sale_price' => ['nullable', 'numeric', 'min:0'],
                'main_image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:5120'],
                'rating' => ['nullable', 'numeric', 'min:0', 'max:5'],
                'description' => ['required', 'string'],
                'product_details' => ['nullable', 'string'],
                'is_featured' => ['sometimes', 'boolean'],
                'is_active' => ['sometimes', 'boolean'],
                'color_ids' => ['nullable', 'array'],
                'color_ids.*' => ['nullable', 'exists:colors,id'],
                'size_ids' => ['nullable', 'array'],
                'size_ids.*' => ['nullable', 'exists:sizes,id'],
                'images.*' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:5120'],
            ]);

            // Set defaults
            $data['is_featured'] = $request->boolean('is_featured', false);
            $data['is_active'] = $request->boolean('is_active', true);
            $data['reviews_count'] = 0;
            $data['slug'] = Str::slug($request->title);

            Log::info('Creating product with data:', $data);

            // Create product
            $product = ArtistsProduct::create($data);

            Log::info('Product created successfully', [
                'product_id' => $product->id,
                'title' => $product->title,
                'slug' => $product->slug
            ]);

            // Handle main image upload
            if ($request->hasFile('main_image') && $request->file('main_image')->isValid()) {
                try {
                    $media = $product->addMedia($request->file('main_image'))
                        ->toMediaCollection('main_image');

                    Log::info('Main image uploaded', [
                        'product_id' => $product->id,
                        'media_id' => $media->id,
                        'file_name' => $media->file_name
                    ]);
                } catch (\Exception $e) {
                    Log::error('Failed to upload main image', [
                        'product_id' => $product->id,
                        'error' => $e->getMessage()
                    ]);
                    throw $e;
                }
            }

            // Handle additional images
            if ($request->hasFile('images')) {
                $additionalCount = 0;
                foreach ($request->file('images') as $image) {
                    if ($image && $image->isValid()) {
                        try {
                            $media = $product->addMedia($image)
                                ->toMediaCollection('product_images');
                            $additionalCount++;

                            Log::info('Additional image uploaded', [
                                'product_id' => $product->id,
                                'media_id' => $media->id,
                                'file_name' => $media->file_name
                            ]);
                        } catch (\Exception $e) {
                            Log::error('Failed to upload additional image', [
                                'product_id' => $product->id,
                                'error' => $e->getMessage()
                            ]);
                            // Continue with other images
                        }
                    }
                }
                Log::info("{$additionalCount} additional images uploaded", ['product_id' => $product->id]);
            }

            // Handle colors (multi-select)
            if ($request->filled('color_ids')) {
                // Filter out null values
                $colorIds = array_filter($request->color_ids, function ($value) {
                    return !is_null($value);
                });

                if (!empty($colorIds)) {
                    $product->colors()->sync($colorIds);
                    Log::info('Colors synced', [
                        'product_id' => $product->id,
                        'color_ids' => $colorIds
                    ]);
                }
            }

            // Handle sizes (multi-select)
            if ($request->filled('size_ids')) {
                // Filter out null values
                $sizeIds = array_filter($request->size_ids, function ($value) {
                    return !is_null($value);
                });

                if (!empty($sizeIds)) {
                    $product->sizes()->sync($sizeIds);
                    Log::info('Sizes synced', [
                        'product_id' => $product->id,
                        'size_ids' => $sizeIds
                    ]);
                }
            }

            DB::commit();

            toast_created('Artist Product');
            return redirect()->route('admin.artists-products.index')
                ->with('success', 'Product created successfully!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            DB::rollBack();
            Log::error('Validation failed', [
                'errors' => $e->errors(),
                'request_data' => $request->except(['main_image', 'images'])
            ]);

            return back()
                ->withInput()
                ->withErrors($e->errors());
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Failed to create product', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'request_data' => $request->except(['main_image', 'images'])
            ]);

            return back()
                ->withInput()
                ->withErrors(['error' => 'Failed to create product: ' . $e->getMessage()]);
        }
    }

    public function show(ArtistsProduct $artistsProduct)
    {
        $title = "Product Details";
        $product = $artistsProduct->load(['category', 'artist', 'colors', 'sizes', 'reviews', 'media']);

        return view('admin.artists-products.show', compact('product', 'title'));
    }

    public function edit(ArtistsProduct $artistsProduct)
    {
        $title = "Edit Artist Product";
        $categories = ArtistsCategory::orderBy('name')->get();
        $artists = Artist::orderBy('name')->get();
        $colors = Color::where('is_active', true)->orderBy('name')->get();
        $sizes = Size::where('is_active', true)->orderBy('code')->get();
        $artistsProduct->load(['media', 'colors', 'sizes']);

        return view('admin.artists-products.edit', compact('artistsProduct', 'categories', 'artists', 'colors', 'sizes', 'title'));
    }

    public function update(Request $request, ArtistsProduct $artistsProduct)
    {
        // Log the request
        Log::info('Update Product Request:', [
            'product_id' => $artistsProduct->id,
            'update_type' => $request->input('update_type'),
            'method' => $request->method(),
            'all_data' => $request->except(['main_image', 'images']),
        ]);
        Log::info('=== UPDATE PRODUCT START ===');
        Log::info('Product ID: ' . $artistsProduct->id);
        Log::info('Request Method: ' . $request->method());
        Log::info('Update Type: ' . $request->input('update_type'));

        // Check if this is actually a delete request
        if ($request->method() === 'DELETE') {
            Log::error('DELETE method detected in update!');
            abort(405, 'Method not allowed');
        }
        // Check update type
        $updateType = $request->input('update_type');

        if ($updateType === 'additional_images') {
            // Handle additional images
            $request->validate([
                'images.*' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:5120']
            ]);

            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    if ($image->isValid()) {
                        $artistsProduct->addMedia($image)
                            ->toMediaCollection('product_images');
                    }
                }
            }

            toast_updated('Product Images');
            return back();
        } elseif ($updateType === 'main_image') {
            // Handle main image update
            $request->validate([
                'main_image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:5120']
            ]);

            if ($request->hasFile('main_image') && $request->file('main_image')->isValid()) {
                // Clear existing main image
                $artistsProduct->clearMediaCollection('main_image');
                $artistsProduct->addMedia($request->file('main_image'))
                    ->toMediaCollection('main_image');
            }

            toast_updated('Main Image');
            return back();
        } elseif ($updateType === 'attach_color') {
            // Attach color to product
            $request->validate([
                'color_id' => ['required', 'exists:colors,id']
            ]);

            $artistsProduct->colors()->syncWithoutDetaching([$request->color_id]);

            toast_updated('Product Colors');
            return back();
        } elseif ($updateType === 'detach_color') {
            // Detach color from product
            $request->validate([
                'color_id' => ['required', 'exists:colors,id']
            ]);

            $artistsProduct->colors()->detach($request->color_id);

            toast_updated('Product Colors');
            return back();
        } elseif ($updateType === 'attach_size') {
            // Attach size to product
            $request->validate([
                'size_id' => ['required', 'exists:sizes,id']
            ]);

            $artistsProduct->sizes()->syncWithoutDetaching([$request->size_id]);

            toast_updated('Product Sizes');
            return back();
        } elseif ($updateType === 'detach_size') {
            // Detach size from product
            $request->validate([
                'size_id' => ['required', 'exists:sizes,id']
            ]);

            $artistsProduct->sizes()->detach($request->size_id);

            toast_updated('Product Sizes');
            return back();
        } else {
            // Original update logic for full product update
            $data = $request->validate([
                'artists_category_id' => ['required', 'exists:artists_categories,id'],
                'artist_id' => ['required', 'exists:artists,id'],
                'title' => [
                    'required',
                    'string',
                    'max:255',
                    Rule::unique('artists_products', 'title')->ignore($artistsProduct->id)
                ],
                'price' => ['required', 'numeric', 'min:0'],
                'sale_price' => ['nullable', 'numeric', 'min:0'],
                'main_image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:5120'],
                'rating' => ['nullable', 'numeric', 'min:0', 'max:5'],
                'description' => ['required', 'string'],
                'product_details' => ['nullable', 'string'],
                'is_featured' => ['sometimes', 'boolean'],
                'is_active' => ['sometimes', 'boolean'],
                'color_ids' => ['nullable', 'array'],
                'color_ids.*' => ['exists:colors,id'],
                'size_ids' => ['nullable', 'array'],
                'size_ids.*' => ['exists:sizes,id'],
                'images.*' => ['sometimes', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:5120'],
            ]);
            Log::info('Validation passed', $data);
            // Update product data
            $artistsProduct->update($data);

            Log::info('Product updated successfully');

            // Handle main image update
            if ($request->hasFile('main_image') && $request->file('main_image')->isValid()) {
                Log::info('Updating main image');
                // Clear existing main image
                $artistsProduct->clearMediaCollection('main_image');
                $artistsProduct->addMedia($request->file('main_image'))
                    ->toMediaCollection('main_image');
            }

            // Handle existing gallery images - delete unchecked ones
            if ($artistsProduct->getMedia('product_images')->count() > 0) {
                $keepImages = $request->input('keep_images', []);

                // Debug log
                Log::info('Keep images from request:', ['keep_images' => $keepImages]);

                // Get all current image IDs
                $currentImageIds = $artistsProduct->getMedia('product_images')->pluck('id')->toArray();

                // Debug log
                Log::info('Current image IDs:', ['current_ids' => $currentImageIds]);

                // Find images to delete (those not in keep_images array)
                $imagesToDelete = array_diff($currentImageIds, $keepImages);

                // Debug log
                Log::info('Images to delete:', ['to_delete' => $imagesToDelete]);

                // Delete unchecked images
                foreach ($imagesToDelete as $imageId) {
                    $media = $artistsProduct->media()->find($imageId);
                    if ($media) {
                        $media->delete();
                        Log::info('Deleted unchecked image', ['image_id' => $imageId]);
                    }
                }

                Log::info('Kept images: ' . count($keepImages) . ', Deleted: ' . count($imagesToDelete));
            }

            // Handle new additional images
            if ($request->hasFile('images')) {
                Log::info('Adding additional images: ' . count($request->file('images')));
                foreach ($request->file('images') as $image) {
                    if ($image->isValid()) {
                        $artistsProduct->addMedia($image)
                            ->toMediaCollection('product_images');
                    }
                }
            }

            // Handle colors (multi-select)
            if ($request->filled('color_ids')) {
                Log::info('Syncing colors: ', $request->color_ids);
                $artistsProduct->colors()->sync($request->color_ids);
            } else {
                $artistsProduct->colors()->detach();
            }

            // Handle sizes (multi-select)
            if ($request->filled('size_ids')) {
                Log::info('Syncing sizes: ', $request->size_ids);
                $artistsProduct->sizes()->sync($request->size_ids);
            } else {
                Log::info('Detaching all sizes');
                $artistsProduct->sizes()->detach();
            }

            Log::info('=== UPDATE PRODUCT END ===');
            toast_updated('Artist Product');
            return redirect()->route('admin.artists-products.index');
        }
    }

    public function destroy(ArtistsProduct $artistsProduct)
    {
        try {
            // Delete media files (handled by medialibrary)
            $artistsProduct->clearMediaCollection('main_image');
            $artistsProduct->clearMediaCollection('product_images');

            // Delete the product
            $artistsProduct->delete();

            toast_deleted('Artist Product');
        } catch (\Throwable $e) {
            toast_error('Unable to delete product. It may be in use.');
        }

        return back();
    }

    public function removeImage(Request $request, ArtistsProduct $artistsProduct)
    {
        // Log for debugging
        Log::info('Remove Image Request:', [
            'product_id' => $artistsProduct->id,
            'media_id' => $request->media_id,
            'all_data' => $request->all()
        ]);

        // Validate the request
        $validator = Validator::make($request->all(), [
            'media_id' => ['required', 'integer']
        ]);

        if ($validator->fails()) {
            Log::error('Validation failed for removeImage:', $validator->errors()->toArray());
            return response()->json([
                'success' => false,
                'message' => 'Invalid media ID',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // Find the media item that belongs to this product
            $media = $artistsProduct->media()
                ->where('id', $request->media_id)
                ->where('collection_name', 'product_images')
                ->first();

            if (!$media) {
                Log::error('Media not found or does not belong to this product', [
                    'media_id' => $request->media_id,
                    'product_id' => $artistsProduct->id
                ]);

                return response()->json([
                    'success' => false,
                    'message' => 'Image not found or does not belong to this product'
                ], 404);
            }

            // Delete the media
            $media->delete();

            Log::info('Image removed successfully', [
                'media_id' => $request->media_id,
                'product_id' => $artistsProduct->id
            ]);
            toast_updated('Artist Product');
            return redirect()->route('admin.artists-products.index');
        } catch (\Exception $e) {
            Log::error('Error removing image:', [
                'error' => $e->getMessage(),
                'media_id' => $request->media_id,
                'product_id' => $artistsProduct->id
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to remove image: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Reorder product images
     */
    public function reorderImages(Request $request, ArtistsProduct $artistsProduct)
    {
        $request->validate([
            'order' => ['required', 'array'],
            'order.*' => ['exists:media,id']
        ]);

        foreach ($request->order as $position => $mediaId) {
            $artistsProduct->media()
                ->where('id', $mediaId)
                ->update(['order_column' => $position + 1]);
        }

        return response()->json(['success' => true]);
    }

    public function storeColor(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:100', 'unique:colors,name'],
            'code' => ['nullable', 'string', 'max:7', 'regex:/^#?([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/']
        ]);

        // ❌ validation failed
        if ($validator->fails()) {
            toast_error($validator->errors()->first());
            return back();
        }

        // ✅ validated data
        $data = $validator->validated();

        // ensure # prefix in color code
        if (!empty($data['code']) && !str_starts_with($data['code'], '#')) {
            $data['code'] = '#' . $data['code'];
        }

        // check if color already exists (extra safety)
        $color = Color::where('name', $data['name'])->first();

        if (!$color) {
            $color = Color::create([
                'name' => $data['name'],
                'code' => $data['code'] ?? null,
                'is_active' => $request->has('is_active') ? 1 : 0
            ]);
        }

        // attach to product if coming from product page
        if ($request->filled('product_id')) {
            $product = \App\Models\ArtistsProduct::find($request->product_id);
            if ($product && !$product->colors()->where('colors.id', $color->id)->exists()) {
                $product->colors()->attach($color->id);
            }
        }

        // AJAX response
        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Color added successfully!',
                'color' => [
                    'id' => $color->id,
                    'name' => $color->name,
                    'code' => $color->code
                ]
            ]);
        }

        toast_created('Color');
        return back();
    }
    public function storeSize(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:100', 'unique:sizes,name'],
            'code' => ['required', 'string', 'max:10', 'unique:sizes,code']
        ]);

        if ($validator->fails()) {
            toast_error($validator->errors()->first());
            return back();
        }

        // ✅ use validated data
        $data = $validator->validated();

        // ✅ check existing size properly
        $size = Size::where('name', $data['name'])->first();

        if (!$size) {
            $size = Size::create($data);
        }

        // attach to product (optional)
        if ($request->filled('product_id')) {
            $product = \App\Models\ArtistsProduct::find($request->product_id);
            if ($product && !$product->sizes()->where('sizes.id', $size->id)->exists()) {
                $product->sizes()->attach($size->id);
            }
        }

        // AJAX response
        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Size added successfully!',
                'size' => $size
            ]);
        }

        toast_created('Size');
        return back();
    }

    public function storeSizdfe(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:100', 'unique:sizes,name'],
            'code' => ['required', 'string', 'max:10', 'unique:sizes,code']
        ]);

        if ($validator->fails()) {
            toast_error($validator->errors()->first());
            return back();
        }

        Size::create([
            'name' => $request->name,
            'code' => strtoupper($request->code),
            'is_active' => $request->has('is_active') ? 1 : 0
        ]);

        toast_created('Size');
        return back();
    }
}
