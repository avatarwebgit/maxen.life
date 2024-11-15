<?php

namespace App\Http\Controllers\Admin;

use App\Models\Comment;
use App\Models\ContactUs;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{
    public function index()
    {
        $comments = Comment::latest()->paginate(20);
        return view('admin.comments.index', compact('comments'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Comment $comment)
    {
        return view('admin.comments.show', compact('comment'));
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();
        alert()->success(' کامنت مورد نظر حذف شد', 'باتشکر');
        return redirect()->route('admin.comments.index');
    }

    public function changeApprove(Comment $comment)
    {
        if ($comment->getRawOriginal('approved')) {
            $comment->update([
                'approved' => 0
            ]);
        } else {
            $comment->update([
                'approved' => 1
            ]);
        }

        alert()->success('وضعیت کامنت مورد نظر تغییر کرد', 'باتشکر');
        return redirect()->route('admin.comments.index');
    }

    public function contact_index()
    {
        $items = ContactUs::latest()->paginate(20);
        return view('admin.contact_us.index', compact('items'));
    }

    public function contact_show(ContactUs $id)
    {
        $comment = $id;
        $comment->update([
            'approved' => 1
        ]);
        return view('admin.contact_us.show', compact('comment'));
    }

    public function contact_destroy(ContactUs $id)
    {
        $id->delete();
        return redirect()->back();
    }
}
