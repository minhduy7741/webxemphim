<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $list = Category::orderBy('position','asc')->get();
        return view('admincp.category.form',compact('list'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $data = $request->all();
        $data = $request->validate([
            'title' => 'required|unique:categories|max:255',
            'slug' => 'required|unique:categories|max:255',
            'description' => 'required|max:255',
            'status' => 'required',
        ],[
            'title.required' => 'Tiêu đề không được để trống',
            'slug.required' => 'Slug không được để trống',
            'description.required' => 'Mô tả không được để trống',
            'status.required' => 'Trạng thái không được để trống',
            'title.unique' => 'Tiêu đề đã tồn tại',
            'slug.unique' => 'Slug đã tồn tại',
        ]);
        $category = new Category();
        $category->title = $data ['title'];
        $category->slug = $data ['slug'];
        $category->description = $data ['description'];
        $category->status = $data ['status'];
        $category->save();
        toastr()->success('Thành công','Thêm danh mục phim thành công');
        return redirect()->route('category.index');
        

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
        $category = Category::find($id);
        $list = Category::orderBy('position','asc')->get();
        return view('admincp.category.form',compact('list','category'));
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
        // $data = $request->all();
        $data = $request->validate([
            'title' => 'required|max:255',
            'slug' => 'required|max:255',
            'description' => 'required|max:255',
            'status' => 'required',
        ],[
            'title.required' => 'Tiêu đề không được để trống',
            'slug.required' => 'Slug không được để trống',
            'description.required' => 'Mô tả không được để trống',
            'status.required' => 'Trạng thái không được để trống',
            'title.max' => 'Tiêu đề không được vượt quá 255 ký tự',
            'slug.max' => 'Slug không được vượt quá 255 ký tự',
        ]);
        $category = Category::find($id);
        $category->title = $data ['title'];
        $category->slug = $data ['slug'];
        $category->description = $data ['description'];
        $category->status = $data ['status'];
        $category->save();
        toastr()->success('Thành công','Cập nhật danh mục phim thành công');
        return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Category::find($id)->delete();
        toastr()->success('Thành công','Xóa danh mục phim thành công');
        return redirect()->back();
    }
    public function resorting(Request $request)
    {
        $data = $request->all();
        foreach($data['array_id'] as $key => $value){
            $category = Category::find($value);
            $category->position = $key;
            $category->save();
        }
        
    }
}
