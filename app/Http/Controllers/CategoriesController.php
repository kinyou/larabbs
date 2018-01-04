<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Topic;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function show(Category $category){
    	//读取分类id关联话题,并每页显示20条
	    $topics = Topic::with(['category','user'])->where('category_id',$category->id)->paginate(20);
	    //分配数据到模板中
	    return view('topics.index',compact('topics','category'));
    }
}
