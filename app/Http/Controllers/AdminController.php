<?php
/**
 * Created by PhpStorm.
 * User: HaiLong
 * Date: 12/7/2017
 * Time: 11:59 PM
 */

namespace App\Http\Controllers;

use App\MdDanhMucMoRong;
use App\MdPhanQuyen;
use App\MdPhongBan;
use App\MdTaiLieuMoRong;
use App\MdToCongTac;
use App\MdTruSo;
use Illuminate\Http\Request;
use App\User;
use DB;
use Illuminate\Support\Facades\Auth;

class AdminController extends CommonController
{
    public function loadPhanQuyen(){
        $menuData = $this->getMenuData();
        $userInfo = $this->getUserInfo();

        $bodyInfo = array();
        $layoutData = array(
            'menuData' => $menuData,
            'userInfo' => $userInfo,
        );
        return view('authority', $layoutData);
    }

    public function getUserPhanQuyen(Request $request){
        $tenNhanVien = $request->tenNhanVien;
        $tenDangNhap = $request->tenDangNhap;
        $user = User::where('ma_nhan_vien', 'like', '%'.$tenDangNhap.'%')->where('ho_ten', 'like', '%'.$tenNhanVien.'%')->get();

//        dd($user->toJson());
        return response($user->toJson(), 200)->header('Content-Type', 'application/json');
    }

    public function getAuthListOfUser(Request $request){
        $maNhanVien = $request->maNhanVien;
//        $to = MdToCongTac::
        $sqlTo = 'select ma_to_cong_tac, ten_to_cong_tac from mst_to_cong_tac where ma_to_cong_tac IN (select ma_nhom_quyen from mst_phan_quyen where ma_nhan_vien = "'. $maNhanVien .'")';
        $sqlDM = 'select ma_tai_lieu_mo_rong, ten_tai_lieu_mo_rong from mst_tai_lieu_mo_rong where ma_tai_lieu_mo_rong IN  (select ma_nhom_quyen from mst_phan_quyen where ma_nhan_vien = "'. $maNhanVien .'")';
        $rslTo = DB::select(DB::raw($sqlTo));
        $rslDM = DB::select(DB::raw($sqlDM));
        $result = array(
            'rslTo' => $rslTo,
            'rslDM' => $rslDM,
        );
        return response($result, 200)->header('Content-Type', 'application/json');
    }

    public function getDsTruSo(Request $request){
        $result = MdTruSo::where('trang_thai', 1)->get();
        return response($result, 200)->header('Content-Type', 'application/json');
    }

    public function getDsDanhMuc(Request $request){
        $result = MdDanhMucMoRong::where('trang_thai', 1)->get();
        return response($result, 200)->header('Content-Type', 'application/json');
    }

    public function getDsTaiLieuMoRong(Request $request){
        $maDanhMuc = $request->maDanhMuc;
        $result = MdTaiLieuMoRong::where('ma_danh_muc_mo_rong', $maDanhMuc)->where('trang_thai', 1)->get();
        return response($result, 200)->header('Content-Type', 'application/json');
    }

    public function getDsPhongBan(Request $request){
        $maTruSo = $request->maTruSo;
        $result = MdPhongBan::where('ma_tru_so', $maTruSo)->get();
        return response($result, 200)->header('Content-Type', 'application/json');
    }

    public function getDsToCongTac(Request $request){
        $maPhongBan = $request->maPhongBan;
        $result = MdToCongTac::where('ma_phong_ban', $maPhongBan)->get();
        return response($result, 200)->header('Content-Type', 'application/json');
    }

    public function updateUserAuthority(Request $request){
        $dsPhanQuyen = explode(',', $request->dsPhanQuyen);
        $maNhanVien  = $request->maNhanVien;
        MdPhanQuyen::where('ma_nhan_vien', $maNhanVien)->delete();
        for ($i = 0; $i < count($dsPhanQuyen); $i++){
            $phanQuyen = new MdPhanQuyen();
            $phanQuyen->ma_nhan_vien = $maNhanVien;
            $phanQuyen->ma_nhom_quyen = $dsPhanQuyen[$i];
            $phanQuyen->nguoi_tao = Auth::user()->ma_nhan_vien;
            $phanQuyen->nguoi_cap_nhat = Auth::user()->ma_nhan_vien;
            $phanQuyen->save();
        }
        return response()->json(['info' => 'success', 'Content' => 'Cập nhật phân quyền thành công'], 200);
    }
}