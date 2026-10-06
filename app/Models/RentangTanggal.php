<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RentangTanggal extends Model
{
    protected $table = 'rentang_tanggal';
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function laporan()
    {
        return $this->belongsTo(InputLaporan::class, 'kode', 'kode');
    }
}
