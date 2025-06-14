<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PopularController extends Controller
{
    public function index(Request $request)
{
    // Filter
    $sort = $request->query('sort', 'populer'); // populer, komentar, terbaru
    $time = $request->query('time', 'all'); // all, today, week, month
    $cat  = $request->query('category', 'all'); // all or id/slug

    // Query topics
    $topicsQuery = \App\Models\Topic::with(['user', 'category'])
        ->withCount('comments');

    // Time filter
    if ($time === 'today') {
        $topicsQuery->whereDate('created_at', today());
    } elseif ($time === 'week') {
        $topicsQuery->where('created_at', '>=', now()->startOfWeek());
    } elseif ($time === 'month') {
        $topicsQuery->where('created_at', '>=', now()->startOfMonth());
    }

    // Category filter
    if ($cat !== 'all') {
        $topicsQuery->where('category_id', $cat);
    }

    // Sorting
    if ($sort === 'komentar') {
        $topicsQuery->orderByDesc('comments_count');
    } elseif ($sort === 'terbaru') {
        $topicsQuery->orderByDesc('created_at');
    } else { // populer
        $topicsQuery->orderByDesc('view_count');
    }

    $topics = $topicsQuery->paginate(10)->withQueryString();

    // Sidebar
    $trending = \App\Models\Topic::with('user')
        ->where('created_at', '>=', now()->subWeek())
        ->orderByDesc('view_count')
        ->limit(3)->get();

    $categories = \App\Models\Category::withCount('topics')->orderByDesc('topics_count')->get();
    $totalTopics = \App\Models\Topic::count();
    $totalComments = \App\Models\Comment::count();

    return view('popular.index', [
        "title" => "Diskusi Populer",
        'topics' => $topics,
        'trending' => $trending,
        'categories' => $categories,
        'totalTopics' => $totalTopics,
        'totalComments' => $totalComments,
        'sort' => $sort,
        'time' => $time,
        'cat' => $cat,
    ]);
}

}
