<?php

namespace App\Http\Controllers;

use App\MdTaiLieuMoRong;
use App\MdToCongTac;
use App\MdThuVienHinhAnh;
use Illuminate\Http\Request;
use App\MdDanhMucTaiLieu;
use App\MdTaiLieu;
use App\MdTruSo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use DB;

class DocumentController extends CommonController
{
    public function dsDanhMucTheoTo($maTo){
        if (Auth::check() && $this->checkAuth($maTo)){
            $menuData = $this->getMenuData();
            $userInfo = $this->getUserInfo();
            $toCongTac = MdToCongTac::with(['danhMucTaiLieu'=>function($query){
                $query->where('trang_thai', 1);
            }])->where('ma_to_cong_tac', $maTo)->get();
            $contentData = array(
                'toCongTac' => $toCongTac,
            );
            $layoutData = array(
                'menuData' => $menuData,
                'userInfo' => $userInfo,
                'contentData' => $contentData,
            );
//        dd($taiLieu);

            return view('document', $layoutData);
        }else{
            return response('<script> alert("Bạn không có quyền truy cập vào thư mục này"); window.history.back()</script>', 200);
//            return back()->withInput();
        }

    }

    public function themMoiDanhMuc(Request $request)
    {
        if (Auth::check()) {
            $userId = Auth::user()->ma_nhan_vien;
            try {
                if(MdDanhMucTaiLieu::where('ten_danh_muc', $request->tenDanhMuc)->count() > 0){
                    return response()->json(['info' => 'fail', 'Content' => 'Tên danh mục đã tồn tại.'], 200);
                }
                $danhMuc = new MdDanhMucTaiLieu();
                $maxKey = MdDanhMucTaiLieu::max('ma_danh_muc');
                $maDanhMuc = $this->createPrimaryKey($maxKey, 'DM', 6);
                $danhMuc->ma_danh_muc = $maDanhMuc;
                if (isset($request->tenDanhMuc)) {
                    $danhMuc->ten_danh_muc = $request->tenDanhMuc;
                }
                if (isset($request->maTo)) {
                    $danhMuc->ma_to_cong_tac = $request->maTo;
                }
                if(isset($request->maTaiLieuMoRong)){
                    $danhMuc->ma_tai_lieu_mo_rong = $request->maTaiLieuMoRong;
                }
                $danhMuc->trang_thai = 1;
                $danhMuc->nguoi_cap_nhat = $userId;
                $danhMuc->save();

                return response()->json(['info' => 'success', 'Content' => 'Thêm mới danh mục thành công'], 200);
            } catch (QueryException $e) {
                return response()->json(['info' => 'fail', 'Content' => 'Thêm mới không thành công. Lỗi hệ thống.'], 200);
            }
        }else{
            return response()->json(['info' => 'fail', 'Content' => 'Bạn chưa đăng nhập'], 200);
        }
    }

    public function dsTaiLieuTheoDanhMuc(Request $request){
        $maDanhMuc = '';
        $tenTaiLieu = '';
        if (isset($request->request->all()['datatable']['maDanhMuc'])){
            $maDanhMuc = $request->request->all()['datatable']['maDanhMuc'];
        }
        if (isset($request->request->all()['datatable']['tenTaiLieu']['generalSearch'])){
            $tenTaiLieu = $request->request->all()['datatable']['tenTaiLieu']['generalSearch'];
            $rawResult = MdTaiLieu::with('tacGia')->where('ma_danh_muc', $maDanhMuc)->where('ten_tai_lieu', 'like', '%'.$tenTaiLieu.'%')->where('trang_thai', 1)->get();
            $result ='{ "meta": { "page": 1, "pages": 1, "perpage": -1, "total": '.count($rawResult).', "sort": "asc", "field": "ma_tai_lieu" }, "data":';
            $result .= json_encode($rawResult);
            $result .= '}';
        }else{
            $result ='{ "meta": { "page": 1, "pages": 1, "perpage": -1, "total": '.MdTaiLieu::where('ma_danh_muc', $maDanhMuc)->where('trang_thai', 1)->count().', "sort": "asc", "field": "ma_tai_lieu" }, "data":';
            $result .= (string)MdTaiLieu::with('tacGia')->where('ma_danh_muc', $maDanhMuc)->where('trang_thai', 1)->get();
            $result .= '}';
        }
//dd($result);
        $result2 = '{ "data": '.(string)MdTaiLieu::where('ma_danh_muc', $maDanhMuc)->get().'}';

        return response($result, 200)->header('Content-Type', 'application/json');
    }

