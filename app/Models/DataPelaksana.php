<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataPelaksana extends Model
{
    protected $table = 'data_pelaksana';
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function honor()
    {
        return $this->belongsTo(Honor::class);
    }
}
