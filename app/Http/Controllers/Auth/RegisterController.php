<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
	        'captcha'=>'required|captcha', //使用自定义表单验证规则https://d.laravel-china.org/docs/5.5/validation#using-extensions
        ],[
	        'name.required'=>'用户名不能为空',
	        'name.max'=>'用户名最大长度不能超过255个字符',
        	'email.required'=>'邮箱不能为空',
        	'email.max'=>'邮箱最大长度不能超过255个字符',
        	'email.unique'=>'邮箱已经被注册',
        	'password.required'=>'密码不能为空',
        	'password.min'=>'密码长度不能少于6位',
        	'password.confirmed'=>'密码不一致',
        	'captcha.required'=>'验证码不能为空',
	        'captcha.captcha'=>'请输入正确的验证码'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }
}
