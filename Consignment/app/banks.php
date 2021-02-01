<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class banks extends Model
{
    use SoftDeletes;
    public $timestamps = true;
    public $incrementing  = true;
    protected $primaryKey = "bank_id";

    protected $fillable=[
        'bank_id',
        'nama_bank',
        'rekening',
        'pemilik'
    ];
}
