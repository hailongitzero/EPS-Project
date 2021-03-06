<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MdPhongBan extends Model
{
    protected $table = 'mst_phong_ban';
    protected $primaryKey = 'ma_phong_ban';
    public $incrementing = false;
    const CREATED_AT = 'ngay_tao';
    const UPDATED_AT = 'ngay_cap_nhat';

    public function truSo(){
        return $this->belongsTo('App\MdTruSo', 'ma_tru_so', 'ma_tru_so');
    }

    public function toCongTac(){
        return $this->hasMany('App\MdToCongTac', 'ma_phong_ban', 'ma_phong_ban');
    }

    public function toCongTacAuth(){
        return $this->hasManyThrough(
            'App\MdPhanQuyen', 'App\MdToCongTac',
            'ma_to_cong_tac', 'ma_nhom_quyen', 'ma_phong_ban'
        );
    }
}
