<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Harvest extends Model
{
    protected $fillable = [
    'user_id',
    'crop_block_id',
    'harvest_date',
    'harvest_time',
    'yield_kg',
    'grade',
    'notes',
    'approval_status',
    'approved_by',
    'approved_at',
];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function cropBlock()
    {
        return $this->belongsTo(CropBlock::class);
    }

    public function approvedBy()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
}