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
        $categories = \App\Models\Category::withCount('topics')->orderByDesc('topics_count')->get();
        $trendingTopics = \App\Models\Topic::with(['user', 'category'])
            ->where('created_at', '>=', now()->subDays(7))
            ->orderByDesc('view_count')
            ->limit(3)
            ->get();

        $totalTopics = \App\Models\Topic::count();
        $totalComments = \App\Models\Comment::count();
        $totalUsers = \App\Models\User::count();

        return view('index', [
            'title' => 'Suram',
            'topics' => $topics,
            'sort' => $sort,
            'categories' => $categories,
            'trendingTopics' => $trendingTopics,
            'totalTopics' => $totalTopics,
            'totalComments' => $totalComments,
            'totalUsers' => $totalUsers,
        ]);
    }

    public function autocomplete(Request $request)
    {
        $q = $request->query('q');
        $results = [];

        if ($q && strlen($q) >= 2) {
            $results = \App\Models\Topic::where('title', 'like', "%$q%")
                ->limit(7)
                ->get(['id', 'title']);
        }

        return response()->json($results);
    }
}
