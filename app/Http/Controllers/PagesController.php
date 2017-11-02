<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller{

	/**
	 * 博客首页
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
    public function root(){
    	return view('pages.root');
    }
}

