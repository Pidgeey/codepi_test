<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

/**
 * Class HomeController
 * @package App\Http\Controllers
 * @noinspection PhpUnused
 */
class HomeController extends Controller
{
    /**
     * Get home template
     *
     * @return View
     */
    public function index()
    {
        return view('home');
    }
}
