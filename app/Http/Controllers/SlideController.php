<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/15
 * Time: 20:47
 */

namespace App\Http\Controllers;


use App\Models\Slide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class SlideController extends Controller
{
    public function getIndex(Request $request)
    {
        $title = 'Slides列表';
        $page = $request->input('page', 1);
        $length = $request->input('length', 10);
        $slides = Slide::orderBy('id','desc')->paginate($length);
        $result = [
            'title' => $title,
            'slides' => $slides
        ];
        return view('admin.slides.index',$result);
    }

    public function getCreate(Request $request)
    {
        $id = $request->input('slide_id');
        if($id) {
            $title = 'Slide详情';
        } else {
            $title = '新建Slide';
        }
        $result = [
            'title' => $title
        ];
        return view('admin.slides.create',$result);
    }

    public function upload(Request $request)
    {
        $img_name = $request->input('img_name');
        $url = $this->uploadFile($file = $img_name, $directory = "slides", true, false);
        if ($url) {
            return Response::json(array("status" => true, "img_url"=>$url));
        }else{
            return Response::json(array("status" => false, "errMsg" => "图片上传失败!"));
        }
    }
}