<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MdPhanQuyen extends Model
{
    protected $table = 'mst_phan_quyen';
    protected $primaryKey = 'ma_phan_quyen';
    const CREATED_AT = 'ngay_tao';
    const UPDATED_AT = 'ngay_cap_nhat';
}
