<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::get();
        return view('admin.categories.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parents = Category::get();
        return view('admin.categories.create',compact('parents'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->except('image');
        $data['image'] = $this->uplodaImage($request);

        $category = Category::create($data);
        return redirect()->route('admin.categories.index')->with('success','Category Created!');
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
        $category = Category::findOrFail($id);
        $parents = Category::where('id','!=',$id)
        ->where(function($query) use ($id){
            $query->whereNull('parent_id')
            ->orWhere('parent_id','!=',$id);
        })
        ->get();
        return view('admin.categories.edit',compact('category','parents'));
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
        $category = Category::findOrFail($id);

        $old_image = $category->image;
        $data = $request->except('image');
        $data['image'] = $this->uplodaImage($request);

        if($old_image && $data['image']){
            Storage::disk('public')->delete($old_image);
            // Storage::disk('')->delete($old_image);
        }

        $category->update($data);
        return redirect()->route('admin.categories.index')->with('success','Category Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id)->delete();
        $category->delete();

        if ($category->image) {
            Storage::disk('public')->delete($category->image);
        }
        // $category = Category::destroy($id);
        return redirect()->route('admin.categories.index')->with('success','Category Deleted!');
    }

    protected function uplodaImage(Request $request) {
        if(!$request->hasFile('image')){
            return;
        }

        $file = $request->file('image');
        $path = $file->storeAs('uploads/images',Carbon::now()."_".trim($file->getClientOriginalExtension()," "),[
            'disk' => 'public',
        ]);
            // $file->getSize()  \\ file size;
            // $file->getClientOriginalExtension() \\ file extension;
            // $file->getClientOriginalName() \\ file name was uploaded;
            // $file->getMimeType() \\ file type;
        return $path;
    }
}
