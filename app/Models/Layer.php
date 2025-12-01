<?php

namespace App\Models;

use App\Enums\LayerType;
use Illuminate\Database\Eloquent\Model;

class Layer extends Model
{
    protected $table = 'layers';
    protected $fillable = ['type', 'geojson', 'area', 'name', 'description', 'color'];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'type' => LayerType::class,
        ];
    }

    public function kelurahan()
    {
        return $this->hasOne(Kelurahan::class);
    }

    public function rw()
    {
        return $this->hasOne(RW::class);
    }

    public function rt()
    {
        return $this->hasOne(RT::class);
    }
}
