<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        // Pastikan field deskripsi/icon ada di tabel, atau gunakan mapping jika belum ada.
        $categories = \App\Models\Category::withCount('topics')->get();

        return view('categories.index', [
            "title" => "Kategori Diskusi",
            "categories" => $categories
        ]);
    }
}
