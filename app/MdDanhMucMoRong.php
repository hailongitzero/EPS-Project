<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MdDanhMucMoRong extends Model
{
    protected $table = 'mst_danh_muc_mo_rong';
    protected $primaryKey = 'ma_danh_muc_mo_rong';
    public $incrementing = false;
    const CREATED_AT = 'ngay_tao';
    const UPDATED_AT = 'ngay_cap_nhat';

    public function taiLieuMoRong(){
        return $this->hasMany('App\MdTaiLieuMoRong', 'ma_danh_muc_mo_rong');
    }
}
