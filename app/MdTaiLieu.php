<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MdTaiLieu extends Model
{
    protected $table = 'mst_tai_lieu';
    protected $primaryKey = 'ma_tai_lieu';
    public $incrementing = false;
    const CREATED_AT = 'ngay_tao';
    const UPDATED_AT = 'ngay_cap_nhat';

    public function tacGia(){
        return $this->hasOne('App\User', 'ma_nhan_vien', 'nguoi_dang');
    }
}
