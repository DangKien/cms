<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Libs\Configs\StatusConfig;
use DB, App, Auth, Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use App\Models\NewModel;
use App\Models\Category;
use App\Models\Language;

class NewController extends Controller
{
    private $newModel, $categoryModel, $languageModel;
    public function __construct(NewModel $new, Category $category, Language $language)
    {
        $this->newModel     = $new;
        $this->categoryModel = $category;
        $this->languageModel = $language;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Backend.Contents.new.index');
    }

    public function list(Request $request) {
        $orderName = $request->input('orderName', 'id');
        $orderBy   = $request->input('orderBy', 'desc');

        $news = $this->newModel
                    ->select('news.id', 'title', 'view', 'vote', 'status', 'tag', 'hot', 'prioritize', 'user_create')
                    ->join('new_translation as t', 't.new_id', '=', 'news.id')
                    ->where('locale', App::getLocale())
                    ->orderBy($orderName, $orderBy)
                    ->with(['translations' => function ($query) {
                        $query->select('title', 'id', 'new_id', 'description', 'locale');
                    }])
                    ->with(['user_creates'=> function ($query) {
                        $query->select('id', 'email', 'name');
                    }])
                    ->with(['categories'=>function ($query) {
                        // $query->select('id');
                    }])
                    ->paginate(10);

        return response()->json($news);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = $this->categoryModel->get();
        return view('Backend.Contents.new.add', array('categories' => $categories));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        $request->flash();
        $this->_validateInsert($request);
        DB::beginTransaction();
        $languages = $this->languageModel::where('status', StatusConfig::CONST_AVAILABLE)
                                      ->get(); 
 
        try {
            $this->newModel->status      = $request->status;
            $this->newModel->url_image   = $request->url_image;
            $this->newModel->user_create = Auth::user()->id;
            $this->newModel->save();

            foreach ($languages as $key => $language) {
                $this->newModel->translateOrNew($language->locale)->title            = $request->title[$language->id];
                $this->newModel->translateOrNew($language->locale)->description      = $request->description[$language->id];
                $this->newModel->translateOrNew($language->locale)->slug             = slugTitle($request->name[$language->id]);
                $this->newModel->translateOrNew($language->locale)->content          = $request->content[$language->id];
                $this->newModel->translateOrNew($language->locale)->tag              = $request->tag[$language->id];
                $this->newModel->translateOrNew($language->locale)->meta_title       = $request->meta_title[$language->id];
                $this->newModel->translateOrNew($language->locale)->meta_description = $request->meta_description[$language->id];
                $this->newModel->translateOrNew($language->locale)->meta_content     = $request->meta_content[$language->id];
                $this->newModel->save();
            }
            $this->newModel->categories()->sync($request->categories);
            DB::commit();
            return redirect()->route('news.index')->with('new', 'success');
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
        $categories = $this->categoryModel->get();
        $new        = $this->newModel->with('user_creates')
                                    ->with('categories')
                                    ->findOrFail($id);

        foreach ($new->categories as $new_category) {
            $arrayCategory[] =  $new_category->id;
        }

        $new->categories = $arrayCategory;

        return view('Backend.Contents.new.add', array('categories' => $categories, 'new'=>$new));
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
        $request->flash();
        $this->_validateInsert($request);
        DB::beginTransaction();
        $languages = $this->languageModel::where('status', StatusConfig::CONST_AVAILABLE)
                                      ->get(); 
        $newModel = $this->newModel->findOrFail($id);
        try {
            $newModel->status    = $request->status;
            $newModel->url_image = $request->url_image;
            $newModel->save();

            foreach ($languages as $key => $language) {
                $newModel->translateOrNew($language->locale)->title            = $request->title[$language->id];
                $newModel->translateOrNew($language->locale)->description      = $request->description[$language->id];
                $newModel->translateOrNew($language->locale)->slug             = slugTitle($request->title[$language->id]);
                $newModel->translateOrNew($language->locale)->content          = $request->content[$language->id];
                $newModel->translateOrNew($language->locale)->tag              = $request->tag[$language->id];
                $newModel->translateOrNew($language->locale)->meta_title       = $request->meta_title[$language->id];
                $newModel->translateOrNew($language->locale)->meta_description = $request->meta_description[$language->id];
                $newModel->translateOrNew($language->locale)->meta_content     = $request->meta_content[$language->id];
                $newModel->save();
            }
            $newModel->categories()->sync($request->categories);
            DB::commit();
            return redirect()->route('news.index')->with('new', 'success');
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
        DB::beginTransaction();
        try {
            $newModel = $this->newModel->findOrFail($id);
            if ($newModel->status == StatusConfig::CONST_AVAILABLE) {
                return response()->json(['status' => false], 422);
            }
            $newModel->delete();
            $newModel->deleteTranslations();
            $newModel->categories()->detach();
            $newModel->save();
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
    public function destroyMulti (Request $request)
    {
        $ids = $request->ids;
        DB::beginTransaction();
        try {
            foreach ($ids as $id) {
                $newModel = $this->newModel::findOrFail($id);
                if ($newModel->status != StatusConfig::CONST_AVAILABLE) {
                    $newModel->remove = 1;
                    $newModel->save();
                    // $newModel->delete();
                    // $newModel->deleteTranslations();
                    // $newModel->categories()->detach();
                    DB::commit();
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
     * Add hot news the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function hotNew ($id, Request $request)
    {
        $ids = $request->ids;
        DB::beginTransaction();
        try {
                $newModel = $this->newModel::findOrFail($id);
                $hot = $newModel->hot;
                if ($hot == 1) {
                    $newModel->hot = 0;
                } else {
                    $newModel->hot = 1;
                }
                $newModel->save();
                DB::commit();
                return response()->json(['status' => true], 200);
        }
        catch (Exception $e) {
            DB::rollback();
            return response()->json(['status' => false], 422);
        }
    }

    /**
     * update prioritize new the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function prioritizeNew ($id, Request $request)
    {
        $ids = $request->ids;
        DB::beginTransaction();
        try {
                $newModel = $this->newModel::findOrFail($id);
                $prioritize = $newModel->prioritize;
                if ($prioritize == 1) {
                    $newModel->prioritize = 0;
                } else {
                    $newModel->prioritize = 1;
                }
                $newModel->save();
                DB::commit();
                return response()->json(['status' => true], 200);
        }
        catch (Exception $e) {
            DB::rollback();
            return response()->json(['status' => false], 422);
        }
    }


    

    public function _validateInsert($request) {
        $rules = array(
                    'title.*'    => 'between:1,255',
                    'content.*'  => 'required',
                    'categories' => 'required',
                    'status'     => ['required', Rule::in([StatusConfig::CONST_AVAILABLE, StatusConfig::CONST_DISABLE])]
                    );
        $messages = array();
        $attribute = array(
            'name.*'       => trans('backeend.new.name'),
            'content.*'    => trans('backeend.new.content'),
            'categories.*' => trans('backeend.new.categories'),
            'status'       => trans('backeend.status.status')
        );

        $this->validate($request, $rules, $messages, $attribute);
    }
}
