<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Manager;
use App\Model\Teacher;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Manager::all();
        dd($user);
        return view('home',compact('user'));
    }

    public function restPas($ps_id,$newpass){

         $th = Teacher::where('ps_id',$ps_id)->first();

         return $th;
    }
}
