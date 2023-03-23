<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SiteController extends Controller
{
    /* . ------------------------- home ------------------------- */
    public function home()
    {
        return view('sites.home');
    }
    /* . ------------------------- End home ------------------------- */

    /* . ------------------------- about ------------------------- */
    public function about()
    {
        return view('sites.about');
    }
    /* . ------------------------- End about ------------------------- */

    /* . ------------------------- register ------------------------- */
    public function register()
    {
        return view('sites.register');
    }
    /* . ------------------------- End register ------------------------- */
}
