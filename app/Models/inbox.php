<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class inbox extends Model
{
    protected $fillable = [
        'nama_pengirim',
        'email',
        'pesan'
    ];
}
