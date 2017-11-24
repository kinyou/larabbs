<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;

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

    /**
     * 编辑个人资料
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
	public function edit(User $user){
        return view('users.edit',compact('user'));
    }

    public function update(UserRequest $request,User $user){
        $user->update($request->all());
        return redirect()->route('users.show',$user->id)->with('success','个人资料更新成功');
    }
}
