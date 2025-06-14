<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Tag;
use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TopicController extends Controller
{
    public function create()
    {
        $categories = Category::all(); // agar select category dinamis
        return view('topics.create', [
            "title" => "Buat Topik Diskusi Baru",
            "categories" => $categories
        ]);
    }

    public function store(Request $request)
    {
        // Validasi awal
        $request->validate([
            'title'       => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'content'     => 'required|string',
            'tags'        => 'nullable|string|max:100',
        ]);

        // Olah tags dari input hidden
        $tagsInput = array_filter(array_map('trim', explode(',', $request->tags)));
        if (count($tagsInput) > 5) {
            return back()->withInput()->withErrors(['tags' => 'Maksimal 5 tag saja.']);
        }

        foreach ($tagsInput as $tag) {
            if (strlen($tag) > 15) {
                return back()->withInput()->withErrors(['tags' => 'Tag "' . $tag . '" lebih dari 15 karakter.']);
            }
            if (!preg_match('/^[a-z0-9\-]+$/i', $tag)) {
                return back()->withInput()->withErrors(['tags' => 'Tag "' . $tag . '" hanya boleh huruf, angka, dan tanda strip.']);
            }
        }

        // Simpan topic
        $topic = \App\Models\Topic::create([
            'title'       => $request->title,
            'category_id' => $request->category_id,
            'user_id'     => Auth::id(),
            'content'     => $request->content,
            'view_count'  => 0,
        ]);

        // Proses tag dan simpan ke tag_topic
        $tagIds = [];
        foreach ($tagsInput as $tagName) {
            $tagName = strtolower($tagName); // konsisten lowercase
            $tag = \App\Models\Tag::firstOrCreate(['name' => $tagName]);
            $tagIds[] = $tag->id;
        }
        $topic->tags()->sync($tagIds);

        return redirect()->route('topics.create')->with('success', 'Diskusi berhasil dibuat!');
    }
}
