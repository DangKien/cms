<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WidgetController extends Controller
{
    public function __construct()
    {
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
        //
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
        //
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
