<?php

// app/Http/Controllers/CommentController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Store a newly created comment in the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $newsId)
{
    // Validasi form input jika diperlukan
    $request->validate([
        'content' => 'required',
    ]);

    // Simpan komentar ke dalam database
    Comment::create([
        'news_id' => $newsId,
        'user_id' => auth()->user()->id,
        'comment' => $request->input('content'), // Sesuaikan dengan nama kolom yang benar
    ]);

    return redirect()->back()->with('success', 'Komentar berhasil ditambahkan');
}

    /**
     * Remove the specified comment from the database.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        // Check if the authenticated user is the owner of the comment
        if (Auth::id() !== $comment->user_id) {
            return redirect()->back()->with('error', 'Unauthorized to delete this comment');
        }

        // Delete the comment
        $comment->delete();

        return redirect()->back()->with('success', 'Comment deleted successfully');
    }
}
