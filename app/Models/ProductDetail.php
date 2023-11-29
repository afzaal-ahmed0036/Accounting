<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductDetail extends Model
{
    use HasFactory;
    protected $primaryKey = 'ProductDetailID';
    protected $guarded = [];

    public function Item(){
        return $this->belongsTo(Item::class, 'ItemID');
    }
}
