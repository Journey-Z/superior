<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/20
 * Time: 23:50
 */

namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CategoryController extends Controller
{
    public function getCategoryTree(Request $request)
    {
//        $tree_data = '[{"id":842,"text":"Baby & Toddlers","parent":"#","a_attr":{"href":"http:\/\/oms.patpat.org\/admin\/category\/product\/842\/edit"}},{"id":843,"text":"Baby & Toddler Girl","parent":842,"a_attr":{"href":"http:\/\/oms.patpat.org\/admin\/category\/product\/843\/edit"}}]';
//        $tree_data = json_decode($tree_data,true);
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
        foreach ($categories as $index => $category) {
            $parent_id = $category->parent_id;
            if ($parent_id) {
                if (!in_array($parent_id, $ids)) {
                    Log::warning("Parent($parent_id) for category($category->id) does not exist");
                    continue;
                }
            }
            $json_data[] = [
                'id' => $category->id,
                'text' => $category->name,
                'parent' => $category->parent_id ?: "#",
                'a_attr' => [
                    'href' => "#",
                ],
            ];
        }
        return $json_data;
    }
}