<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'desc', 'status', 'image', 'img_alt', 'meta_title', 'meta_desc', 'meta_keywords', 'cat_id'];


    // public function category_info(){
    //     return $this->hasOne('App\Models\Category', 'id', 'parent_id');
    // }

    public function getRules($act = 'add'){
        $rules = [
            'title' => 'required|string',
            'desc' => 'nullable|string',
            'status' => 'required|in:active,inactive',
            'image' => 'required|image|max:5120',
            'img_alt' => 'nullable|string',
            'meta_title' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
            'meta_desc' => 'nullable|string',
            'cat_id' => 'nullable|exists:gallery_categories,id'
        ];

        if ($act == 'update'){
            $rules['image'] = 'sometimes|image|max:5120';
        }

        return $rules;

    }
}
