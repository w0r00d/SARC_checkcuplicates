<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BeneficiaryView extends Model
{
    use HasFactory;

    protected $table = 'beneficiaries_view';

    public $timestamps = false;
}
