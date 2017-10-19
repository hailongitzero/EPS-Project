<?php

namespace App\Http\Controllers;

use App\MdThuVienHinhAnh;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            $menuData = MdTruSo::with('phongBan.toCongTac')->get();
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
        $result .= (string)MdThuVienHinhAnh::with('nguoiDang', 'hinhAnh')->where('ten_thu_vien', 'like', '%'.$tenThuVien.'%')->where('trang_thai', 1)->get();
        $result .= '}';

        return response($result, 200)->header('Content-Type', 'application/json');
    }
}
