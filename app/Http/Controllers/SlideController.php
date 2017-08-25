<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/15
 * Time: 20:47
 */

namespace App\Http\Controllers;


use App\Http\Requests\SlideRequest;
use App\Models\Slide;
use App\Traits\TimeTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class SlideController extends Controller
{
    use TimeTrait;
    public function getIndex(Request $request)
    {
        $title = 'Slides列表';
        $page = $request->input('page', 1);
        $length = $request->input('length', 10);
        $id = $request->input('id');
        $daterange = $request->input('daterange');
        if($daterange) {
            $daterange = $this->get_time_range($daterange);
        }
        $name = $request->input('name');
        $status = $request->input('status');
        $slides = Slide::whereRaw('1=1');
        if($id) {
            $slides = $slides->where('id',$id);
        }
        if($daterange) {
            $slides = $slides->where("created_at", ">", $daterange[0])->where("created_at", "<", $daterange[1]);
        }
        if($name) {
            $slides = $slides->where('name','like',"%$name%");
        }
        if(isset($status)) {
            $slides = $slides->where('status',$status);
        }

        $slides = $slides->orderBy('id','desc')->paginate($length);
        $result = [
            'title' => $title,
            'slides' => $slides
        ];
        return view('admin.slides.index',$result);
    }

    public function getCreate(Request $request)
    {
        $id = $request->input('slide_id');
        $slide = null;
        if($id) {
            $title = 'Slide详情';
            $slide = Slide::find($id);
        } else {
            $title = '新建Slide';
        }
        $result = [
            'title' => $title,
            'slide_id' => $id,
            'slide' => $slide
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

    public function createOrUpdate(SlideRequest $slideRequest)
    {
        if($slideRequest['id']){
            $slide = Slide::find($slideRequest['id']);
            $slide->name = $slideRequest->input('name');
            $slide->image = $slideRequest->input('banner');
            $slide->status = $slideRequest->input('slide_status');
            $slide->title = $slideRequest->input('title');
            $slide->cn_description = $slideRequest->input('cn_desc');
            $slide->eng_description = $slideRequest->input('eng_desc');
            $slide->save();
        }else{
            $slide = [
                'name' => $slideRequest->input('name'),
                'image' => $slideRequest->input('banner'),
                'status' => $slideRequest->input('slide_status'),
                'title' => $slideRequest->input('title'),
                'cn_description' => $slideRequest->input('cn_desc'),
                'eng_description' => $slideRequest->input('eng_desc')
            ];
            $slide = Slide::firstOrCreate($slide);
        }
        $slide_id = $slide->id;
        return ['status' => true,'id' => $slide_id];
    }
}