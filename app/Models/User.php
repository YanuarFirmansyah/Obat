<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'nama',
        'email',
        'password',
        'no_hp',
        'role',
        'alamat',
        'no_rm',
        'no_ktp',
        'id_poli',
    ];

    // relasi Ke periksa sebagai Pasien
    public function pasien(): HasMany{
        return $this->hasMany(Periksa::class, 'id_pasien');
    }

    public function dokter(): HasMany{
        return $this->hasMany(Periksa::class, 'id_dokter');
    }

    // Relasi ke jadwal periksa (untuk dokter)
    public function jadwalPeriksas()
    {
        // Pastikan relasi ke jadwal periksa benar dan return collection, bukan null
        return $this->hasMany(\App\Models\JadwalPeriksa::class, 'id_dokter', 'id');
    }

    public function poli()
    {
        return $this->belongsTo(\App\Models\Poli::class, 'id_poli');
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
