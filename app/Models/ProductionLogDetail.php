<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductionLogDetail extends Model
{
    use HasFactory;
    protected $primaryKey = 'ProductionLogDetailID';
    protected $guarded = [];

    public function material(){
        return $this->belongsTo(Item::class, 'MaterialID');
    }
}
