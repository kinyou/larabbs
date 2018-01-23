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

    /**
     * 使用本地作用域复用代码,作用域总是返回 查询构建器
     * @param $query
     * @param $order
     * @return mixed
     */
	public function scopeWithOrder($query,$order){
        //不同的排序,读取不同的数据
        switch($order){
            case 'recent' :
                $query->recent();
                break;
            default :
                $query->recentReplied();
                break;
        }

        //解决N+1的问题
        return $query->with(['user','category']);
    }

    /**
     * 按照创建时间排序
     * @param $query
     * @return mixed
     */
    public function scopeRecent($query){
        return $query->orderBy('created_at','desc');
    }

    /**
     * 按照最近回复时间排序
     * @param $query
     * @return mixed
     */
    public function scopeRecentReplied($query){
        return $query->orderBy('updated_at','desc');
    }
}