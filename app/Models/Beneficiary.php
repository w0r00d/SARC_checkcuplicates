<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class Beneficiary extends Model
{
    use HasFactory;
    protected $fillable = ['national_id', 'firstname', 'lastname','project_id']; 

    public function projects(): BelongsTo 
    {
        return $this->belongsTo(Project::class);
    }
}
