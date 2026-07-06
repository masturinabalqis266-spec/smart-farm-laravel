<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pest extends Model
{
    use HasFactory;

    protected $fillable = [
        'pest_name',
        'threat_level',
        'treatment',
        'location',
        'detection_count',
    ];

    /**
     * Get all pest reports for this pest.
     *
     * This links pests.pest_name to pest_reports.pest_type.
     */
    public function reports()
    {
        return $this->hasMany(
            PestReport::class,
            'pest_type',   // Foreign key in pest_reports
            'pest_name'    // Local key in pests
        );
    }
}