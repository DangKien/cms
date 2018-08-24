<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB, App;
use Illuminate\Validation\Rule;
use App\Libs\Configs\StatusConfig;

use App\Models\Menu;
use App\Models\Category;

class MenuController extends Controller
{
    private $menuModel, $categoryModel;

    public function __construct(Menu $menuModel, Category $category)
    {
        $this->menuModel     = $menuModel;
        $this->categoryModel = $category;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menus      = $this->menuModel->select('name', 'id')->get();
        $categories = $this->categoryModel->select('id', 'parent_id')->get();
        if (request()->has('menu_id') && request()->get('actions') == 'edit') {
            $locale = request()->has('locale') ? request()->get('locale') : App::getLocale();
            $menu   = $this->menuModel->translatedIn($locale)
                                     ->find(request()->get('menu_id'));
            if (empty($menu) ) {
                $menu = array();
            }
            return view('Backend.Contents.menu.index', array('menu' => $menu,
                                                             'menus'=> $menus, 
                                                             'categories'=>$categories));
        }
        return view('Backend.Contents.menu.index', array('menus'=>$menus, 'categories'=>$categories));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->_validateInsert($request);
        DB::beginTransaction();
        try {
            $this->menuModel->name = $request->name;
            $this->menuModel->save();
            DB::commit();
            return response()->json(['id'=>$this->menuModel->id], 200);
        } catch (Exception $e) {
            DB::rollback();
            return response()->json(['status'=>true], 422);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->_validateInsert($request);
        DB::beginTransaction();
        $menuModel = $this->menuModel->findOrFail($id);
        try {
            $menuModel->name = $request->name;
            $menuModel->save();
            DB::commit();
            return response()->json(['id'=>$menuModel->id], 200);
        } catch (Exception $e) {
            DB::rollback();
            return response()->json(['status'=>true], 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        $menuModel = $this->menuModel->findOrFail($id);
        try {
            $menuModel->delete();
            $menuModel->deleteTranslations();
            DB::commit();
            return response()->json(['status'=>true], 200);
        } catch (Exception $e) {
            DB::rollback();
            return response()->json(['status'=>false], 422);
        }
    }

    /**
     * Update detail menu specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateDetail ($id, Request $request) {
        DB::beginTransaction();
        $menuModel = $this->menuModel->findOrFail($id);
        try {
            $menuModel->location = $request->menu_location;
            $data                = $this->_menuUrl($request->data);
            $menuModel->translateOrNew($request->locale)->data_menu  = json_encode($data);
            $menuModel->save();
            DB::commit();
            return response()->json(['status'=>true], 200);
        } catch (Exception $e) {
            DB::rollback();
            return response()->json(['status'=>false], 422);
        }
    }

    /**
     * foreach add url for each item menu.
     *
     * @param  int  $data: menu array
     * @return \Illuminate\Http\Response
     */

    public function _menuUrl ($data) {
       $arrMenu = array();
       foreach ($data as $menuItem) {
           if ($menuItem['type'] == "Category") {
               if ($recordCategory = $this->categoryModel::find($menuItem['menuId']) ) {
                  $menuItem['link'] = route('category', [$recordCategory->id, $recordCategory->slug]);
               }
           }
           if (isset($menuItem['children'])) {
               $children = $this->_menuUrl($menuItem['children']);
               if ($children) {
                   $menuItem['children'] = $children;
               }
           }
           $arrMenu[] = $menuItem;
       }
       return $arrMenu;
    }

    public function _validateInsert($request) {
        $rules = array(
                'name'    => 'between:1,255',
            );
        $messages = array();
        $attribute = array(
            'name'    => trans('backend.menu.name')
        );

        $this->validate($request, $rules, $messages, $attribute);
    }
}
