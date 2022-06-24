<?php

namespace App\Models;

use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TransactionDetail extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    public function transaction() {
        return $this->belongsTo(Transaction::class, 'transactions_id', 'id');
    }

    public function product() {
        return $this->belongsTo(Product::class, 'products_id', 'id');
    }
}
