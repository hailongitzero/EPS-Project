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
            'dsTruSo' => MdTruSo::get(),
            'menuData' => $menuData,
            'userInfo' => $userInfo,
        );
        return view('authority', $layoutData);
    }

    public function getUserPhanQuyen(Request $request){
        $tenNhanVien = $request->tenNhanVien;
        $tenDangNhap = $request->tenDangNhap;
        $maPhongBan = $request->maPhongBan;
        if (count($maPhongBan) > 0){
            $user = User::where('ma_nhan_vien', 'like', '%'.$tenDangNhap.'%')->where('ho_ten', 'like', '%'.$tenNhanVien.'%')->where('ma_phong_ban', $maPhongBan)->get();
        }else{
            $user = User::where('ma_nhan_vien', 'like', '%'.$tenDangNhap.'%')->where('ho_ten', 'like', '%'.$tenNhanVien.'%')->get();
        }
//        $user = User::Where('ma_nhan_vien', 'like', '%'.$tenDangNhap.'%')->Where('ho_ten', 'like', '%'.$tenNhanVien.'%')->orWhere('ma_phong_ban', $maPhongBan)->get();

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
        $result = MdToCongTac::where('ma_phong_ban', $maPhongBan)->where('trang_thai', 1)->get();
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

    public function gategoryManager(){
        $menuData = $this->getMenuData();
        $userInfo = $this->getUserInfo();

        $layoutData = array(
            'dsTruSo' => MdTruSo::get(),
            'dsDanhMuc' => MdDanhMucMoRong::get(),
            'menuData' => $menuData,
            'userInfo' => $userInfo,
        );
        return view('category', $layoutData);
    }

    public function addNewExtDocumentCategory(Request $request){
        if (Auth::check()) {
            $userId = Auth::user()->ma_nhan_vien;
            try {
                if(MdTaiLieuMoRong::where('ten_tai_lieu_mo_rong', $request->tenDanhMucTaiLieu)->count() > 0){
                    return response()->json(['info' => 'fail', 'Content' => 'Tên danh mục tài liệu đã tồn tại.'], 200);
                }
                $dmTaiLieu = new MdTaiLieuMoRong();
                $maxKey = MdTaiLieuMoRong::max('ma_tai_lieu_mo_rong');
                $maDMTaiLieu = $this->createPrimaryKey($maxKey, 'ETL', 7);
                $dmTaiLieu->ma_tai_lieu_mo_rong = $maDMTaiLieu;
                if (isset($request->tenDanhMucTaiLieu)) {
                    $dmTaiLieu->ten_tai_lieu_mo_rong = $request->tenDanhMucTaiLieu;
                }
                if (isset($request->maDanhMuc)) {
                    $dmTaiLieu->ma_danh_muc_mo_rong = $request->maDanhMuc;
                }
                $dmTaiLieu->thu_muc = $request->maDanhMuc.'/'.$maDMTaiLieu;
                $dmTaiLieu->trang_thai = 1;
                $dmTaiLieu->nguoi_tao = $userId;
                $dmTaiLieu->save();

                return response()->json(['info' => 'success', 'Content' => 'Cập nhật thành công'], 200);
            } catch (QueryException $e) {
                return response()->json(['info' => 'fail', 'Content' => 'Thêm mới không thành công. Lỗi hệ thống.'], 200);
            }
        }else{
            return response()->json(['info' => 'fail', 'Content' => 'Bạn chưa đăng nhập'], 200);
        }
    }

    public function updateExtDocumentCategory(Request $request){
        if (Auth::check()) {
            $userId = Auth::user()->ma_nhan_vien;
            try {
                $maDMTaiLieu = $request->maDanhMuc;
                $maDMTaiLieu = MdTaiLieuMoRong::find($maDMTaiLieu);
                if (isset($request->tenDanhMuc)) {
                    if(MdTaiLieuMoRong::where('ten_tai_lieu_mo_rong', $request->tenDanhMuc)->count() > 0){
                        return response()->json(['info' => 'fail', 'Content' => 'Tên danh mục tài liệu đã tồn tại.'], 200);
                    }
                    $maDMTaiLieu->ten_tai_lieu_mo_rong = $request->tenDanhMuc;
                }
                if (isset($request->status)) {
                    $maDMTaiLieu->trang_thai = $request->status;
                }
                $maDMTaiLieu->save();
                return response()->json(['info' => 'success', 'Content' => 'Cập nhật thành công'], 200);
            } catch (QueryException $e) {
                return response()->json(['info' => 'fail', 'Content' => 'Cập nhật không thành công. Lỗi hệ thống.'], 200);
            }
        }else{
            return response()->json(['info' => 'fail', 'Content' => 'Bạn chưa đăng nhập'], 200);
        }
    }

    public function updateDepartment(Request $request){
        if (Auth::check()) {
            $userId = Auth::user()->ma_nhan_vien;
            try {
                $maPhongBan = $request->maPhongBan;
                $phongBan = MdPhongBan::find($maPhongBan);
                if (isset($request->maPhongBan)) {
                    if(MdPhongBan::where('ma_tru_so', $request->maTruSo)->where('ten_phong_ban', $request->tenPhongBan)->count() > 0){
                        return response()->json(['info' => 'fail', 'Content' => 'Cập nhật thất bại. Trụ sở này đã có phòng ban này.'], 200);
                    }
                    $phongBan->ten_phong_ban = $request->tenPhongBan;
                }
                $phongBan->save();
                return response()->json(['info' => 'success', 'Content' => 'Cập nhật thành công'], 200);
            } catch (QueryException $e) {
                return response()->json(['info' => 'fail', 'Content' => 'Cập nhật không thành công. Lỗi hệ thống.'], 200);
            }
        }else{
            return response()->json(['info' => 'fail', 'Content' => 'Bạn chưa đăng nhập'], 200);
        }
    }

    public function addDepartment(Request $request){
        if (Auth::check()) {
            $userId = Auth::user()->ma_nhan_vien;
            try {
                if(MdPhongBan::where('ma_tru_so', $request->maTruSo)->where('ten_phong_ban', $request->tenPhongBan)->count() > 0){
                    return response()->json(['info' => 'fail', 'Content' => 'Thêm mới thất bại. Trụ sở này đã có phòng ban này.'], 200);
                }
                $phongBan = new MdPhongBan();
                $maxKey = MdPhongBan::where('ma_phong_ban', 'like', $request->maTruSo.'%')->max('ma_phong_ban');
                $maPhongBan = $this->createPrimaryKey($maxKey, $request->maTruSo, 7);
                $phongBan->ma_phong_ban = $maPhongBan;
                if (isset($request->tenPhongBan)) {
                    $phongBan->ten_phong_ban = $request->tenPhongBan;
                }
                $phongBan->ma_tru_so = $request->maTruSo;
                $phongBan->save();

                return response()->json(['info' => 'success', 'Content' => 'Cập nhật thành công'], 200);
            } catch (QueryException $e) {
                return response()->json(['info' => 'fail', 'Content' => 'Thêm mới không thành công. Lỗi hệ thống.'], 200);
            }
        }else{
            return response()->json(['info' => 'fail', 'Content' => 'Bạn chưa đăng nhập'], 200);
        }
    }

    public function updateToCT(Request $request){
        if (Auth::check()) {
            $userId = Auth::user()->ma_nhan_vien;
            try {

                if (isset($request->maPhongBan) && isset($request->tenTo)) {
                    if(MdToCongTac::where('ma_phong_ban', $request->maPhongBan)->where('ten_to_cong_tac', $request->tenTo)->count() > 0){
                        return response()->json(['info' => 'fail', 'Content' => 'Cập nhật thất bại. Phòng ban này đã tồn tại tổ này này.'], 200);
                    }
                }
                $toCT = MdToCongTac::find($request->maTo);
                if ( isset($request->tenTo)){
                    $toCT->ten_to_cong_tac = $request->tenTo;
                }
                if (isset($request->status)){
                    $toCT->trang_thai = $request->status;
                }
                $toCT->nguoi_tao = $userId;
                $toCT->save();
                return response()->json(['info' => 'success', 'Content' => 'Cập nhật thành công'], 200);
            } catch (QueryException $e) {
                return response()->json(['info' => 'fail', 'Content' => 'Cập nhật không thành công. Lỗi hệ thống.'], 200);
            }
        }else{
            return response()->json(['info' => 'fail', 'Content' => 'Bạn chưa đăng nhập'], 200);
        }
    }

    public function addToCT(Request $request){
        if (Auth::check()) {
            $userId = Auth::user()->ma_nhan_vien;
            try {
                if(MdToCongTac::where('ma_phong_ban', $request->maPhongBan)->where('ten_to_cong_tac', $request->tenTo)->count() > 0){
                    return response()->json(['info' => 'fail', 'Content' => 'Thêm mới thất bại. Phòng ban này đã có tổ này này.'], 200);
                }
                $toCT = new MdToCongTac();
                $maxKey = MdToCongTac::where('ma_to_cong_tac', 'like', $request->maPhongBan.'%')->max('ma_to_cong_tac');
                $maToCT = $this->createPrimaryKey($maxKey, $request->maPhongBan, 10);
                $toCT->ma_to_cong_tac = $maToCT;
                if (isset($request->tenTo)) {
                    $toCT->ten_to_cong_tac = $request->tenTo;
                }
                $toCT->ma_phong_ban = $request->maPhongBan;
                $toCT->thu_muc = $request->maPhongBan;
                $toCT->trang_thai = 1;
                $toCT->nguoi_tao = $userId;
                $toCT->save();

                return response()->json(['info' => 'success', 'Content' => 'Cập nhật thành công'], 200);
            } catch (QueryException $e) {
                return response()->json(['info' => 'fail', 'Content' => 'Thêm mới không thành công. Lỗi hệ thống.'], 200);
            }
        }else{
            return response()->json(['info' => 'fail', 'Content' => 'Bạn chưa đăng nhập'], 200);
        }
    }
}