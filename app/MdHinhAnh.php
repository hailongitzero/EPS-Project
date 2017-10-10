<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MdHinhAnh extends Model
{
    protected $table = 'mst_hinh_anh';
    protected $primaryKey = 'ma_hinh_anh';
    public $incrementing = false;
}
