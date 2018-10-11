<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\WidgetItem;
use DB;

class WidgetController extends Controller
{
    public function __construct()
    {
        $this->widgetItemModel = new WidgetItem();
    }

    public function list () {
        $data = array (
            array('name' => "POST", 'key'=> "POST", 'description'=> ""),
            array('name' => "CATEGORY", 'key'=> "CATEGORY", 'description'=> ""),
            array('name' => "TAG", 'key'=> "TAG", 'description'=> ""),
            array('name' => "VIDEO", 'key'=> "VIDEO", 'description'=> ""),
            array('name' => "BANNER", 'key'=> "BANNER", 'description'=> ""),
        );    
        return response()->json($data);
    } 


    public function listWidget () {

        $data = $this->widgetItemModel->select('id', 'key', 'data', 'location', 'sort_by')
                                      ->get();

        return response()->json($data);
    }  

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Backend.Contents.widget.index');
    }

    /**
     * Get Modal 
     *
     * @return \Illuminate\Http\Response
     */
    public function modal($view)
    {   
        return view('Backend.Modals.widget.'.$view);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $this->widgetItemModel->data     = json_encode($request->data);
            $this->widgetItemModel->key      = $request->key;
            $this->widgetItemModel->location = $request->location;
            $this->widgetItemModel->sort_by  = $this->widgetItemModel->where('location', $request->location)->max('sort_by') + 1;
            $this->widgetItemModel->save();
            DB::commit();

            return response()->json(['status' => true, 'widget' => $this->widgetItemModel], 200);
        } catch (Exception $e) {
            DB::rollback();
            return response()->json(['status' => false], 422);
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
        //
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
        DB::beginTransaction();

        $widgetItemModel = $this->widgetItemModel->findOrFail($id);

        try {
            $widgetItemModel->data     = json_encode($request->data);
            $widgetItemModel->save();
            DB::commit();

            return response()->json(['status' => true, 'widget' => $this->widgetItemModel], 200);
        } catch (Exception $e) {
            DB::rollback();
            return response()->json(['status' => false], 422);
        }
    }

    public function sortWidget (Request $request) {
        DB::beginTransaction();
        try {
            foreach ($request->data as $key => $item) {
                if ($item) {
                    $widgetItemModel          = $this->widgetItemModel->find($item['id']);
                    $widgetItemModel->sort_by = $key + 1;
                    $widgetItemModel->save();
                }
            }
            DB::commit();
            return response()->json(['status' => true], 200);
        } catch (Exception $e) {
            DB::rollback();
            return response()->json(['status' => false], 422);
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
        //
    }
}
