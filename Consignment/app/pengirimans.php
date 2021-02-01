<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class pengirimans extends Model
{
    use SoftDeletes;
    public $timestamps = true;
    protected $primaryKey = 'pengiriman_id';
    public $incrementing = true;
}
