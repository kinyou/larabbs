<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //获取Faker实例
	    $faker = app(Faker\Generator::class);

	    //头像假数据
	    $avatars = [
		    'https://fsdhubcdn.phphub.org/uploads/images/201710/14/1/s5ehp11z6s.png?imageView2/1/w/200/h/200',
		    'https://fsdhubcdn.phphub.org/uploads/images/201710/14/1/Lhd1SHqu86.png?imageView2/1/w/200/h/200',
		    'https://fsdhubcdn.phphub.org/uploads/images/201710/14/1/LOnMrqbHJn.png?imageView2/1/w/200/h/200',
		    'https://fsdhubcdn.phphub.org/uploads/images/201710/14/1/xAuDMxteQy.png?imageView2/1/w/200/h/200',
		    'https://fsdhubcdn.phphub.org/uploads/images/201710/14/1/ZqM7iaP4CR.png?imageView2/1/w/200/h/200',
		    'https://fsdhubcdn.phphub.org/uploads/images/201710/14/1/NDnzMutoxX.png?imageView2/1/w/200/h/200',
	    ];

	    //生成数据集合
	    $users = factory(\App\Models\User::class)->times(10)->make()->each(function($user,$index) use ($faker,$avatars){
	    	//从头像数组中随机拿一个赋值
		    $user->avatar = $faker->randomElement($avatars);
	    });

	    //让隐藏字段可见,并将数据集合转换为数组
	    $user_array = $users->makeVisible(['password','remember_token'])->toArray();

	    Log::debug('$user_array-----' . var_export($user_array,true));
	    //插入到数据库
	    \App\Models\User::insert($user_array);

	    //单独处理第一个用户的数据
	    $user = \App\Models\User::find(1);
	    $user->name = 'xingmaogou';
	    $user->email = 'kinyou_xy@126.com';
	    $user->avatar = 'https://fsdhubcdn.phphub.org/uploads/images/201710/14/1/ZqM7iaP4CR.png?imageView2/1/w/200/h/200';

	    $user->save();
    }
}
