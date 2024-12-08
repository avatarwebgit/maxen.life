<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\Page;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index(Request $request)
    {
        // زبان پیش‌فرض یا زبان درخواست
        $language = $request->header('Accept-Language', 'en');

        // بازیابی منوها
        $menus = Menu::whereIn('is_show_header',[2,3])->orderBy('sort')->get();

        // قالب‌بندی بر اساس زبان
        $result = $menus->map(function ($menu) use ($language) {

            if ($menu->type == 'link'){
                $menu_url = $menu->link;
            }
//            if ($menu->type == 'product'){
//                $menu_url = $menu->link;
//            }
            if ($menu->type == 'page'){
                $page = Page::where('id',$menu->page_id)->first();
                $menu_url = route('home.page',['page'=>$page->alias]);
            }

            if(!$menu->children->isEmpty()){
                $children = [];
                foreach($menu->children as $child){
                    if ($child->type == 'link'){
                        $child_url = $child->link;
                    }
                    if ($child->type == 'product'){
                        $child_url = $child->link;
                    }
                    if ($child->type == 'page'){
                        $page = Page::where('id',$child->page_id)->first();
                        $child_url = route('home.page',['page'=>$page->alias]);
                    }

                    $children[] = [
                        'id' => $child->id,
                        'title' => $language === 'fa' ? $child->name : $child->name_en,
                        'url' => $child_url ?? null,
                        'parent_id' => $child->parent_id,
                        'position' => $child->sort,

                    ];
                }
            }
            return [
                'id' => $menu->id,
                'title' => $language === 'fa' ? $menu->name : $menu->name_en,
                'url' => $menu_url ?? null,
                'parent_id' => $menu->parent_id,
                'position' => $menu->sort,
                'children'=>$children ?? null
            ];
        });

        return response()->json($result);
    }
}
