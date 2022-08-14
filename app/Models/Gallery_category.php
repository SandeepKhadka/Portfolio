<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Gallery_category extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'desc', 'slug', 'status', 'order_id', 'image', 'meta_title', 'meta_desc', 'meta_keywords', 'btn_text', 'btn_link'];

    public function getRules($act = 'add'){
        $rules = [
            'title' => 'required|string',
            'desc' => 'nullable|string',
            'status' => 'required|in:active,inactive',
            'image' => 'required|image|max:5120'
            // 'slug' => 'nullable|string',
            // 'meta_title' => 'nullable|string',
            // 'meta_keywords' => 'nullable|string',
            // 'meta_desc' => 'nullable|string',
            // 'btn_text' => 'nullable|string',
            // 'btn_link' => 'nullable|string',
            // 'order_id' => 'nullable|integer'
        ];

        if ($act == 'update'){
            $rules['image'] = 'sometimes|image|max:5120';
        }

        return $rules;

    }

    public function getSlug($title){
        $slug = Str::slug($title);
        if ($this->where('slug',$slug)->count() > 0){
            $slug .= date('Ymdhis').rand(0,99);
        }
        return $slug;
    }
}
