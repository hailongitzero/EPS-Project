<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MdTaiLieuMoRong extends Model
{
    protected $table = 'mst_tai_lieu_mo_rong';
    protected $primaryKey = 'ma_tai_lieu_mo_rong';
    public $incrementing = false;
    const CREATED_AT = 'ngay_tao';
    const UPDATED_AT = 'ngay_cap_nhat';

    public function danhMucTaiLieu(){
        return $this->hasMany('App\MdDanhMucTaiLieu', 'ma_tai_lieu_mo_rong');
    }
}
