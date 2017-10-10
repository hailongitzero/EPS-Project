<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MdToCongTac extends Model
{
    protected $table = 'mst_to_cong_tac';
    protected $primaryKey = 'ma_to_cong_tac';
    public $incrementing = false;

    public function taiLieu(){
        return $this->hasManyThrough(
            'App\MdDanhMucTaiLieu', 'App\MdTaiLieu',
            'ma_danh_muc', 'ma_danh_muc', 'ma_to_cong_tac'
        );
    }

    public function danhMucTaiLieu(){
        return $this->hasMany('App\MdDanhMucTaiLieu', 'ma_to_cong_tac', 'ma_to_cong_tac');
    }
}
