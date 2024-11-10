<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\Page;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index() {
    $menus = Menu::whereNull('parent_id')->orderBy('sort')->get();
    $pages = Page::all();

    return view('admin.menus.create', compact('menus','pages'));
    }

public function create() {
    $menus = Menu::whereNull('parent_id')->get();
    return view('admin.menus.create', compact('menus'));
}

    public function store(Request $request) {
        $menus = json_decode($request->menus,1);

  foreach($menus as $key =>$menu){

      if($menu['new']){
          $item = Menu::create([
              'name'=>$menu['name'],
              'name_en'=>$menu['name_en'],
              'link'=>$menu['link'],
              'page_id'=>$menu['page'],
              'type'=>$menu['type'],
                          'is_show_header'=>$menu['show'],
              'sort'=>$key,
              
              
              ]);
              
               
       
      
    
              
      }
    
      if(isset($menu['unsetParent'])){
          
    
          
          
                 $item = Menu::where('id',$menu['id'])->first();
                       try{
                                               $item->update([
              
              'parent_id'=>null,
              'sort'=>$key,

              
              ]);
                       }catch(\Exception $e){
                           dd($e->getMessage());
                       }

    
         
      }
      if($menu['deleted']){
          $item = Menu::where('id',$menu['id'])->first();
            $item->delete();
          
      }
      if(isset($menu['updated'])){
                if($menu['updated']){
                   
          $item = Menu::where('id',$menu['id'])->first();
          $item->update([
              
              'name'=>$menu['name'],
              'link'=>$menu['link'],
                  'page_id'=>$menu['page'],
                            'is_show_header'=>$menu['show'],
              'type'=>$menu['type'],
                'sort'=>$key,
              'name_en'=>$menu['name_en']
              
              ]);
          
      }
      

      }

      if(isset($menu['children'])){
if(!empty(isset($menu['children'][0]))){
         $child = Menu::where('id',$menu['children'][0]['id'])->first();
   
   
        $child->update([
        'parent_id'=>$menu['id'],
     
              
        ]);
        
        
              if(isset($menu['children']['deleted'])){
          $item = Menu::where('id',$menu['children']['id'])->first();
            $item->delete();
          
      }
    
      if(isset($menu['children'][0]['updated'])){
  
                if($menu['children'][0]['updated']){
                    
                   
          $item = Menu::where('id',$menu['children'][0]['id'])->first();
          $item->update([
              
              'name'=>$menu['children'][0]['name'],
              'link'=>$menu['children'][0]['link'],
                  'page_id'=>$menu['children'][0]['page'],
                            'is_show_header'=>$menu['children'][0]['show'],
              'type'=>$menu['children'][0]['type'],
                'sort'=>$key,
              'name_en'=>$menu['children'][0]['name_en']
              
              ]);
          
      }
      

      }
          
          
      } 
}
  


      
  }
  
  foreach($menus as $key =>$menu){
      $menu_exists=Menu::where('id',$menu['id'])->exists();
      if($menu_exists){
                $menu=Menu::where('id',$menu['id'])->first();
      
      
        $menu->update([
          'sort'=>$key
          ]);
      }

  }

        return response()->json(['status'=>200]);
    }

    public function edit(Menu $menu) {
        return view('admin.menus.edit', compact('menu'));
    }



    public function destroy(Menu $menu) {
        $menu->delete();
        return redirect()->route('admin.menus.index');
    }
}
