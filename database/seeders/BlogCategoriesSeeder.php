<?php

namespace Database\Seeders;

use App\Models\BlogCategories;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BlogCategoriesSeeder extends Seeder
{
   
    public function run(): void
    {
        $categories = [
            [
                'category_name' => 'Technology'
            ],
            [
                'category_name' => 'Programming'
            ],
            [
                'category_name' => 'Data Science'
            ],
            [
                'category_name' => 'AI & Machine Learning'
            ],
            [
                'category_name' => 'Cybersecurity'
            ],
            [
                'category_name' => 'DevOps'
            ],
            [
                'category_name' => 'Career & Interview'
            ],
            [
                'category_name' => 'Personal Growth'
            ],
            [
                'category_name' => 'Health & Fitness'
            ],
            [
                'category_name' => 'Travel'
            ],
            [
                'category_name' => 'Food & Recipes'
            ],
            [
                'category_name' => 'Finance & Investing'
            ],
            [
                'category_name' => 'Motivation'
            ],
            [
                'category_name' => 'Book Reviews'
            ],
            [
                'category_name' => 'Movies & Entertainment'
            ],
            [
                'category_name' => 'Photography'
            ],
            [
                'category_name' => 'Sports'
            ],
            [
                'category_name' => 'Anime'
            ],
            [
                'category_name' => 'Tutorials'
            ],
            [
                'category_name' => 'News & Updates'
            ],
            [
                'category_name' => 'Productivity'
            ],
            [
                'category_name' => 'UI/UX Design'
            ],
            [
                'category_name' => 'Web Development'
            ],
            [
                'category_name' => 'Mobile Development'
            ],
            [
                'category_name' => 'Engineering'
            ],
            [
                'category_name' => 'Startups'
            ]
        ];
        
        foreach($categories as $category){
            BlogCategories::create($category);
        }
    }
}
