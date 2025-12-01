<?php

namespace App\Models;

use App\Enums\MarkerCategory;
use Illuminate\Database\Eloquent\Model;

class Marker extends Model
{
    protected $fillable = ['category', 'name', 'latitude', 'longitude', 'description', 'icon', 'color'];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'category' => MarkerCategory::class,
        ];
    }
}
