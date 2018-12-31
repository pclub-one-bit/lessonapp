<?php

namespace App\Http\Controllers;

class AppController extends Controller
{

    /**
     * 各アクションの前に実行させるミドルウェア
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

}
