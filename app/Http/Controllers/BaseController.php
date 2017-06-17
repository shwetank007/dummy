<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BaseController extends Controller
{
    
	public $data = [];

	public function __construct()
	{
		$this->data['userCheck'] = false;
		$this->data['UserValue'] = null;

		$this->middleware(function ($request, $next) {
			if(Auth::guard('web')->check()) {
				$this->data['userCheck'] = Auth::guard('web')->check();
				$this->data['userValue'] = Auth::guard('web')->user();
			}

			return $next($request);
		});
	}

}
