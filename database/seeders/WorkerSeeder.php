<?php

namespace Database\Seeders;

use App\Models\Worker;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class WorkerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Worker::create([
            'fullname' => 'Dimas Firmansyah',
            'username' => 'dimasGay23',
            'tgl_lahir' => null,
            'w_provinsi_id' => 11,
            'w_kota_id' => 444,
            'bio_worker' => 'Hubungan yang melibatkan dua pihak antara perusahaan dengan para pekerja/karyawan. Para pekerja akan mendapatkan gaji sebagai balas jasa dari pihak perusahaan atau pemberi kerja, dan jumlahnya tergantung dari jenis profesi yang dilakukan berdasarkan kontrak telah disetujui oleh kedua belah pihak. Pembayaran gaji dapat dalam bentuk upah per jam',
            'w_ket_alamat' => 'Jl Margodadi 1 No 24, RW 07 RT 1',
            'image_profile_worker' => null,
        ]);

        Worker::create([
            'fullname' => 'Nando Septian Prisandy',
            'username' => 'nandoDeng99',
            'tgl_lahir' => null,
            'w_provinsi_id' => 11,
            'w_kota_id' => 444,
            'bio_worker' => 'Hubungan yang melibatkan dua pihak antara perusahaan dengan para pekerja/karyawan. Para pekerja akan mendapatkan gaji sebagai balas jasa dari pihak perusahaan atau pemberi kerja, dan jumlahnya tergantung dari jenis profesi yang dilakukan berdasarkan kontrak telah disetujui oleh kedua belah pihak. Pembayaran gaji dapat dalam bentuk upah per jam',
            'w_ket_alamat' => 'Jl Rangkah 7 No 6B, RW 03 RT 7',
            'image_profile_worker' => null,
        ]);
    }
}
