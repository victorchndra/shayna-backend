<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductGallery extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    public function product() {
        return $this->belongsTo(Product::class, 'products_id', 'id');
    }

    // Accessor untuk photo, karena berpengaruh pada proses API yg menggunakan url full.
    public function getPhotoAttribute($value) {
        return url('storage/' . $value);
    }
}
