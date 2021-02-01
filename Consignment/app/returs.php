<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class returs extends Model
{
    use SoftDeletes;
    public $table = 'returs';
    public $timestamps = true;
    public $incrementing  = true;
    protected $primaryKey = "retur_id";
}
