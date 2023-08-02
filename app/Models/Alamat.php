<?php

namespace App\Models;

use App\Models\User;
use App\Models\Cities;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Alamat extends Model
{
    use HasFactory;
    protected $table = 'alamats';
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function province()
    {
        return $this->belongsTo(Provinces::class, 'provinsi_id');
    }

    public function city()
    {
        return $this->belongsTo(Cities::class, 'kota_id');
    }
}
