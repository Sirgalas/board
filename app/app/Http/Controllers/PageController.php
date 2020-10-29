<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Router\PagePath;

class PageController extends Controller
{
    public function show(PagePath $path)
    {
        $page = $path->page;

        return view('page', compact('page'));
    }
}