    public function dsTaiLieuTheoDanhMucTo($maTo, $maDanhMuc){
        $danhMuc = MdDanhMucTaiLieu::with('taiLieu')->where('ma_to_cong_tac', $maTo)->where('trang_thai', 1)->get();
        $menuData = $this->getMenuData();
        $userInfo = $this->getUserInfo();
        $toCongTac = MdToCongTac::with('danhMucTaiLieu')->where('ma_to_cong_tac', $maTo)->get();
        $contentData = array(
            'toCongTac' => $toCongTac,
        );
        $layoutData = array(
            'menuData' => $menuData,
            'userInfo' => $userInfo,
            'contentData' => $contentData,
        );
//        dd($toCongTac);

        return view('document', $layoutData);
    }

    public function downloadTaiLieu($maTaiLieu){
        if (Auth::check()) {
            $taiLieu = MdTaiLieu::find($maTaiLieu);
            $path = resource_path($taiLieu->lien_ket);

            return response()->download($path);
        }else{
            return response()->json(['info' => 'fail', 'Content' => 'Bạn chưa đăng nhập'], 200);
        }
    }

    public function uploadTaiLieu(Request $request){
        if (Auth::check()){
            $userId = Auth::user()->ma_nhan_vien;
            $path = 'resources/documents/';
            $maxKey = MdTaiLieu::max('ma_tai_lieu');
            $maTaiLieu = $this->createPrimaryKey($maxKey, 'TL', 10);
            $tenTaiLieu = $request->tenTaiLieu;
            $maDanhMuc = $request->maDanhMuc;
            $moTaTaiLieu = $request->moTaTaiLieu;
            $extension = '';
            $fileSize = 0;

            $objDanhMucTaiLieu = MdDanhMucTaiLieu::find($maDanhMuc);
            $maToCongTac = $objDanhMucTaiLieu->ma_to_cong_tac;
            $maTaiLieuMoRong = $objDanhMucTaiLieu->ma_tai_lieu_mo_rong;
            if ( isset($maToCongTac)){
                $thuMuc = MdToCongTac::find($maToCongTac)->thu_muc;
            }else{
                $thuMuc = MdTaiLieuMoRong::find($maTaiLieuMoRong)->thu_muc;
            }


            $path .= $thuMuc;

            if( MdTaiLieu::where('ten_tai_lieu', $tenTaiLieu)->count() > 0){
                return response()->json(['info' => 'fail', 'Content' => 'Tên tài liệu đã tồn tại'], 200);
            }

            $file = $request->file('file');
            if($file)
            {
                $extension =  $file->clientExtension();
                $fileSize = $file->getClientSize();
            }
            $newFileName = time().$file->getClientOriginalName();
            $request->file->move($path,  $newFileName);

            try{
                $fileData = new MdTaiLieu();

                $fileData->ma_tai_lieu = $maTaiLieu;
                $fileData->ten_tai_lieu = $tenTaiLieu;
                $fileData->mo_ta_tai_lieu = $moTaTaiLieu;
                $fileData->ma_danh_muc = $maDanhMuc;
                $fileData->dinh_dang = strtolower($extension);
                $fileData->dung_luong = $fileSize;
                $fileData->lien_ket = 'documents/'.$thuMuc.'/'.$newFileName;
                $fileData->nguoi_dang = $userId;

                $fileData->save();
                return response()->json(['info' => 'success', 'Content' => 'Thêm mới thành công'], 200);
            }catch (QueryException $e){
                return response()->json(['info' => 'fail', 'Content' => 'Thêm mới không thành công. Lỗi hệ thống.'], 200);
            }
        }
    }

