<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
class Project extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'donor','implementation_date','status'];
    public function Beneficiaries() :hasMany
    {
        return $this->hasMany(Beneficiary::class);
    }
}
