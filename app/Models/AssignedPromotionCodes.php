<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignedPromotionCodes extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'code_id'];
}

