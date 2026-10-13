<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BelanjaMaterial extends Model
{
    protected $table = 'belanja_material';
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function laporan ()
    {
        return $this->belongsTo(InputLaporan::class, 'kode', 'kode');
    }

    public function satuan ()
    {
        return $this->belongsTo(Satuan::class);
    }
}
