<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Toko extends Model
{
    protected $table = 'toko';
    protected $guarded = ['id', 'created_at', 'updated_at'];
}
