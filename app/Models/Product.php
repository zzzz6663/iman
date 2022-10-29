<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable=[
        'supplier_id',
        'brand_id',
        'traffic_code',
        'barcode',
        'description',
        'width',
        'height',
        'unit',
        'inw',
        'igw',
        'volume',
        'price',
        'south_code',
        'euro_number',
    ];
    public function supplier(){
        return $this->belongsTo(Supplier::class);
    }
    public function brand(){
        return $this->belongsTo(Brand::class);
    }
}
