<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MdDanhMucTaiLieu extends Model
{
    protected $table = 'mst_danh_muc_tai_lieu';
    protected $primaryKey = 'ma_danh_muc';
    public $incrementing = false;
    const CREATED_AT = 'ngay_tao';
    const UPDATED_AT = 'ngay_cap_nhat';

    public function taiLieu(){
        return $this->hasMany('App\MdTaiLieu', 'ma_danh_muc', 'ma_danh_muc');
    }

    public function toCongTac(){
        return $this->hasOne('App\MdToCongTac', 'ma_to_cong_tac', 'ma_to_cong_tac');
    }
}
