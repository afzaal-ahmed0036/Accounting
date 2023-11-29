<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function client(){
        return $this->belongsTo(Party::class, 'client_id');
    }

    public function teamLead(){
        return $this->belongsTo(Employee::class, 'team_lead_id');
    }
}
