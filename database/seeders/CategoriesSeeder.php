<?php

namespace Database\Seeders;

use App\Models\Categories;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = array(
            array('name_category' => 'Kelengkapan Rumah Tangga', 'slug' => 'kelengkapan-rumah-tangga'),
            array('name_category' => 'Kerajinan', 'slug' => 'kerajinan'),
            array('name_category' => 'Aksesoris', 'slug' => 'aksesoris'),
            array('name_category' => 'Fashion', 'slug' => 'fashion'),
            array('name_category' => 'Kecantikan', 'slug' => 'kecantikan'),
            array('name_category' => 'Hobi dan Alat Tulis', 'slug' => 'hobi-dan-alat-tulis'),
            array('name_category' => 'Elektronik', 'slug' => 'elektronik'),
            array('name_category' => 'Beauty Macrame', 'slug' => 'beauty-macrame'),
        );

        foreach ($categories as $category)

        Categories::create($category);
    }
}
