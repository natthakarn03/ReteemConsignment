<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class pengajuans extends Model
{
    use SoftDeletes;
    public $timestamps = true;
    protected $primaryKey = 'PENGAJUAN_ID';
    public $incrementing = true;
}
