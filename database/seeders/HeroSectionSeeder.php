<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\HeroSection;

class HeroSectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        HeroSection::create([
            'subtitle' => 'THE BIG COME UP',
            'title' => 'The World’s Biggest DJ, Artist & Music Competition Platform',
            'description' => 'Complete globally discover new talent and be discovered...',
            'primary_btn_text' => 'Sign Up Now',
            'primary_btn_link' => '#',
            'secondary_btn_text' => 'Watch Videos',
            'secondary_btn_link' => '#',
        ]);
    }
}
