<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    protected $table = 'item';
    protected $primaryKey = 'ItemID';

    protected $guarded = [];
    public function productDetails()
    {
        return $this->hasMany(ProductDetail::class, 'ProductID');
    }
}
