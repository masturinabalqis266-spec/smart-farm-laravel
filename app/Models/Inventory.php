<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    protected $fillable = [
    'item_name',
    'category',
    'current_stock',
    'minimum_stock',
    'unit',
    'supplier',
    'description',
];
}