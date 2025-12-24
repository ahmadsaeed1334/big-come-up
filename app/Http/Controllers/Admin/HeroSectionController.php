<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HeroSection;

class HeroSectionController extends Controller
{
    public function edit()
    {
        $hero = HeroSection::first();

        if (!$hero) {
            $hero = HeroSection::create([
                'subtitle' => 'THE BIG COME UP',
                'title' => 'The World’s Biggest DJ, Artist & Music Competition Platform',
                'description' => 'Default hero description',
                'primary_btn_text' => 'Sign Up Now',
                'primary_btn_link' => '#',
                'secondary_btn_text' => 'Watch Videos',
                'secondary_btn_link' => '#',
            ]);
        }

        return view('admin.hero.edit', compact('hero'));
    }

    public function update(Request $request)
    {
        $hero = HeroSection::firstOrFail();

        $data = $request->validate([
            'subtitle' => 'nullable|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'primary_btn_text' => 'nullable|string|max:100',
            'primary_btn_link' => 'nullable|string|max:255',
            'secondary_btn_text' => 'nullable|string|max:100',
            'secondary_btn_link' => 'nullable|string|max:255',
        ]);

        $hero->update($data);

        toast_updated('Hero Section');
        return back();
    }
}
