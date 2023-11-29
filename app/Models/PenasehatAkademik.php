<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PenasehatAkademik extends Model
{
    use HasFactory;

    public function dosen(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_dosen', 'id');
    }
    public function mahasiswa(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_mahasiswa', 'id');
    }
}
