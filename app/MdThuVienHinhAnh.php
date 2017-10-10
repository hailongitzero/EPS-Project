<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MdThuVienHinhAnh extends Model
{
    protected $table = 'mst_thu_vien_hinh_anh';
    protected $primaryKey = 'ma_thu_vien';
    public $incrementing = false;
}
