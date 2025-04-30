<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Obat;

class PeriksaObat extends Model
{
    use HasFactory;

    protected $table = 'periksa_obats';

    protected $fillable = [
        'id_periksa',
        'id_obat',
    ];

    public function obat()
    {
        return $this->belongsTo(Obat::class, 'id_obat');
    }
}