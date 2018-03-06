<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    const CREATED_AT = 'ngay_tao';
    const UPDATED_AT = 'ngay_cap_nhat';

    public function phongBan(){
        return $this->hasOne('App\MdPhongBan', 'ma_phong_ban', 'ma_phong_ban');
    }

    public function toCongTac(){
        return $this->hasOne('App\MdToCongTac', 'ma_to_cong_tac', 'ma_to_cong_tac');
    }
}
