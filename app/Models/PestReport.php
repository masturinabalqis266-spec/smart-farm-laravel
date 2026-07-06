<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\CropBlock;

class PestReport extends Model
{
    protected $fillable = [
        'user_id',
        'crop_block_id',
        'pest_type',
        'temperature',
        'humidity',
        'severity',
        'remarks',
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