<?php

namespace App\Models;
use App\Models\User;
use App\Models\Product;
use App\Models\Checkouts;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Keranjang extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'keranjangs';

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function checkout()
    {
        return $this->belongsTo(Checkouts::class, 'checkout_id');
    }
}
