<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MdPhanQuyen extends Model
{
    protected $table = 'mst_phan_quyen';
    protected $primaryKey = 'ma_phan_quyen';
    const CREATED_AT = 'ngay_tao';
    const UPDATED_AT = 'ngay_cap_nhat';

    public function pqTo(){
        return $this->hasOne('App\MdToCongTac', 'ma_to_cong_tac', 'ma_nhom_quyen');
    }

    public function pqDanhMuc(){
        return $this->hasOne('App\MdTaiLieuMoRong', 'ma_tai_lieu_mo_rong', 'ma_nhom_quyen');
    }
}
