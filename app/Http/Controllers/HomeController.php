<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $sort = $request->query('sort', 'terbaru');

        $topicsQuery = \App\Models\Topic::with(['user', 'category'])
            ->withCount('comments');

        if ($sort === 'populer') {
            $topicsQuery->orderByDesc('view_count');
        } elseif ($sort === 'banyak-komentar') {
            $topicsQuery->orderByDesc('comments_count');
        } else {
            $topicsQuery->orderByDesc('created_at');
        }

        $topics = $topicsQuery->paginate(10)->withQueryString();

        return view('index', [
            'title' => 'Suram',
            'topics' => $topics,
            'sort' => $sort,
        ]);
    }
}
