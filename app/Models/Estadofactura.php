<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Estadofactura extends Model
{
    protected $table = 'estadosfacturas';

	public $timestamps = false;

    protected $fillable = [
        'estado',
    ];
}
