<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/20
 * Time: 23:50
 */

namespace App\Http\Controllers;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Models\CategoryMap;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CategoryController extends Controller
{
    public function getCategoryTree(Request $request)
    {
        $tree_data = $this->tree_data();
        $result = [
            'tree_data' => $tree_data
        ];
        return view('admin.categories.categories',$result);
    }

    /**
     * 分类树
     * @param int $version
     * @return array
     */
    private function tree_data()
    {
        // TODO:sort
        $categories = Category::All();
        $json_data = [];

        $ids = $categories->pluck('id');
        $category_ids = [];
        foreach ($ids as $id) {
            $category_ids[] = $id;
        }
        foreach ($categories as $index => $category) {
            $parent_id = $category->parent_id;
            if ($parent_id) {
                if (!in_array($parent_id, $category_ids)) {
                    Log::warning("Parent($parent_id) for category($category->id) does not exist");
                    continue;
                }
            }
            $json_data[] = [
                'id' => $category->id,
                'text' => $category->name,
                'parent' => $category->parent_id ?: "#",
                'a_attr' => [
                    'href' => route('create_category').'?category_id='.$category->id,
                ],
            ];
        }
        return $json_data;
    }

    public function getCreate(Request $request)
    {
        $id = $request->input('category_id');
        $parent_id = $request->input('parent_id');
        $category = null;
        $category_names = [];
        if($id) {
            $title = '分类详情';
            $category = Category::find($id);
            $category_names = $category->getParentCategory($category,$category_names);
            array_unshift($category_names,$category->name);
            krsort($category_names);
            $category_names = implode('>',$category_names);
        } else {
            $title = '添加分类';
        }
        $result = [
            'title' => $title,
            'category_id' => $id,
            'category' => $category,
            'parent_id' => $parent_id,
            'category_names' => $category_names
        ];
        return view('admin.categories.create',$result);
    }

    public function createOrUpdate(CategoryRequest $categoryRequest)
    {
        if($categoryRequest['id']){
            $category = Category::find($categoryRequest['id']);
            $category->name = $categoryRequest->input('name');
            $category->parent_id = $categoryRequest->input('parent_id');
            $category->eng_name = $categoryRequest->input('eng_name');
            $category->save();
        }else{
            $category = [
                'name' => $categoryRequest->input('name'),
                'eng_name' => $categoryRequest->input('eng_name'),
                'parent_id' => $categoryRequest->input('parent_id')
            ];
            $category = Category::firstOrCreate($category);
        }
        $category_id = $category->id;
        return ['status' => true,'id' => $category_id];
    }

    /**
     * 可添加的商品
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function chooseProducts(Request $request)
    {
        $category_id = $request->input('category_id');
        $page = $request->input('page', 1);
        $length = $request->input('length', 10);
        if($category_id) {
            $current_category = Category::find($category_id);
            $products = $current_category->canChooseProducts()->paginate($length);
            $result = [
                'title' => '添加商品至分类',
                'products' => $products,
                'category_id' => $category_id
            ];
            return view('admin.categories.choose_products',$result);
        } else {
            abort(404);
        }
    }

    /**
     * 已添加的商品
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function chosenProducts(Request $request)
    {
        $category_id = $request->input('category_id');
        $page = $request->input('page', 1);
        $length = $request->input('length', 10);
        if($category_id) {
            $current_category = Category::find($category_id);
            $products = $current_category->products()->paginate($length);
            $result = [
                'title' => '已添加到该分类的商品',
                'products' => $products,
                'category_id' => $category_id
            ];
            return view('admin.categories.chosen_products',$result);
        } else {
            abort(404);
        }
    }

    public function addProducts(Request $request)
    {
        $category_id = $request->input('category_id');
        $ids = $request->input('ids');
        $status = true;
        $msg = '';
        foreach ($ids as $product_id) {
            $map = CategoryMap::where('category_id',$category_id)->where('product_id',$product_id)->first();
            if($map) {
                $status = false;
                $product = Product::find($product_id);
                $msg = "商品".$product->name."已经在该分类里了，请刷新页面后重新选择商品添加!";
                break;
            } else {
                $map = new CategoryMap();
                $map->category_id = $category_id;
                $map->product_id = $product_id;
                $map->save();
            }
        }
        return ['status' => $status,'msg' => $msg,'id' => $category_id];
    }

    public function deleteProducts(Request $request)
    {
        $category_id = $request->input('category_id');
        $ids = $request->input('ids');
        $status = true;
        $msg = '';
        foreach ($ids as $product_id) {
            $map = CategoryMap::where('category_id',$category_id)->where('product_id',$product_id)->first();
            if($map) {
                $map->delete();
            } else {
                $status = false;
                $product = Product::find($product_id);
                $msg = "商品".$product->name."在该分类删除了，请刷新页面后重新选择!";
                break;
            }
        }
        return ['status' => $status,'msg' => $msg,'id' => $category_id];
    }
}