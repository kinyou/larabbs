<?php
/**
 * 系统自定义的函数库
 */

if (!function_exists('route_class')) {
	function route_class(){
		return str_replace('.','-',Route::currentRouteName());
	}
}