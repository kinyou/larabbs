<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
	/**
	 * 授权策略定义完成之后，我们便可以在控制器中使用 authorize 方法来检验用户是否授权。默认的App\Http\Controllers\Controller
	 * 控制器基类包含了 Laravel 的 AuthorizesRequests trait
	 * 此trait 提供了authorize 方法它可以被用于快速授权一个指定的行为，当无权限运行该行为时会抛出 HttpException
	 * authorize 方法接收两个参数，第一个为授权策略的名称，第二个为进行授权验证的数据。
	 * 我们需要为 edit 和 update 方法加上这行
	 * 这里的update和edit是指授权类里面的update授权方法 例如UserPolicy.php的update方法
	 */
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
