<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Section;
use App\Models\Category;
use App\Models\Page;

class ContentSeeder extends Seeder
{
    public function run()
    {
        // -----------------------------
        // Engineering BCE Solutions
        // -----------------------------
        $engineering = Section::create([
            'id' => (string) Str::uuid(),
            'name' => 'Engineering BCE Solutions',
            'slug' => Str::slug('Engineering BCE Solutions'),
        ]);

        // Section page
        Page::create([
            'id' => (string) Str::uuid(),
            'section_id' => $engineering->id,
            'title' => 'Engineering BCE Solutions',
            'slug' => Str::slug('Engineering BCE Solutions'),
            'content' => '<p>Main page content for Engineering BCE Solutions</p>',
        ]);

        $engineeringCategories = [
            'Equipment' => ['ASME Code Vessels', 'Coal – Fired Boilers', 'Pollution Control Systems', 'Dust Collectors'],
            'Solutions' => ['Asphalt', 'Carbon Black', 'Coal', 'Compressed Air'],
            'Services' => ['System Maintenance and Repair', 'System Installation Services'],
            'Expertise' => ['Chemical Engineering', 'Civil Engineering'],
        ];

        foreach ($engineeringCategories as $categoryName => $pages) {
            $category = Category::create([
                'id' => (string) Str::uuid(),
                'section_id' => $engineering->id,
                'name' => $categoryName,
                'slug' => Str::slug($engineering->slug . '-' . $categoryName),
            ]);

            // Category page
            Page::create([
                'id' => (string) Str::uuid(),
                'category_id' => $category->id,
                'title' => $categoryName,
                'slug' => Str::slug($engineering->slug . '-' . $categoryName),
                'content' => "<p>Main page for category $categoryName</p>",
            ]);

            // Pages under category
            foreach ($pages as $pageTitle) {
                Page::create([
                    'id' => (string) Str::uuid(),
                    'category_id' => $category->id,
                    'title' => $pageTitle,
                    'slug' => Str::slug($category->slug . '-' . $pageTitle),
                    'content' => "<p>Content for page $pageTitle</p>",
                ]);
            }
        }

        // -----------------------------
        // Manufacturing BCE Equipment
        // -----------------------------
        $manufacturing = Section::create([
            'id' => (string) Str::uuid(),
            'name' => 'Manufacturing BCE Equipment',
            'slug' => Str::slug('Manufacturing BCE Equipment'),
        ]);

        Page::create([
            'id' => (string) Str::uuid(),
            'section_id' => $manufacturing->id,
            'title' => 'Manufacturing BCE Equipment',
            'slug' => Str::slug('Manufacturing BCE Equipment'),
            'content' => '<p>Main page content for Manufacturing BCE Equipment</p>',
        ]);

        $manufacturingCategories = [
            'Dust Collectors' => ['S-Series Dust Collectors', 'C-Series Dust Collectors'],
            'BCE Manufacturing' => ['Cyclone Dust Collector Manufacturing', 'Multiclone Manufacturing and Fabrication'],
        ];

        foreach ($manufacturingCategories as $categoryName => $pages) {
            $category = Category::create([
                'id' => (string) Str::uuid(),
                'section_id' => $manufacturing->id,
                'name' => $categoryName,
                'slug' => Str::slug($manufacturing->slug . '-' . $categoryName),
            ]);

            Page::create([
                'id' => (string) Str::uuid(),
                'category_id' => $category->id,
                'title' => $categoryName,
                'slug' => Str::slug($manufacturing->slug . '-' . $categoryName),
                'content' => "<p>Main page for category $categoryName</p>",
            ]);

            foreach ($pages as $pageTitle) {
                Page::create([
                    'id' => (string) Str::uuid(),
                    'category_id' => $category->id,
                    'title' => $pageTitle,
                    'slug' => Str::slug($category->slug . '-' . $pageTitle),
                    'content' => "<p>Content for page $pageTitle</p>",
                ]);
            }
        }

        // -----------------------------
        // BCE Media
        // -----------------------------
        $media = Section::create([
            'id' => (string) Str::uuid(),
            'name' => 'bce-media',
            'slug' => Str::slug('bce-media'),
        ]);

        Page::create([
            'id' => (string) Str::uuid(),
            'section_id' => $media->id,
            'title' => 'bce-media',
            'slug' => Str::slug('bce-media'),
            'content' => '<p>Main page content for bce-media</p>',
        ]);

        $mediaCategories = [
            'bce-media' => ['BCE System Installation', 'BCE Structural Steel', 'BCE Cyclones'],
        ];

        foreach ($mediaCategories as $categoryName => $pages) {
            $category = Category::create([
                'id' => (string) Str::uuid(),
                'section_id' => $media->id,
                'name' => $categoryName,
                'slug' => Str::slug($media->slug . '-' . $categoryName),
            ]);

            Page::create([
                'id' => (string) Str::uuid(),
                'category_id' => $category->id,
                'title' => $categoryName,
                'slug' => Str::slug($media->slug . '-' . $categoryName),
                'content' => "<p>Main page for category $categoryName</p>",
            ]);

            foreach ($pages as $pageTitle) {
                Page::create([
                    'id' => (string) Str::uuid(),
                    'category_id' => $category->id,
                    'title' => $pageTitle,
                    'slug' => Str::slug($category->slug . '-' . $pageTitle),
                    'content' => "<p>Content for page $pageTitle</p>",
                ]);
            }
        }
    }
}
