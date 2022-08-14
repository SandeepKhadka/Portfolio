<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gallery;
use File;
use Intervention\Image\Facades\Image as Image;

class GalleryController extends Controller
{
    protected $gallery = null;

    public function __construct(Gallery $_gallery)
    {
        $this->gallery = $_gallery;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $this->gallery = $this->gallery->orderBy('id', 'DESC')->get();
        // dd($this->gallery);
        return view('admin.gallery_list')
            ->with('gallery_data', $this->gallery);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.gallery_form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = $this->gallery->getRules();
        $request->validate($rules);
        $data = $request->except(['_token', 'image']);
        if ($request->has('image')) {
            // $upload_path = public_path() . '/uploads/gallery/';
            // if (!File::exists($upload_path)) {
            //     File::makeDirectory($upload_path, 0777, true, true);
            // }
            // $file_name = 'Gallery-' . date('ymdhis') . rand(0, 99) . '.' . $request->image->getClientOriginalExtension();
            // $success = $request->image->move($upload_path, $file_name);
            $image = $request->image;
            $file_name = uploadImage($image, 'gallery', '125x125');
            if ($file_name) {
                $data['image'] = $file_name;
            }
        }

        $this->gallery->fill($data);

        $status = $this->gallery->save();

        return redirect()->route('gallery.index');
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
        $this->gallery = $this->gallery->find($id);
        if (!$this->gallery) {
            //message
            return redirect()->route('gallery.index');
        }

        return view('admin.gallery_form')
            ->with('gallery_data', $this->gallery);
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
        // dd($id);
        $this->gallery = $this->gallery->find($id);
        if (!$this->gallery) {
            redirect()->route('gallery.index');
        }

        $rules = $this->gallery->getRules('update');
        $request->validate($rules);
        $data = $request->except(['_token', 'image']);
        if ($request->has('image')) {
            $image = $request->image;
            $file_name = uploadImage($image, 'gallery', '125x125');
            if ($file_name) {
                if ($this->gallery->image != null && file_exists(public_path() . '/uploads/gallery/' . $this->gallery->image)) {
                    unlink(public_path() . '/uploads/gallery/' . $this->gallery->image);
                    unlink(public_path() . '/uploads/gallery/Thumb-' . $this->gallery->image);
                }
                $data['image'] = $file_name;
            }
        }

        $this->gallery->fill($data);

        $status = $this->gallery->save();

        return redirect()->route('gallery.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->gallery = $this->gallery->find($id);
        if (!$this->gallery) {
            redirect()->route('gallery.index');
        }

        $del = $this->gallery->delete();
        $image = $this->gallery->image;
        if ($del) {
            if ($image != null && file_exists(public_path() . '/uploads/gallery/' . $image)) {
                unlink(public_path() . '/uploads/gallery/' . $image);
                unlink(public_path() . '/uploads/gallery/Thumb-' . $image);
            }
            //message
            else {
                //message
            }

            return redirect()->route('gallery.index');
        }
    }
}
