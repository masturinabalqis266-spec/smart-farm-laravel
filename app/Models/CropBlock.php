<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CropBlock extends Model
{
    use HasFactory;

    protected $fillable = [
        'block_name',
        'crop_variety',
        'tree_count',
        'planting_date',
        'growth_status',
    ];
}
