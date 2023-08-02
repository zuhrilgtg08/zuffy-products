<?php 

namespace App\Traits;
use Ramsey\Uuid\Exception\UnsupportedOperationException;
use Ramsey\Uuid\Uuid as Codename;

trait Uuid 
{
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            try {
                $model->uuid = Codename::uuid4()->toString();
            } catch (UnsupportedOperationException $e) {
                abort(500, $e->getMessage());
            }
        });
    }
}