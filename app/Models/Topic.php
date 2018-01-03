<?php

namespace App\Models;

class Topic extends Model
{
	//可填充的字段
    protected $fillable = [
    	'title',
	    'body',
	    'user_id',
	    'category_id',
	    'reply_count',
	    'view_count',
	    'last_reply_user_id',
	    'order',
	    'excerpt',
	    'slug'
    ];

    //定义关联关系 一个话题属于一个分类
	public function category(){
		return $this->belongsTo(Category::class);
	}

	//定义关联关系  一个话题属于一个用户
	public function user(){
		return $this->belongsTo(User::class);
	}

}
