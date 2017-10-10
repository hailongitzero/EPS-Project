<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MdTruSo;
use Illuminate\Support\Facades\Auth;

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

    public function createPrimaryKey($oldKey, $prefix){
        $prefixLength = strlen($prefix);
        $keyNum = substr($oldKey, $prefixLength, (strlen($oldKey)-$prefixLength));
        $newNum = (int)$keyNum + 1;
        $newKey = $prefix;
        $zero = strlen($keyNum) - strlen($newNum);
        for ($i = 0; $i < $zero; $i++){
            $newKey .= '0';
        }

        $newKey .= $newNum;
        return $newKey;

    }
}
