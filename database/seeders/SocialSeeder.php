<?php

namespace Database\Seeders;

use App\Models\Social;
use Illuminate\Database\Seeder;

class SocialSeeder extends Seeder
{
    public function run(): void
    {
        // Create sample social media links
        $socials = [
            [
                'name'      => 'Facebook',
                'url'       => 'https://www.facebook.com',
                'icon'      => 'bx bxl-facebook',
                'is_active' => true,
            ],
            [
                'name'      => 'Twitter',
                'url'       => 'https://www.twitter.com',
                'icon'      => 'bx bxl-twitter',
                'is_active' => true,
            ],
            [
                'name'      => 'Instagram',
                'url'       => 'https://www.instagram.com',
                'icon'      => 'bx bxl-instagram',
                'is_active' => true,
            ],
            [
                'name'      => 'LinkedIn',
                'url'       => 'https://www.linkedin.com',
                'icon'      => 'bx bxl-linkedin',
                'is_active' => true,
            ],
            [
                'name'      => 'YouTube',
                'url'       => 'https://www.youtube.com',
                'icon'      => 'bx bxl-youtube',
                'is_active' => true,
            ],
        ];

        foreach ($socials as $social) {
            Social::create($social);
        }
    }
}

