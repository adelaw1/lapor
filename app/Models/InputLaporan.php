<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InputLaporan extends Model
{
    protected $table = 'input_laporan';
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function rentang_tanggal()
    {
        return $this->belongsTo(RentangTanggal::class, 'kode', 'kode');
    }

    public function barang()
    {
        return $this->hasMany(BelanjaMaterial::class, 'kode', 'kode');
    }

    public function toko()
    {
        return $this->belongsTo(Toko::class);
    }
}
