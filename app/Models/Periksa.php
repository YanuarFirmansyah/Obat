<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\PeriksaObat;

class Periksa extends Model
{
    protected $fillable = [
        'id_pasien',
        'id_dokter',
        'tgl_periksa',
        'catatan',
        'biaya_periksa',
        'status'
    ];

    public function dokter(): BelongsTo{
        return $this->belongsTo(User::class,'id_dokter');
    }

    public function pasien(): BelongsTo{
        return $this->belongsTo(User::class,'id_pasien');
    }

    public function detail_periksa(): HasMany{
        return $this->hasMany(DetailPeriksa::class,'id_periksa');
    }

    public function obats()
    {
        return $this->belongsToMany(Obat::class, 'periksa_obats', 'id_periksa', 'id_obat');
    }

    public function periksaObats()
    {
        return $this->hasMany(PeriksaObat::class, 'id_periksa');
    }

}