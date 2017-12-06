<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MdTruSo;
use App\MdPhongBan;
use App\MdToCongTac;
use App\MdHinhAnh;
use App\MdThuVienHinhAnh;

class HomeController extends CommonController
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menuData = $this->getMenuData();
        $userInfo = $this->getUserInfo();
        $slider = MdThuVienHinhAnh::with('hinhAnh')->where('slider', 1)->get();
        $layoutData = array(
            'menuData' => $menuData,
            'userInfo' => $userInfo,
            'slider' => $slider,
        );
//        dd($userInfo);
        return view('index', $layoutData);
    }
}
