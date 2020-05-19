<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Profile;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        $cond_title = $request->cond_title;

        if ($cond_title != '') {
            $posts = Profile::where('title', $cond_title).orderBy('updated_at', 'desc')->get();
        } else {
            $posts = Profile::all()->sortByDesc('updated_at');
        }

        if (count($posts) > 0) {
            $headline = $posts->shift();
        } else {
            $headline = null;
        }

        return view('profile.index', ['headline' => $headline, 'posts' => $posts, 'cond_title' => $cond_title]);
    }
}
