<?php

namespace App\Http\Controllers;

use App\MdToCongTac;
use Illuminate\Http\Request;
use App\MdDanhMucTaiLieu;
use App\MdTaiLieu;
use App\MdTruSo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
        $maDanhMuc = $request->request->all()['datatable']['maDanhMuc'];
        $maDanhMuc = '';
        $tenTaiLieu = '';
        if (isset($request->request->all()['datatable']['maDanhMuc'])){
            $maDanhMuc = $request->request->all()['datatable']['maDanhMuc'];
        }
        if (isset($request->request->all()['datatable']['tenTaiLieu']['generalSearch'])){
            $tenTaiLieu = $request->request->all()['datatable']['tenTaiLieu']['generalSearch'];
            $result ='{ "meta": { "page": 1, "pages": 1, "perpage": -1, "total": '.MdTaiLieu::where('ma_danh_muc', $maDanhMuc)->count().', "sort": "asc", "field": "ma_tai_lieu" }, "data":';
            $result .= (string)MdTaiLieu::where('ma_danh_muc', $maDanhMuc)->where('ten_tai_lieu', 'like', '%'.$tenTaiLieu.'%')->get();
            $result .= '}';
        }else{
            $result ='{ "meta": { "page": 1, "pages": 1, "perpage": -1, "total": '.MdTaiLieu::where('ma_danh_muc', $maDanhMuc)->count().', "sort": "asc", "field": "ma_tai_lieu" }, "data":';
            $result .= (string)MdTaiLieu::where('ma_danh_muc', $maDanhMuc)->get();
            $result .= '}';
        }

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
}
