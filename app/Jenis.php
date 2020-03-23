<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jenis extends Model
{
    protected $table ="jenis_cuci";
    protected $primarykey="id_jenis";
    protected $fillable =[
        'id_jenis',
        'nama_jenis',
        'harga_per_kg',
    ];
}
