<?php

namespace App\Http\Controllers;

use App\MdHinhAnh;
use App\MdThuVienHinhAnh;
use Composer\Package\Archiver\ZipArchiver;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use ZipArchive;

class GalleryController extends CommonController
{
    public function getAllGallery(){
        if (Auth::check()) {
            $menuData = $this->getMenuData();
            $galleryList = MdThuVienHinhAnh::with('hinhAnh')->where('trang_thai')->get();
            $contentData = array(
                'galleryList' => $galleryList,
            );
            $layoutData = array(
                'menuData' => $menuData,
                'contentData' => $contentData,
            );
//        dd($taiLieu);

            return view('gallery', $layoutData);
        }else{
            $menuData = $this->getMenuData();
            $layoutData = array(
                'menuData' => $menuData
            );
//        dd($menuData);
            return view('index', $layoutData);
        }
    }

    public function getThuVienHinh(Request $request){
        $tenThuVien = '';
        if (isset($request->request->all()['datatable']['tenThuVienHinh']['generalSearch'])){
            $tenThuVien = $request->request->all()['datatable']['tenThuVienHinh']['generalSearch'];
        }
        $result ='{ "meta": { "page": 1, "pages": 1, "perpage": -1, "total": '.MdThuVienHinhAnh::where('ten_thu_vien', 'like', '%'.$tenThuVien.'%')->where('trang_thai', 1)->count().', "sort": "asc", "field": "ma_tai_lieu" }, "data":';
        $result .= (string)MdThuVienHinhAnh::with('nguoiDang', 'nguoiCapNhat', 'hinhAnh')->where('ten_thu_vien', 'like', '%'.$tenThuVien.'%')->where('trang_thai', 1)->get();
        $result .= '}';

        return response($result, 200)->header('Content-Type', 'application/json');
    }

    public function themMoiGallery(Request $request){
        if (Auth::check()) {
            $userId = Auth::user()->ma_nhan_vien;
            try {
                $danhMuc = new MdThuVienHinhAnh();
                $maxKey = MdThuVienHinhAnh::max('ma_thu_vien');
                $maDanhMuc = $this->createPrimaryKey($maxKey, 'TA');
                $tenDanhMuc = $request->tenGallery;
                if (MdThuVienHinhAnh::where('ten_thu_vien', $tenDanhMuc)->count() > 0){
                    return response()->json(['info' => 'fail', 'Content' => 'Tên thư viện đã tồn tại!'], 200);
                }
                $danhMuc->ma_thu_vien = $maDanhMuc;
                $danhMuc->ten_thu_vien = $tenDanhMuc;
                $danhMuc->trang_thai = 1;
                $danhMuc->nguoi_tao = $userId;
                $danhMuc->save();

                return response()->json(['info' => 'success', 'Content' => 'Cập nhật thành công'], 200);
            } catch (QueryException $e) {
                return response()->json(['info' => 'fail', 'Content' => 'Thêm mới không thành công. Lỗi hệ thống.'], 200);
            }
        }else{
            return response()->json(['info' => 'fail', 'Content' => 'Bạn chưa đăng nhập'], 200);
        }
    }

