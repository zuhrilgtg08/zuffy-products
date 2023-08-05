<?php

namespace App\Models;
use App\Traits\Uuid;
use App\Models\Cities;
use App\Models\Keranjang;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Checkouts extends Model
{
    use HasFactory, Uuid;
    protected $guarded = ['id'];
    protected $table = 'checkouts';

    public function keranjang()
    {
        return $this->hasMany(Keranjang::class);
    }

    public function province()
    {
        return $this->belongsTo(Provinces::class, 'province_id');
    }

    public function cities()
    {
        return $this->belongsTo(Cities::class, 'destination_id');
    }
}
