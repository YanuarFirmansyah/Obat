<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Periksa extends Model
{
    protected $fillable = [
        'id_pasien',
        'id_dokter',
        'tgl_periksa',
        'catatan',
        'biaya_periksa',
    ];

    public function dokter(): belongsTo{
        return $this->belongsTo(User::class, 'id_dokter');
    }

    public function pasien(): belongsTo{
        return $this->belongsTo(User::class, 'id_pasien');
    }
}