    public function themMoiGalleryImages(Request $request){
        if (Auth::check()){
            $userId = Auth::user()->ma_nhan_vien;
            $path = 'resources/gallery/';
            $maxKey = '';
            $maHinhAnh = '';
            $tenThuVien = $request->tenThuVien;
            $maThuVien = $request->maThuVien;
            $fileCnt = $request->fileCnt;
            $extension = '';
            $path .= $maThuVien;

            for ($i = 0; $i < $fileCnt; $i++){
                $maxKey = MdHinhAnh::max('ma_hinh_anh');
                $maHinhAnh = $this->createPrimaryKey($maxKey, 'H');
                $fileID = 'file_'.$i;
                $file = $request->file('file_'.$i);
                $extension =  $file->clientExtension();
                $newFileName = time().$file->getClientOriginalName();
                $request->$fileID->move($path,  $newFileName);
                $fileData = new MdHinhAnh();
                $fileData->ma_hinh_anh = $maHinhAnh;
                $fileData->ten_hinh_anh = $tenThuVien;
                $fileData->ma_thu_vien = $maThuVien;
                $fileData->lien_ket = 'gallery/'.$maThuVien.'/'.$newFileName;
                $fileData->dinh_dang = $extension;
                $fileData->nguoi_dang = $userId;
                try{
                    $fileData->save();
                }catch (QueryException $e){
                    return response()->json(['info' => 'fail', 'Content' => 'Xảy ra lỗi khi upload hình.'.$e], 200);
                }
            }

            try{
                MdThuVienHinhAnh::where('ma_thu_vien', $maThuVien)->update(['nguoi_cap_nhat' => $userId, 'ngay_cap_nhat'=>date('Y-m-d H:i:s')]);
                return response()->json(['info' => 'success', 'Content' => 'Thêm mới thành công'], 200);
            }catch (QueryException $e){
                return response()->json(['info' => 'fail', 'Content' => 'Xảy ra lỗi khi upload hình. Lỗi hệ thống.'], 200);
            }
        }else{
            return response()->json(['info' => 'fail', 'Content' => 'Bạn chưa đăng nhập'], 200);
        }
    }

    public function updateGalleryStatus(Request $request){
        if (Auth::check()) {
            $userId = Auth::user()->ma_nhan_vien;
            $maThuVien = $request->galleryId;
            try {
                MdThuVienHinhAnh::where('ma_thu_vien', $maThuVien)->update(['nguoi_cap_nhat' => $userId, 'ngay_cap_nhat' => date('Y-m-d H:i:s'), 'trang_thai'=>0]);
                return response()->json(['info' => 'success', 'Content' => 'Xóa thư viện thành công'], 200);
            } catch (QueryException $e) {
                return response()->json(['info' => 'fail', 'Content' => 'Xảy ra lỗi khi xóa thư viện. Lỗi hệ thống.'.$e], 200);
            }
        } else {
            return response()->json(['info' => 'fail', 'Content' => 'Bạn chưa đăng nhập'], 200);
        }
    }

    public function downloadImageZip($maThuVien){
        $files = glob(resource_path('gallery/'.$maThuVien.'/*'));
        $archiveFile =resource_path('gallery/'.$maThuVien.'/files.zip');
        $archive = new \ZipArchive();
        if ($archive->open($archiveFile, ZipArchive::CREATE | ZipArchive::OVERWRITE)) {
            // loop trough all the files and add them to the archive.
            foreach ($files as $file) {
                if ($archive->addFile($file, basename($file))) {
                    // do something here if addFile succeeded, otherwise this statement is unnecessary and can be ignored.
                    continue;
                } else {
                    throw new Exception("file `{$file}` could not be added to the zip file: " . $archive->getStatusString());
                }
            }

            // close the archive.
            if ($archive->close()) {
                // archive is now downloadable ...
                return response()->download($archiveFile, basename($archiveFile))->deleteFileAfterSend(true);
            } else {
                throw new Exception("could not close zip file: " . $archive->getStatusString());
            }
        } else {
            throw new Exception("zip file could not be created: " . $archive->getStatusString());
        }
    }

    public function showImageGallery($maThuVien){
        if (Auth::check()) {
            $menuData = $this->getMenuData();
            $imageGallery = MdHinhAnh::where('ma_thu_vien', $maThuVien)->get();
//            $gallery = MdThuVienHinhAnh::where('trang_thai', 1)->where('ma_thu_vien', $maThuVien)->get();
            $gallery = MdThuVienHinhAnh::where('trang_thai', 1)->find($maThuVien);
            $contentData = array(
                'imageGallery' => $imageGallery,
                'gallery' => $gallery,
            );
            $layoutData = array(
                'menuData' => $menuData,
                'contentData' => $contentData,
            );
//        dd($contentData);

            return view('gallerySlide', $layoutData);
        }else{
            $menuData = $this->getMenuData();
            $layoutData = array(
                'menuData' => $menuData
            );
            return view('index', $layoutData);
        }
    }
}
