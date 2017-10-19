<?php

namespace App\Http\Controllers;

use App\MdToCongTac;
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
        $danhMuc = MdDanhMucTaiLieu::with('taiLieu')->where('ma_to_cong_tac', $maTo)->get();
        $menuData = MdTruSo::with('phongBan.toCongTac')->get();
        $toCongTac = MdToCongTac::with('danhMucTaiLieu')->where('ma_to_cong_tac', $maTo)->get();
        $taiLieu = MdTaiLieu::with('tacGia')->get();
        $contentData = array(
            'toCongTac' => $toCongTac,
            'taiLieu' => $taiLieu,
        );
        $layoutData = array(
            'menuData' => $menuData,
            'contentData' => $contentData,
        );
//        dd($taiLieu);

        return view('document', $layoutData);
    }

    public function themMoiDanhMuc(Request $request)
    {
        if (Auth::check()) {
            $userId = Auth::user()->ma_nhan_vien;
            try {
                $danhMuc = new MdDanhMucTaiLieu();
                $maxKey = MdDanhMucTaiLieu::max('ma_danh_muc');
                $maDanhMuc = $this->createPrimaryKey($maxKey, 'DM');
                $danhMuc->ma_danh_muc = $maDanhMuc;
                if (isset($request->tenDanhMuc)) {
                    $danhMuc->ten_danh_muc = $request->tenDanhMuc;
                }
                if (isset($request->maTo)) {
                    $danhMuc->ma_to_cong_tac = $request->maTo;
                }
                $danhMuc->trang_thai = 1;
                $danhMuc->nguoi_cap_nhat = $userId;
                $danhMuc->save();

                return response()->json(['info' => 'success', 'Content' => 'Cập nhật thành công'], 200);
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
            $result ='{ "meta": { "page": 1, "pages": 1, "perpage": -1, "total": '.MdTaiLieu::with('tacGia')->where('ma_danh_muc', $maDanhMuc)->where('ten_tai_lieu', 'like', '%'.$tenTaiLieu.'%')->count().', "sort": "asc", "field": "ma_tai_lieu" }, "data":';
            $result .= (string)MdTaiLieu::with('tacGia')->where('ma_danh_muc', $maDanhMuc)->where('ten_tai_lieu', 'like', '%'.$tenTaiLieu.'%')->get();
            $result .= '}';
        }else{
            $result ='{ "meta": { "page": 1, "pages": 1, "perpage": -1, "total": '.MdTaiLieu::where('ma_danh_muc', $maDanhMuc)->count().', "sort": "asc", "field": "ma_tai_lieu" }, "data":';
            $result .= (string)MdTaiLieu::with('tacGia')->where('ma_danh_muc', $maDanhMuc)->get();
            $result .= '}';
        }
//dd($result);
        $result2 = '{ "data": '.(string)MdTaiLieu::where('ma_danh_muc', $maDanhMuc)->get().'}';

        return response($result, 200)->header('Content-Type', 'application/json');
    }

    public function dsTaiLieuTheoDanhMucTo($maTo, $maDanhMuc){
        $danhMuc = MdDanhMucTaiLieu::with('taiLieu')->where('ma_to_cong_tac', $maTo)->get();
        $menuData = MdTruSo::with('phongBan.toCongTac')->get();
        $toCongTac = MdToCongTac::with('danhMucTaiLieu')->where('ma_to_cong_tac', $maTo)->get();
        $contentData = array(
            'toCongTac' => $toCongTac,
        );
        $layoutData = array(
            'menuData' => $menuData,
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
            $maTaiLieu = $this->createPrimaryKey($maxKey, 'TL');
            $tenTaiLieu = $request->tenTaiLieu;
            $maDanhMuc = $request->maDanhMuc;
            $moTaTaiLieu = $request->moTaTaiLieu;
            $extension = '';
            $fileSize = 0;

            $toCongTac = MdDanhMucTaiLieu::find($maDanhMuc)->toCongTac;
            $thuMuc = $toCongTac->thu_muc;

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
        $menuData = MdTruSo::with('phongBan.toCongTac')->get();

        $layoutData = array(
            'menuData' => $menuData,
//            'contentData' => $contentData,
        );

        return view('tracuu', $layoutData);
    }
    public function fnTraCuu(Request $request){

//        dd($request->request->all());
//        if (isset($request->request->all()['datatable']['tenNhanVien']['generalSearch']) && isset($request->request->all()['datatable']['tenTaiLieu']['generalSearch'])){
//            $tenNhanVien = $request->request->all()['datatable']['tenNhanVien']['generalSearch'];
//            $tenTaiLieu = $request->request->all()['datatable']['tenTaiLieu']['generalSearch'];
//            $result ='{ "meta": { "page": 1, "pages": 1, "perpage": -1, "total": '.MdTaiLieu::with(['tacGia'=>function($query) use ($tenNhanVien){$query->where('ho_ten', 'like', '%'.$tenNhanVien.'%');}])->where('ten_tai_lieu', 'like', '%'.$tenTaiLieu.'%')->count().', "sort": "asc", "field": "ma_tai_lieu" }, "data":';
//            $result .= (string)MdTaiLieu::with(['tacGia'=>function($query) use ($tenNhanVien){$query->where('ho_ten', 'like', '%'.$tenNhanVien.'%');}])->where('ten_tai_lieu', 'like', '%'.$tenTaiLieu.'%')->get() . '}';
//        } elseif (isset($request->request->all()['datatable']['tenNhanVien']['generalSearch'])){
//            $tenNhanVien = $request->request->all()['datatable']['tenNhanVien']['generalSearch'];
//            $result ='{ "meta": { "page": 1, "pages": 1, "perpage": -1, "total": '.MdTaiLieu::with(['tacGia'=>function($query, $tenNhanVien){$query->where('ho_ten', 'like', '%'.$tenNhanVien.'%');}])->count().', "sort": "asc", "field": "ma_tai_lieu" }, "data":';
//            $result .= (string)MdTaiLieu::with(['tacGia'=>function($query) use ($tenNhanVien){$query->where('ho_ten', 'like', '%'.$tenNhanVien.'%');}])->get() . '}';
//        } elseif (isset($request->request->all()['datatable']['tenTaiLieu']['generalSearch'])){
//            $tenTaiLieu = $request->request->all()['datatable']['tenTaiLieu']['generalSearch'];
//            $result ='{ "meta": { "page": 1, "pages": 1, "perpage": -1, "total": '.MdTaiLieu::with('tacGia')->where('ten_tai_lieu', 'like', '%'.$tenTaiLieu.'%')->count().', "sort": "asc", "field": "ma_tai_lieu" }, "data":';
//            $result .= (string)MdTaiLieu::with('tacGia')->where('ten_tai_lieu', 'like', '%'.$tenTaiLieu.'%')->get() . '}';
//        }else{
//            $result ='{ "meta": { "page": 1, "pages": 1, "perpage": -1, "total": '. MdTaiLieu::with('tacGia')->count() .', "sort": "asc", "field": "ma_tai_lieu" }, "data":';
//            $result .= (string)MdTaiLieu::with('tacGia')->get() . '}';
//        }

        $sql = 'select *, user.ho_ten as nguoi_dang from mst_tai_lieu tl, users user WHERE 1 = 1 and tl.nguoi_dang = user.ma_nhan_vien';
        if (isset($request->request->all()['datatable']['tenNhanVien']['generalSearch'])){
            $sql .= " and tl.nguoi_dang in (select ma_nhan_vien from users where ho_ten like  '%". $request->request->all()['datatable']['tenNhanVien']['generalSearch'] ."%')";
        }
        if (isset($request->request->all()['datatable']['tenTaiLieu']['generalSearch'])){
            $sql .= " and tl.ten_tai_lieu like  '%". $request->request->all()['datatable']['tenTaiLieu']['generalSearch'] ."%'";
        }
        $searchResult = json_encode(DB::select(DB::raw($sql)));
        $result ='{ "meta": { "page": 1, "pages": 1, "perpage": -1, "total": '. sizeof($searchResult) .', "sort": "asc", "field": "ma_tai_lieu" }, "data":';
        $result .= $searchResult . '}';

        return response($result, 200)->header('Content-Type', 'application/json');
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
}
