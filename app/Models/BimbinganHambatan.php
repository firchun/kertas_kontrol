<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BimbinganHambatan extends Model
{
    use HasFactory;
    public function hambatan(): BelongsTo
    {
        return $this->belongsTo(JenisHambatan::class, 'id_hambatan', 'id');
    }
}
