<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/20
 * Time: 22:35
 */

namespace App\Http\Controllers;


use App\Models\Slide;

class HomeController extends Controller
{
    public function getHomePage()
    {
        $slides = Slide::where('status',1)->get();
        $result = [
            'slides' => $slides
        ];
        return view('website.index',$result);
    }
}