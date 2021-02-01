<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class admins extends Model
{
    use SoftDeletes;
    public $timestamps = true;
    protected $primaryKey = "ADMINP_ID";

    protected $fillable = [
        'NAMA_ADMINP',
        'PASSWORD_ADMINP',
        'email'
    ];
}
