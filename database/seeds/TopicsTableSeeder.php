<?php

use Illuminate\Database\Seeder;
use App\Models\Topic;
use Illuminate\Support\Facades\Log;

class TopicsTableSeeder extends Seeder
{
    public function run()
    {
    	//所有用户id数组
	    $user_ids = \App\Models\User::all()->pluck('id')->toArray();
	    //所有分类id数组
	    $category_ids = \App\Models\Category::all()->pluck('id')->toArray();

	    //获取Faker实例
	    $faker = app(Faker\Generator::class);

        $topics = factory(Topic::class)->times(50)->make()->each(function ($topic, $index) use ($user_ids,$category_ids,$faker) {
            //从用户id数组中随机取出一个并赋值
	        $topic->user_id = $faker->randomElement($user_ids);
	        //从话题id中随机取出一个进行填充
	        $topic->category_id = $faker->randomElement($category_ids);
        });

		Log::debug('$topics--->' . var_export($topics->toArray(),true));

        Topic::insert($topics->toArray());
    }

}

