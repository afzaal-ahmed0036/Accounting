<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductionLog extends Model
{
    use HasFactory;
    protected $primaryKey = 'ProductionLogID';
    protected $guarded = [];

    public function productionLogDetails(){
        return $this->hasMany(ProductionLogDetail::class, 'ProductionLogID');
    }
}
