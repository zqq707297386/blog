<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ElementController extends Controller
{
    public function element()
    {
        return view('admin/element');
    }
}
