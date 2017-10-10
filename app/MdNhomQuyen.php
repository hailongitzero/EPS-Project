<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MdNhomQuyen extends Model
{
    protected $table = 'mst_nhom_quyen';
    protected $primaryKey = 'ma_nhom_quyen';
    public $incrementing = false;
}
