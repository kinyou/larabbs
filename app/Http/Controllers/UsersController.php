<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
	/**
	 * 个人主页
	 * 使用laravel的隐形路由模型绑定
	 * @param User $user
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function show(User $user){
		return view('users.show',compact('user'));
	}
}
