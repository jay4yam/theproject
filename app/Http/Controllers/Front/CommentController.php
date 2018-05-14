<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{
    public function addComment($locale, Request $request)
    {
        dd($request->all());
    }
}
