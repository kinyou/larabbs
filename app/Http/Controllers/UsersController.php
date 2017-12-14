<?php

namespace App\Http\Controllers;

use App\Handles\ImageUploadHandler;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Image;

class UsersController extends Controller
{
	/**
	 * 权限验证-没有登录的用户只能方法show方法
	 * UsersController constructor.
	 */
	public function __construct(){
		$this->middleware('auth',['except'=>['show']]);
	}
	/**
	 * 个人主页
	 * 使用laravel的隐形路由模型绑定
	 * @param User $user
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function show(User $user){
		$host = config('app.url');
		return view('users.show',compact('user','host'));
	}

    /**
     * 编辑个人资料
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
	public function edit(User $user){
		//权限验证
		$this->authorize('update',$user);
		$host = config('app.url');
        return view('users.edit',compact('user','host'));
    }

	/**
	 * 更新用户信息
	 * @param UserRequest $request
	 * @param ImageUploadHandler $uploadHandler
	 * @param User $user
	 * @return \Illuminate\Http\RedirectResponse
	 */
    public function update(UserRequest $request,ImageUploadHandler $uploadHandler,User $user){
    	//权限验证
    	$this->authorize('update',$user);
		$data = $request->all();

		if ($request->avatar) {
			$result = $uploadHandler->save($request->avatar,'avatars',$user->id,362);
			if ($request){
				$data['avatar'] = $result['path'];
			}
		}

        $user->update($data);
        return redirect()->route('users.show',$user->id)->with('success','个人资料更新成功');
    }
}
