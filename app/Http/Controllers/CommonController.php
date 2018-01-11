<?php

namespace App\Http\Controllers;

use App\MdDanhMucMoRong;
use App\MdPhanQuyen;
use App\User;
use Illuminate\Http\Request;
use App\MdTruSo;
use Illuminate\Support\Facades\Auth;
use DB;

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

    public function createPrimaryKey($oldKey, $prefix, $length){
        $prefixLength = strlen($prefix);
        $keyNum = substr($oldKey, $prefixLength, ($length-$prefixLength));
        $newNum = (int)$keyNum + 1;
        $newKey = $prefix;
        $zero = $length - $prefixLength - strlen($newNum);
        for ($i = 0; $i < $zero; $i++){
            $newKey .= '0';
        }

        $newKey .= $newNum;
        return $newKey;

    }

    public function getMenuData(){
        if (Auth::check()) {
            if (Auth::user()->is_admin == 1){
                $menuData = array(
                    'menuPhongBan' => MdTruSo::with(['phongBan.toCongTac'=>function($query){
                        $query->where('trang_thai', 1);
                    }])->where('trang_thai', true)->get(),
                    'menuMoRong' => MdDanhMucMoRong::with(['taiLieuMoRong'=>function($query){
                        $query->where('trang_thai', 1);
                    }])->where('trang_thai', true)->get()
                );
            }else{
                $menuData = array(
                    'menuPhongBan' => MdTruSo::with(['phongBan'=>function($query){
                        $authList = array();
                        $id =Auth::user()->ma_nhan_vien;

                        $lstToCT = array();
                        $dsToCT = MdPhanQuyen::where('ma_nhan_vien', $id)->where('trang_thai', 1)->get();
                        foreach ($dsToCT as $ct){
                            array_push($lstToCT, $ct->ma_nhom_quyen);
                        }

                        $auth = DB::table('mst_to_cong_tac')->select('ma_phong_ban')
                            ->whereIn('ma_to_cong_tac', $lstToCT)
                            ->distinct()
                            ->get();

                        foreach ($auth as $a){
                            array_push($authList, $a->ma_phong_ban);
                        }
                        $query->whereIn('ma_phong_ban', $authList);
                    }, 'phongBan.toCongTac'=>function($query){
                        $authList = array();
                        $id =Auth::user()->ma_nhan_vien;
                        $auth = MdPhanQuyen::where('ma_nhan_vien', $id)->where('trang_thai', 1)->get();
                        foreach ($auth as $a){
                            array_push($authList, $a->ma_nhom_quyen);
                        }
                        return $query->whereIn('ma_to_cong_tac',  $authList)->where('trang_thai', 1);
                    }])->where('trang_thai', true)->whereHas('phongBan.toCongTac', function($query){
                        $authList = array();
                        $id =Auth::user()->ma_nhan_vien;
                        $auth = MdPhanQuyen::where('ma_nhan_vien', $id)->where('trang_thai', 1)->get();
                        foreach ($auth as $a){
                            array_push($authList, $a->ma_nhom_quyen);
                        }
                        return $query->whereIn('ma_to_cong_tac',  $authList)
                        ->where('trang_thai', 1);
                })->get(),

                    'menuMoRong' => MdDanhMucMoRong::with(['taiLieuMoRong'=>function($query){
                        $authList = array();
                        $id =Auth::user()->ma_nhan_vien;
                        $auth = MdPhanQuyen::where('ma_nhan_vien', $id)->where('trang_thai', 1)->get();
                        foreach ($auth as $a){
                            array_push($authList, $a->ma_nhom_quyen);
                        }
                        return $query->whereIn('ma_tai_lieu_mo_rong',  $authList)
                            ->where('trang_thai', 1);
                    }])->where('trang_thai', true)->whereHas('taiLieuMoRong', function($query){
                        $authList = array();
                        $id =Auth::user()->ma_nhan_vien;
                        $auth = MdPhanQuyen::where('ma_nhan_vien', $id)->where('trang_thai', 1)->get();
                        foreach ($auth as $a){
                            array_push($authList, $a->ma_nhom_quyen);
                        }
                        $query->whereIn('ma_tai_lieu_mo_rong',  $authList)
                            ->where('trang_thai', 1);
                    })->get(),
                );
            }
        }else{
            $menuData = '';
        }

        return $menuData;
    }

    public function getUserInfo(){
        if (Auth::check()){
            $userInfo = User::where('ma_nhan_vien', Auth::user()->ma_nhan_vien)->get();
        }else{
            $userInfo = '';
        }
        return $userInfo;
    }
    public function getAuthList(){
        $authList = array();
        $id = Auth::user()->ma_nhan_vien;
        $auth = MdPhanQuyen::where('ma_nhan_vien', $id)->where('trang_thai', 1)->get();
    }

    public function checkAuth($maQuyen){
        if (Auth::check()) {
            if (Auth::user()->is_admin)
                return true;
            if (MdPhanQuyen::where('ma_nhan_vien', Auth::user()->ma_nhan_vien)->where('ma_nhom_quyen', $maQuyen)->count() < 1)
                return false;
            return true;
        }else{
            return false;
        }
    }
}