    public function validateUploadFile(array $data)
    {
        return Validator::make($data, [
            'file' => 'required|max:102400'
        ]);
    }

    public function fnTraCuuForm(){
        $menuData = $this->getMenuData();
        $userInfo = $this->getUserInfo();

        $layoutData = array(
            'menuData' => $menuData,
            'userInfo' => $userInfo,
        );

        return view('tracuu', $layoutData);
    }

    public function fnTraCuu(Request $request){
        if (Auth::check()){
            $username = Auth::user()->ma_nhan_vien;
            $sql = 'select *, user.ho_ten as nguoi_dang from mst_tai_lieu tl, users user WHERE 1 = 1 and tl.nguoi_dang = user.ma_nhan_vien AND tl.trang_thai = 1';
            if (Auth::user()->phan_quyen != 2){
                $sql .= ' AND ( tl.ma_danh_muc IN (SELECT ma_nhom_quyen FROM mst_phan_quyen where ma_nhan_vien = "'.$username.'" and trang_thai = 1)';
                $sql .= 'OR tl.ma_danh_muc in (select ma_danh_muc from mst_danh_muc_tai_lieu where ma_to_cong_tac in (SELECT ma_nhom_quyen FROM mst_phan_quyen where ma_nhan_vien = "'.$username.'" and trang_thai = 1)))';
            }
            if (isset($request->request->all()['datatable']['tenNhanVien']['generalSearch'])){

                $sql .= " And tl.nguoi_dang in (select ma_nhan_vien from users where ho_ten like  '%". $request->request->all()['datatable']['tenNhanVien']['generalSearch'] ."%')";
            }
            if (isset($request->request->all()['datatable']['tenTaiLieu']['generalSearch'])){
                $sql .= " and tl.ten_tai_lieu like  '%". $request->request->all()['datatable']['tenTaiLieu']['generalSearch'] ."%'";
            }

            $rawResult = DB::select(DB::raw($sql));
            $searchResult = json_encode($rawResult);
            $result ='{ "meta": { "page": 1, "pages": 1, "perpage": -1, "total": '. count($rawResult) .', "sort": "asc", "field": "ma_tai_lieu" }, "data":';
            $result .= $searchResult . '}';
//            $searchResult = json_encode(DB::select(DB::raw($sql)));
//            $result ='{ "meta": { "page": 1, "pages": 1, "perpage": -1, "total": '. count((DB::select(DB::raw($sql)))) .', "sort": "asc", "field": "ma_tai_lieu" }, "data":';
//			//$result ='{ "meta": { "page": 1, "pages": 1, "perpage": -1, "total": '. $searchResult->count() .', "sort": "asc", "field": "ma_tai_lieu" }, "data":';
//            $result .= $searchResult . '}';

//            dd($sql);
            return response($result, 200)->header('Content-Type', 'application/json');
        }else{
            return response('<script> alert("Bạn chưa đăng nhập."); window.history.back()</script>', 200);
        }
    }

    public function capNhatMoTaTaiLieu(Request $request)
    {
        if (Auth::check()) {
            $userId = Auth::user()->ma_nhan_vien;
            try {
                $maTaiLieu = $request->maTaiLieu;
                $moTaTaiLieu = $request->moTaTaiLieu;
                if(MdTaiLieu::where('ma_tai_lieu', $maTaiLieu)->where('nguoi_dang', $userId)->count() > 0 ){
                    $taiLieu = MdTaiLieu::find($maTaiLieu);
                    $taiLieu->mo_ta_tai_lieu = $moTaTaiLieu;
                    $taiLieu->save();
                    return response()->json(['info' => 'success', 'Content' => 'Cập nhật thành công'], 200);
                }else{
                    return response()->json(['info' => 'fail', 'Content' => 'Bạn không có quyền sửa thông tin tài liệu này.'], 200);
                }
            } catch (QueryException $e) {
                return response()->json(['info' => 'fail', 'Content' => 'Cập nhật không thành công. Lỗi hệ thống.'], 200);
            }
        }else{
            return response()->json(['info' => 'fail', 'Content' => 'Bạn chưa đăng nhập'], 200);
        }
    }

