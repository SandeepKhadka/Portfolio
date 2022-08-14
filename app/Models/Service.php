<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    
    protected $fillable = ['title', 'icon', 'desc', 'content', 'status', 'order_id', 'meta_title', 'meta_desc', 'meta_keywords'];

    public function getRules($act = 'add'){
        $rules = [
            'title' => 'required|string',
            'icon' => 'required|image|max:300',
            'desc' => 'nullable|string',
            'content' => 'nullable|string',
            'status' => 'required|in:active, inactive',
        ];

        if($act == 'update'){
            $rules['icon'] = 'sometimes|image|max:300';
        }

        return $rules;
    }
}
