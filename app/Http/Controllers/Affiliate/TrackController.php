<?php

namespace App\Http\Controllers\Affiliate;

use App\Http\Controllers\Controller;
use App\Models\Affiliate;

class TrackController extends Controller
{
    public function __invoke(string $code)
    {
        $affiliate = Affiliate::where('code', $code)->where('is_active', true)->firstOrFail();

        $affiliate->increment('clicks');

        // store for signup/payment pipeline
        session(['affiliate_code' => $code]);

        return redirect()->route('register'); // or landing page
    }
}
