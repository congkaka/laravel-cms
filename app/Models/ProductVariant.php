<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    use HasFactory;

    protected $table = 'product_variants';

    protected $fillable = [
        'name',
        'slug',
        'price',
        'price_ctv',
        'price_agency',
        'min_sale_quantity',
        'max_sale_quantity',
        'product_id',
        'is_active'
    ];

    protected $casts = [];

    protected $relations = [
        'product'
    ];

    public function product() {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
