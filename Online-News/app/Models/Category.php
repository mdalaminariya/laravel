<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Blog;

class Category extends Model
{
    use HasFactory;
   protected $guarded = [''];

   public function oneBlog(){
    return $this->hasOne(Blog::class,'category_id','id');
   }
}
