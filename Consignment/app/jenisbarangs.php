<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class jenisbarangs extends Model
{
    public $timestamps = false;
    protected $primaryKey = "JENIS_ID";

    protected $fillable=[
        'JENIS_ID',
        'NAMA_JENIS'
    ];
    //
}
