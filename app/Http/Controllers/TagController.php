<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function autocomplete(Request $request)
    {
        $query = $request->input('query', '');
        $tags = Tag::where('name', 'like', "%$query%")
            ->limit(8)
            ->pluck('name');
        return response()->json($tags);
    }
}
