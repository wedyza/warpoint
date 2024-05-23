<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Wkhooy\ObsceneCensorRus;

class CommentController extends Controller
{
    public function create(Request $request){
        $data = $request->validate([
            'body' => 'required|max:288',
            'id' => 'required|exists:products,id',
            'rate' => 'required'
        ]);
        $body = ObsceneCensorRus::getFiltered($data['body']);
        $rate = $data['rate'];
        $comment = new Comment;
        $comment->user_id = auth()->user()->id;
        $comment->body = $body;
        $comment->rate = $rate;
        $comment->product_id = $data['id'];
        $comment->date = Carbon::now()->format('Y-m-d');
        $comment->save();
        
        return back();
    }

    public function destroy(Request $request){
        Comment::find($request->id)->delete();

        return back();
    }
}
