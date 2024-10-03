<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendingBeneficiary extends Model
{
    use HasFactory;

    protected $fillable = ['national_id', 'fullname', 'governate', 'value', 'transfer_date', 'project', 'donor'];
}
