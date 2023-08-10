<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'name_product' => 'Macrame Flamingo',
            'weight_product' => 500,
            'category_id' => 8,
            'worker_id' => 2,
            'stock_product' => 245,
            'price_product' => 47500,
            'excerpt' => 'Macrame ini dapat difungsikan sebagai pembatas ruangan dan pengganti gorden pintu konvensional.',
            'desc_product' => '<h2>Macrame Wall Hanging & Dream Catcher</h2> <br> 
            <p>Bisa digunakan untuk hiasan dinding, dekorasi rumah, pesta, pernikahan, anniversary, backdrop ataupun kebutuhan fotografi. Dengan berbagai pilihan warna yang menarik, sesuai dengan tema yang kamu inginkan. Cocok banget buat kamu yang suka dekorasi dengan style vintage tapi tetap kekinian, bohemian, minimalis, simple dan elegan.</p>
            <p>Ada yang belum lengkap buat dekorasi rumah kamu? Kami juga menyediakan : Rak / Gantungan Boneka, Shelf Hanging, Gantungan Hijab / Jilbab / Mukena, Pot Hanger / Gantungan Pot, Sarung Bantal, Taplak Meja, Tatakan Gelas, Placemat dan lain lain.</p>',
            'image_product' => null
        ]);

        Product::create([
            'name_product' => 'Poster Dinding Anime',
            'weight_product' => 325,
            'category_id' => 3,
            'worker_id' => 2,
            'stock_product' => 245,
            'price_product' => 27500,
            'excerpt' => 'Poster dinding anime berkualitas, dengan harga terjangkau untuk dekorasi kamar anda',
            'desc_product' => '<h2>Poster Dinding Anime</h2> <br> 
            <p>Bisa digunakan untuk hiasan dinding, dekorasi rumah, pesta, pernikahan, anniversary, backdrop ataupun kebutuhan fotografi. Dengan berbagai pilihan warna yang menarik, sesuai dengan tema yang kamu inginkan. Cocok banget buat kamu yang suka dekorasi dengan style vintage tapi tetap kekinian, bohemian, minimalis, simple dan elegan.</p>
            <p>Ada yang belum lengkap buat dekorasi rumah kamu? Kami juga menyediakan : Rak / Gantungan Boneka, Shelf Hanging, Gantungan Hijab / Jilbab / Mukena, Pot Hanger / Gantungan Pot, Sarung Bantal, Taplak Meja, Tatakan Gelas, Placemat dan lain lain.</p>',
            'image_product' => null
        ]);

        Product::create([
            'name_product' => 'Arduino Uno Stater Kit',
            'weight_product' => 2500,
            'category_id' => 7,
            'worker_id' => 1,
            'stock_product' => 1200,
            'price_product' => 167500,
            'excerpt' => 'Arduino Indonesia berinovasi dan melahirkan sebuah Arduino Starter KIT for Beginner',
            'desc_product' => '<h2>Arduino Uno Stater Kit</h2> <br> 
            <p>Arduino Indonesia berinovasi dan melahirkan sebuah Arduino Starter KIT for Beginner - Premium Version ( Paket Belajar Arduino untuk Pemula ) untuk mempermudah belajar bagi Anda yang masih pemula. Kami menawarkan Arduino Starter KIT for Beginner - Premium Version ( Paket Belajar Arduino untuk Pemula ) yang merupakan seperangkat media pembelajaran interaktif berbasis Arduino UNO R3 yang dikemas menjadi satu paket/box.</p>
            <p>Arduino Starter KIT for Beginner - Premium Version ini cocok untuk kegiatan praktek belajar dan mengajar (pembelajaran) di SMK atau pun Kampus (Perguruan Tinggi). Bisa juga untuk level SMP dan SMA Sederajat yang di dalamnya ada Ekstra Kurikuler Khusus di Bidang Robotika atau IT.</p>',
            'image_product' => null
        ]);

    }
}
