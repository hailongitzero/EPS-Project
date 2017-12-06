<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MdThuVienHinhAnh extends Model
{
    protected $table = 'mst_thu_vien_hinh_anh';
    protected $primaryKey = 'ma_thu_vien';
    public $incrementing = false;
    const CREATED_AT = 'ngay_tao';
    const UPDATED_AT = 'ngay_cap_nhat';

    public function hinhAnh(){
        return $this->hasMany('App\MdHinhAnh', 'ma_thu_vien', 'ma_thu_vien');
    }
    public function nguoiDang(){
        return $this->hasOne('App\User', 'ma_nhan_vien', 'nguoi_tao');
    }
    public function nguoiCapNhat(){
        return $this->hasOne('App\User', 'ma_nhan_vien', 'nguoi_cap_nhat');
    }
}
