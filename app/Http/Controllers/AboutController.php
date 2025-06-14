<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index() {
        $totalUser = User::count();
        $totalTopic = Topic::count();
        $totalComment = Comment::count();

        return view("about.index", [
            "title" => "Tentang Pendiri",
            'totalUser' => $totalUser,
            'totalTopic' => $totalTopic,
            'totalComment' => $totalComment,
        ]);
    }
}
