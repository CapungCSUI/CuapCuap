<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()) {
            if (Auth::user()->role_id == 0) {
                return redirect()->action('ThreadController@index');
            }
            else if (Auth::user()->role_id >= 1) {
                return view('home');
            }
        }
        else {
            return view('welcome');
        }
    }
}
