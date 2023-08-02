<?php

namespace Database\Seeders;

use App\Models\Reviews;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ReviewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Reviews::create([
            'user_id' => 2,
            'product_id' => 1,
            'rating' => 3.5,
            'coments' => 'Barangnya sangat berkualitas, dan pengirimannya cepat'
        ]);
    }
}
