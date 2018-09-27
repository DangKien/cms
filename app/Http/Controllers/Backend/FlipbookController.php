<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Flipbook;
use DB;
use Illuminate\Support\Str;
use Zipper;
use App\Libs\Configs\StatusConfig;

class FlipbookController extends Controller
{
    public function __construct(Flipbook $flipbook)
    {
        $this->flipbookModel = $flipbook;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Backend.Contents.flipbook.index');
    }

    /**
     * Get a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list(Request $request)
    {
        $order   = $request->input('orderName', 'id');
        $orderBy = $request->input('orderBy', 'desc');
        
        $flipbook   = $this->flipbookModel->filterFreeText($request->freetext)
                                        ->buildCond()
                                        ->orderBy($order, $orderBy)
                                        ->paginate(10);
                               
           return response()->json($flipbook);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sort_by = $this->flipbookModel->select('sort_by')
                                        ->orderBy('sort_by', 'asc')
                                        ->get();

        return view('Backend.Contents.flipbook.add', array('sort_bys'=>$sort_by));
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

            $path = Str::random(40);
            Zipper::make(public_path($request->url_magazine))->extractTo('flipbooks/'.$path);

            _updateSortBy($this->flipbookModel, $request->sort_by, -1);
            $this->flipbookModel->title = $request->title;
            $this->flipbookModel->slug = slugTitle($request->title);
            $this->flipbookModel->status = $request->status;
            $this->flipbookModel->url_image = $request->url_image;
            $this->flipbookModel->url_flipbook = '/flipbooks/'.$path;
            $this->flipbookModel->sort_by    = $request->sort_by;
            $this->flipbookModel->meta_title = $request->meta_title;
            $this->flipbookModel->meta_content = $request->meta_content;
            $this->flipbookModel->meta_description = $request->meta_description;
            $this->flipbookModel->save();

            DB::commit();
            return redirect()->route('magazines.index')->with('magazine', trans('backend.magazine.success'));
        } catch (Exception $e) {
            DB::rollback();
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
        $sort_by = $this->flipbookModel->select('sort_by')
                                        ->orderBy('sort_by', 'asc')
                                        ->get();

        $magazine = $this->flipbookModel->findOrFail($id);

        return view('Backend.Contents.flipbook.add', array('sort_bys' => $sort_by, 'magazine' => $magazine ));
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
        $this->_validateUpdate($request);
        $flipbook = $this->flipbookModel->findOrFail($id);
        DB::beginTransaction();
        try {
            if (!empty($request->url_flipbook)) {
                $path = Str::random(40);
                Zipper::make(public_path($request->url_flipbook))->extractTo('flipbooks/'.$path);
                $path = 'flipbooks/'.$path;
            } else {
                $path = $flipbook->url_flipbook;
            }
            _updateSortBy($flipbook, $request->sort_by, $flipbook->sort_by);
            $flipbook->title = $request->title;
            $flipbook->slug = slugTitle($request->title);
            $flipbook->status = $request->status;
            $flipbook->url_image = $request->url_image;
            $flipbook->url_flipbook = $path;
            $flipbook->sort_by    = $request->sort_by;
            $flipbook->meta_title = $request->meta_title;
            $flipbook->meta_content = $request->meta_content;
            $flipbook->meta_description = $request->meta_description;
            $flipbook->save();
            DB::commit();
            return redirect()->route('magazines.index')->with('magazine', trans('backend.magazine.success'));
        } catch (Exception $e) {
            DB::rollback();
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
        $flipbook = $this->flipbookModel::findOrFail($id);
        DB::beginTransaction();
        try {
            if ($flipbook->status == StatusConfig::CONST_AVAILABLE) {
                $flipbook->status = StatusConfig::CONST_DISABLE;
                $flipbook->save();
            } else {
                $flipbook->delete();
            }
            DB::commit();
            return response()->json(['status' => true], 200);
        } catch (Exception $e) {
            DB::rollback();
            return response()->json(['status' => false], 422);
        }
    }

    /**
     * Remove multi the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyMulti (Request $request)
    {
        $ids = $request->ids;
        DB::beginTransaction();
        try {
            
            foreach ($ids as $id) {
                $flipbook = $this->flipbookModel::find($id);
                if ($flipbook->status == StatusConfig::CONST_AVAILABLE) {
                    $flipbook->status = StatusConfig::CONST_DISABLE;
                    $flipbook->save();
                } else {
                    $flipbook->delete();
                }
            }
            DB::commit();
            return response()->json(['status' => false], 200);
        } catch (Exception $e) {
            DB::rollback();
            return response()->json(['status' => false], 422);
        }
    }

    public function _validateInsert($request) {
        $this->validate($request, array(
            'title'       => 'required|between:1,500',
            // 'description' => 'between:0,1000',
            'url_image'   => 'required',
            'url_magazine'   => 'required',
            'status'      => 'required'
        ), array() );
    }

    public function _validateUpdate($request) {
        $this->validate($request, array(
            'title'       => 'required|between:1,500',
            // 'description' => 'between:0,1000',
            'url_image'   => 'required',
            'status'      => 'required'
        ), array() );
    }
}
