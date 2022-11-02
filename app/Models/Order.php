<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable=[
        'client_id',
        'supplier_id',
        'product_id',
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
        'quantity',
    ];
    public function user(){
        return $this->belongsTo(User::class,'client_id','id');
        // return $this->belongsTo(User::class,'id','client_id');
    }
    public function brand(){
        return $this->belongsTo(Brand::class);
    }
        // return $this->belongsTo(User::class,'id','client_id');
    public function products(){
        return $this->belongsToMany(Product::class)->withPivot([
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
            'quantity',
        ]);;
        // return $this->belongsTo(User::class,'id','client_id');
    }
}
