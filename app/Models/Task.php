<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
    'user_id',
    'crop_block_id',
    'task_name',
    'description',
    'task_date',
    'status',
];

public function user()
{
    return $this->belongsTo(User::class);
}

public function cropBlock()
{
    return $this->belongsTo(CropBlock::class);
}
}
