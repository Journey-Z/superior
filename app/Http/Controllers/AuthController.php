<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Validator;
use Auth;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = 'admin/';

    protected $redirectAfterLogout = '/login';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
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
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    /**
     * 显示登录页面
     */
    public function getLogin()
    {
        return view('admin.login');
    }

    /**
     * 用户登录
     *
     * @param LoginRequest $loginRequest
     */
    public function postLogin(Request $request)
    {
        //判断帐号是否激活
        $parameters = [
            'email' => $request->get('account'), // May be the username too
            'password' => $request->get('password'),
        ];
        $login = Auth::attempt($parameters,$request->get('remember'));
        if($login){
            return Redirect::intended('admin/');
        }else{
            return Redirect::back()->withErrors('帐号或者密码不正确,请重试!');
        }
    }

    /**
     * 退出登录
     *
     * @return mixed
     */
    public function logout()
    {
        if(Auth::check()){
            $user = Auth::user();
            Auth::logout();
        }
        return Redirect::intended('/login');
    }
}
