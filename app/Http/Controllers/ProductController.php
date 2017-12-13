<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/20
 * Time: 22:49
 */

namespace App\Http\Controllers;


use App\Http\Requests\ProductRequest;
use App\Traits\TimeTrait;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\URL;

class ProductController extends Controller
{
    use TimeTrait;
    public function getIndex(Request $request)
    {
        $title = '商品列表';
        $page = $request->input('page', 1);
        $length = $request->input('length', 10);
        $id = $request->input('id');
        $daterange = $request->input('daterange');
        if($daterange) {
            $daterange = $this->get_time_range($daterange);
        }
        $name = $request->input('name');
        $status = $request->input('status');
        $products = Product::whereRaw('1=1');
        if($id) {
            $products = $products->where('id',$id);
        }
        if($daterange) {
            $products = $products->where("created_at", ">", $daterange[0])->where("created_at", "<", $daterange[1]);
        }
        if($name) {
            $products = $products->where('name','like',"%$name%");
        }
        if(isset($status)) {
            $products = $products->where('status',$status);
        }

        $products = $products->orderBy('id','desc')->paginate($length);
        $result = [
            'title' => $title,
            'products' => $products
        ];
        return view('admin.products.list',$result);
    }

    public function getCreate(Request $request)
    {
        $id = $request->input('product_id');
        $product = null;
        if($id) {
            $title = '商品详情';
            $product = Product::find($id);
        } else {
            $title = '添加商品';
        }
        $result = [
            'title' => $title,
            'product_id' => $id,
            'product' => $product
        ];
        return view('admin.products.create',$result);
    }

    public function upload(Request $request)
    {
        $img_name = $request->input('img_name');
        $url = $this->uploadFile($file = $img_name, $directory = "products", true, false);
        if ($url) {
            return Response::json(array("status" => true, "img_url"=>$url));
        }else{
            return Response::json(array("status" => false, "errMsg" => "图片上传失败!"));
        }
    }

    public function createOrUpdate(ProductRequest $productRequest)
    {
        if($productRequest['id']){
            $product = Product::find($productRequest['id']);
            $product->name = $productRequest->input('name');
            $product->image = $productRequest->input('banner');
            $product->status = $productRequest->input('product_status');
            $product->cn_description = $productRequest->input('cn_desc');
            $product->eng_description = $productRequest->input('eng_desc');
            $product->save();
        }else{
            $product = [
                'name' => $productRequest->input('name'),
                'image' => $productRequest->input('banner'),
                'status' => $productRequest->input('product_status'),
                'cn_description' => $productRequest->input('cn_desc'),
                'eng_description' => $productRequest->input('eng_desc')
            ];
            $product = Product::firstOrCreate($product);
        }
        $product_id = $product->id;
        return ['status' => true,'id' => $product_id];
    }

    public function getBatch(Request $request)
    {

    }

    public function batchUpload(Request $request)
    {
        $file = $request->file("file");
        $url = $this->uploadFile($file, $directory = "product_details", true, false);
        $size = $file->getClientSize();
        $filename = $file->getClientOriginalName();
        $original_filename = $filename = trim(pathinfo($filename, PATHINFO_FILENAME));
        return Response::json(
            array(
                "files" => array(
                    array(
                        "name" => $original_filename,
                        "size" => $size,
                        "url" => $url,
                        "thumbnailUrl" => $url,
                        "deleteUrl" => URL::to("/upload/?filename=" . "xx"),
                        "deleteType" => "DELETE"
                    )
                )
            )
        );

//        if ($url) {
//            return Response::json(array("status" => true, "img_url"=>$url));
//        }else{
//            return Response::json(array("status" => false, "errMsg" => "图片上传失败!"));
//        }
    }

    public function test()
    {
        return view('admin.products.test');
    }
}