    public function capNhatTrangThaiTaiLieu(Request $request)
    {
        if (Auth::check()) {
            $userId = Auth::user()->ma_nhan_vien;
            $file = MdTaiLieu::where('ma_tai_lieu', $request->maTaiLieu)->where('nguoi_dang', $userId)->first();
            try {
                $maTaiLieu = $request->maTaiLieu;
                if(Auth::user()->phan_quyen > 0){
                    if (strtotime(date("Y-m-d H:i:s"))-strtotime($file->ngay_tao) > 86400){
                        return response()->json(['info' => 'fail', 'Content' => 'Bạn không thể xóa tài Liệu tồn tại quá 1 ngày.'], 200);
                    }
                    $taiLieu = MdTaiLieu::find($maTaiLieu);
                    $taiLieu->trang_thai = 0;
                    $taiLieu->save();
                    return response()->json(['info' => 'success', 'Content' => 'Cập nhật thành công'], 200);
                }else{
                    return response()->json(['info' => 'fail', 'Content' => 'Bạn không có quyền xóa tài liệu này.'], 200);
                }
            } catch (QueryException $e) {
                return response()->json(['info' => 'fail', 'Content' => 'Cập nhật không thành công. Lỗi hệ thống.'], 200);
            }
        }else{
            return response()->json(['info' => 'fail', 'Content' => 'Bạn chưa đăng nhập'], 200);
        }
    }

    public function dsDanhMucMoRong($maNhom){
        if (Auth::check() && $this->checkAuth($maNhom)){
        $menuData = $this->getMenuData();
        $userInfo = $this->getUserInfo();
        $taiLieuMoRong = MdTaiLieuMoRong::with(['danhMucTaiLieu'=>function($query){
            $query->where('trang_thai', 1);
        }])->where('ma_tai_lieu_mo_rong', $maNhom)->where('trang_thai', 1)->get();
        $contentData = array(
            'danhMucTaiLieu' => $taiLieuMoRong,
        );
        $layoutData = array(
            'menuData' => $menuData,
            'userInfo' => $userInfo,
            'contentData' => $contentData,
        );
//        dd($taiLieu);

        return view('documentSp', $layoutData);
        }else{
            return response('<script> alert("Bạn không có quyền truy cập vào thư mục này"); window.history.back()</script>', 200);
        }
    }

    public function deleteCategory(Request $request){
        if (Auth::check()){
            $userId = Auth::user()->username;
            $maDanhMuc = $request->maDanhMuc;
            if ( Auth::user()->phan_quyen > 0 ){
                $danhMuc = MdDanhMucTaiLieu::find($maDanhMuc);
                $danhMuc->trang_thai = 0;
                $danhMuc->nguoi_cap_nhat = $userId;
                $danhMuc->save();
                return response()->json(['info' => 'success', 'Content' => 'Xóa danh mục thành công'], 200);
            }else{
                return response()->json(['info' => 'fail', 'Content' => 'Bạn chưa không có quyền xóa danh mục này'], 200);
            }
        }else{
            return response()->json(['info' => 'fail', 'Content' => 'Bạn chưa đăng nhập'], 200);
        }
    }

