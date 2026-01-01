<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductReview;
use App\Models\ArtistsProduct;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProductReviewController extends Controller
{
    public function index()
    {
        $title = "Product Reviews";
        $reviews = ProductReview::with('product')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.product-reviews.index', compact('reviews', 'title'));
    }

    public function store(Request $request, $productId)
    {
        $data = $request->validate([
            'user_name' => ['required', 'string', 'max:255'],
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
            'title' => ['required', 'string', 'max:255'],
            'review' => ['required', 'string']
        ]);

        $data['artists_product_id'] = $productId;

        ProductReview::create($data);

        // Update product rating and reviews count
        $this->updateProductRating($productId);

        toast_created('Product Review');
        return back();
    }

    public function update(Request $request, ProductReview $productReview)
    {
        $data = $request->validate([
            'user_name' => ['required', 'string', 'max:255'],
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
            'title' => ['required', 'string', 'max:255'],
            'review' => ['required', 'string']
        ]);

        $productReview->update($data);

        // Update product rating and reviews count
        $this->updateProductRating($productReview->product_id);

        toast_updated('Product Review');
        return back();
    }

    public function destroy(ProductReview $productReview)
    {
        try {
            $productId = $productReview->product_id;
            $productReview->delete();

            // Update product rating and reviews count
            $this->updateProductRating($productId);

            toast_deleted('Product Review');
        } catch (\Throwable $e) {
            toast_error('Unable to delete review.');
        }

        return back();
    }

    private function updateProductRating($productId)
    {
        $reviews = ProductReview::where('artists_product_id', $productId)->get();

        if ($reviews->count() > 0) {
            $averageRating = $reviews->avg('rating');
            $reviewsCount = $reviews->count();
        } else {
            $averageRating = 0;
            $reviewsCount = 0;
        }

        ArtistsProduct::where('id', $productId)->update([
            'rating' => round($averageRating, 1),
            'reviews_count' => $reviewsCount
        ]);
    }
}
