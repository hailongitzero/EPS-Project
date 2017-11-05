<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MdTruSo;
use App\MdPhongBan;
use App\MdToCongTac;

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
        $layoutData = array(
            'menuData' => $menuData
        );
//        dd($menuData);
        return view('index', $layoutData);
    }
}
