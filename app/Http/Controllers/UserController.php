<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;

class UserController extends BaseController
{


    public function index()
    {
        return Redirect::to('user/login');
    }

    public function login()
    {
        if($this->data['userCheck']) {
            return Redirect::to('dashboard');
        } 
        else {
            return View::make('user.login', $this->data);
        }
    }

    public function loginUser()
    {
        if(Request::ajax()) {

            $output = [];
            $email = Input::get('email');
            $password = Input::get('password');

            $validator = Validator::make(Input::all(), ['email' => 'required|email', 'password' => 'required']);

            if ($validator->fails()) {
                $output['success'] = false;
                $output['message'] = $validator->getMessageBag()->toArray();

                return json_encode($output);
            } else {
                $credentials = ['login_id' => $email, 'password' => $password];

                if(Auth::guard('web')->attempt($credentials)) {
                    $output['success'] = true;
                    $output['userID'] = Auth::guard('web')->user()->id;
                    $output['message'] = ' Logged in successsfully';
                } else {
                    $output['success'] = false;
                    $output['message'] = "Invalid details entered";
                }

                return json_encode($output);
            }
        } else {
            return "Illegal request method";
        }
    }

    public function logout() {
        Auth::guard('web')->logout();
    }

    public function createUser()
    {
        if(Request::ajax()) {
            dd(Input::all());
        }
    }
    
}