    public function chiaSeTaiLieu(Request $request){
        if (Auth::check()) {
            $userId = Auth::user()->ma_nhan_vien;
            try {
                $maTaiLieu = $request->maTaiLieu;
                if(MdTaiLieu::where('ma_tai_lieu', $maTaiLieu)->where('nguoi_dang', $userId)->count() > 0 || Auth::user()->phan_quyen > 0){
                    $taiLieu = MdTaiLieu::find($maTaiLieu);
                    $taiLieu->chia_se = true;
                    $taiLieu->save();
                    return response()->json(['info' => 'success', 'Content' => 'Chia sẻ tài liệu thành công'], 200);
                }else{
                    return response()->json(['info' => 'fail', 'Content' => 'Bạn không có quyền chia sẻ tài liệu này.'], 200);
                }
            } catch (QueryException $e) {
                return response()->json(['info' => 'fail', 'Content' => 'Chia sẻ tài liệu không thành công. Lỗi hệ thống.'], 200);
            }
        }else{
            return response()->json(['info' => 'fail', 'Content' => 'Bạn chưa đăng nhập'], 200);
        }
    }

    public function shareDocument(){
        if (Auth::check()){
            $menuData = $this->getMenuData();
            $userInfo = $this->getUserInfo();
            $layoutData = array(
                'dsTruSo' => MdTruSo::get(),
                'menuData' => $menuData,
                'userInfo' => $userInfo,
            );
//        dd($taiLieu);

            return view('shareDocument', $layoutData);
        }else{
            return response('<script> alert("Bạn không có quyền truy cập vào thư mục này"); window.history.back()</script>', 200);
//            return back()->withInput();
        }

    }

    public function loadShareDocument(Request $request){
        if (Auth::check()){
            $sql = 'select *, user.ho_ten as nguoi_dang, (SELECT ten_to_cong_tac FROM mst_to_cong_tac WHERE ma_to_cong_tac = (SELECT ma_to_cong_tac FROM mst_danh_muc_tai_lieu WHERE ma_danh_muc = tl.ma_danh_muc)) as to_cong_tac from mst_tai_lieu tl, users user WHERE 1 = 1 and tl.nguoi_dang = user.ma_nhan_vien AND tl.trang_thai = 1 AND chia_se = 1';
            if (isset($request->request->all()['datatable']['nguoiDang']['generalSearch'])){

                $sql .= " And tl.nguoi_dang in (select ma_nhan_vien from users where ho_ten like  '%". $request->request->all()['datatable']['nguoiDang']['generalSearch'] ."%')";
            }
            if ( isset($request->request->all()['datatable']['maPhongBan'])){

                $sql .= " And tl.ma_danh_muc in (select ma_danh_muc from mst_danh_muc_tai_lieu where substring(ma_to_cong_tac, 1, 6) =  '". $request->request->all()['datatable']['maPhongBan'] ."')";
            }
            if (isset($request->request->all()['datatable']['tenTaiLieu']['generalSearch'])){
                $sql .= " and tl.ten_tai_lieu like  '%". $request->request->all()['datatable']['tenTaiLieu']['generalSearch'] ."%'";
            }
//dd($sql);
            $rawResult = DB::select(DB::raw($sql));
            $searchResult = json_encode($rawResult);
            $result ='{ "meta": { "page": 1, "pages": 1, "perpage": -1, "total": '. count($rawResult) .', "sort": "asc", "field": "ma_tai_lieu" }, "data":';
            $result .= $searchResult . '}';
//            $searchResult = json_encode(DB::select(DB::raw($sql)));
//            $result ='{ "meta": { "page": 1, "pages": 1, "perpage": -1, "total": '. count((DB::select(DB::raw($sql)))) .', "sort": "asc", "field": "ma_tai_lieu" }, "data":';
//			//$result ='{ "meta": { "page": 1, "pages": 1, "perpage": -1, "total": '. $searchResult->count() .', "sort": "asc", "field": "ma_tai_lieu" }, "data":';
//            $result .= $searchResult . '}';

//            dd($sql);
            return response($result, 200)->header('Content-Type', 'application/json');
        }else{
            return response('<script> alert("Bạn chưa đăng nhập."); window.history.back()</script>', 200);
        }
    }
}
