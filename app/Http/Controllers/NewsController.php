<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function create()
    {
        return view('addnews');
    }

    public function store(Request $request)
    {
        // Validasi form
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
        ]);

        // Simpan data ke database
        News::create([
            'title' => $request->title,
            'content' => $request->content,
            'user_id' => auth()->user()->id,
        ]);

        return redirect()->route('home')->with('success', 'News added successfully!');
    }

    public function index()
{
    $news = News::all(); // Assuming you want to retrieve all news items
    return view('allnews', ['news' => $news]);
}
}