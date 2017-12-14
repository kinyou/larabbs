<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	//设置分类模型允许填充的字段
    protected $fillable = [
    	'name','description'
    ];
}
