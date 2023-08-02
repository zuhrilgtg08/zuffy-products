<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory, Uuid;
    protected $guarded = ['id'];
    protected $table = 'products';

    public function category()
    {
        return $this->belongsTo(Categories::class, 'category_id');
    }

    public function worker()
    {
        return $this->belongsTo(Worker::class, 'worker_id');
    }

    public function reviews()
    {
        return $this->hasMany(Reviews::class, 'product_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function keranjang()
    {
        return $this->hasMany(Keranjang::class, 'product_id');
    }

    public function getRouteKeyName()
    {
        return 'uuid';
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where('name_product', 'like', '%' . $search . '%')
                ->orWhereHas('category', function($query) use ($search) {
                    return $query->where('name_category', 'like', '%' . $search . '%');
                })
                ->orWhereHas('worker', function($query) use ($search) {
                    return $query->where('fullname', 'like', '%' . $search . '%')
                    ->orWhere('username', 'like', '%' . $search . '%');
                });
        });
    }
}
