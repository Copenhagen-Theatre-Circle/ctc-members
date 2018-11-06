<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PrototypeController extends Controller
{
    public function index () {
        $guest_name = 'Andrew Blackwell';
        $suppress_breadcrumb = true;
        $navbar_title = '50th Anniversary Book Form';
        return view ('prototypes.prototype', Compact('guest_name','suppress_breadcrumb', 'navbar_title'));
    }
}
