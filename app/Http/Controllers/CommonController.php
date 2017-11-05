<?php

namespace App\Http\Controllers;

use App\MdDanhMucMoRong;
use Illuminate\Http\Request;
use App\MdTruSo;
use Illuminate\Support\Facades\Auth;

class CommonController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function createPrimaryKey($oldKey, $prefix){
        $prefixLength = strlen($prefix);
        $keyNum = substr($oldKey, $prefixLength, (strlen($oldKey)-$prefixLength));
        $newNum = (int)$keyNum + 1;
        $newKey = $prefix;
        $zero = strlen($keyNum) - strlen($newNum);
        for ($i = 0; $i < $zero; $i++){
            $newKey .= '0';
        }

        $newKey .= $newNum;
        return $newKey;

    }

    public function getMenuData(){
        $menuData = array(
            'menuPhongBan' => MdTruSo::with('phongBan.toCongTac')->where('trang_thai', true)->get(),
            'menuMoRong' => MdDanhMucMoRong::with('taiLieuMoRong')->where('trang_thai', true)->get()
        );
        return $menuData;
    }
}
