<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\Gallery_category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    protected $gallery_category = null;

    public function __construct(Gallery_category $gallery_category) 
    {
        $this->gallery_category = $gallery_category;
        
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->gallery_category = $this->gallery_category->orderBy('id', 'DESC')->get();
        return view('admin.category_list')
        ->with('category_data', $this->gallery_category);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category_form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $rules = $this->gallery_category->getRules();
        $request->validate($rules);
        $data = $request->except(['_token', 'image']);
        if ($request->has('image')) {
            $image = $request->image;
            $file_name = uploadImage($image, 'gallery_category', '125x125');
            if ($file_name) {
                $data['image'] = $file_name;
            }
        }

        $data['slug'] = $this->gallery_category->getSlug($data['title']);
        $this->gallery_category->fill($data);

        $status = $this->gallery_category->save();

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
        $this->gallery_category = $this->gallery_category->find($id);

        if(!$this->gallery_category){
            //message
            return redirect()->route('category.index');
        }

        return view('admin.category_form')
        ->with('category_data', $this->gallery_category);
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
        $this->gallery_category = $this->gallery_category->find($id);

        if(!$this->gallery_category){
            //message
            return redirect()->route('category.index');
        }

        $rules = $this->gallery_category->getRules('update');
        $request->validate($rules);
        $data = $request->except(['_token', 'image']);
        if ($request->has('image')) {
            $image = $request->image;
            $file_name = uploadImage($image, 'gallery_category', '125x125');
            if ($file_name) {
                if ($this->gallery_category->image != null && file_exists(public_path() . '/uploads/gallery_category/' . $this->gallery_category->image)) {
                    unlink(public_path() . '/uploads/gallery_category/' . $this->gallery_category->image);
                    unlink(public_path() . '/uploads/gallery_category/Thumb-' . $this->gallery_category->image);
                }
                $data['image'] = $file_name;
            }
        }

        $data['slug'] = $this->gallery_category->getSlug($data['title']);
        $this->gallery_category->fill($data);

        $status = $this->gallery_category->save();

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
        $this->gallery_category = $this->gallery_category->find($id);
        if (!$this->gallery_category) {
            redirect()->route('category.index');
        }

        $del = $this->gallery_category->delete();
        $image = $this->gallery_category->image;
        if ($del) {
            if ($image != null && file_exists(public_path() . '/uploads/gallery_category/' . $image)) {
                unlink(public_path() . '/uploads/gallery_category/' . $image);
                unlink(public_path() . '/uploads/gallery_category/Thumb-' . $image);
            }
            //message
            else {
                //message
            }

            return redirect()->route('category.index');
        }
    }
}
