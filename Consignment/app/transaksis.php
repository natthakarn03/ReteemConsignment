<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class transaksis extends Model
{
    use SoftDeletes;
    public $table = 'transaksis';
    public $timestamps = true;
    public $incrementing  = true;
    protected $primaryKey = "transaksi_id";

}
