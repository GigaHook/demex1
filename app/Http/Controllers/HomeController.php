<?php

namespace App\Http\Controllers;

use App\Models\Film;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    //ЭТО ПИШЕМ УСЛИ ДОСТУП НУЖЕН ТОЛЬКО ДЛЯ АВТОРИЗОВАННЫХ
    //public function __construct()
    //{
    //    $this->middleware('auth');
    //}

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home', ['films' => Film::all()]);
    }
}
