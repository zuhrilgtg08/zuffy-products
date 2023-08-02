<?php

namespace App\Models;

use App\Models\Cities;
use App\Models\Product;
use App\Models\Provinces;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Worker extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'workers';

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function provinsi()
    {
        return $this->belongsTo(Provinces::class, 'w_provinsi_id');
    }

    public function kota()
    {
        return $this->belongsTo(Cities::class, 'w_kota_id');
    }
}
