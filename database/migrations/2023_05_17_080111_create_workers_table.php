<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('workers', function (Blueprint $table) {
            $table->id();
            $table->string('fullname')->nullable();
            $table->string('username');
            $table->foreignId('w_provinsi_id');
            $table->foreignId('w_kota_id');
            $table->date('tgl_lahir')->nullable();
            $table->longText('bio_worker')->nullable();
            $table->string('w_ket_alamat');
            $table->string('image_profile_worker')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('workers');
    }
};
