<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MdHinhAnh extends Model
{
    protected $table = 'mst_hinh_anh';
    protected $primaryKey = 'ma_hinh_anh';
    public $incrementing = false;
    const CREATED_AT = 'ngay_dang';
    public $timestamps = false;

    public function slider(){
        return $this->belongsTo('App\MdThuVienHinhAnh', 'ma_thu_vien', 'ma_thu_vien');
    }
}
