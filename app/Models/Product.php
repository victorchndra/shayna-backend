<?php

namespace App\Models;

use App\Models\TransactionDetail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    public function galleries() {
        return $this->hasMany(ProductGallery::class, 'products_id');
    }

    public function detail() {
        return $this->hasMany(TransactionDetail::class, 'products_id');
    }
}
