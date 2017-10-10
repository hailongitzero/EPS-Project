<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MdTruSo extends Model
{
    protected $table = 'mst_tru_so';
    protected $primaryKey = 'ma_tru_so';
    public $incrementing = false;

    public function phongBan(){
        return $this->hasMany('App\MdPhongBan', 'ma_tru_so', 'ma_tru_so');
    }

    public function toCongTac(){
        return $this->hasManyThrough(
            'App\MdToCongTac', 'App\MdPhongBan',
            'ma_phong_ban', 'ma_phong_ban', 'ma_tru_so'
        );
    }
}
