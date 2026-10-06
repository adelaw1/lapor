<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Honor extends Model
{
    protected $table = 'honor';
    protected $guarded = ['id', 'created_at', 'updated_at'];
}
