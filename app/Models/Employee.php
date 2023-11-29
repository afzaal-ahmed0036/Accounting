<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function teamLead()
    {
        return $this->belongsTo(Employee::class, 'teamLeadID');
    }

    // Define a relationship for the employees under a team lead
    public function teamMembers()
    {
        return $this->hasMany(Employee::class, 'teamLeadID');
    }
}
