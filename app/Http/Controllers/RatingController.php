<?php

namespace App\Http\Controllers;

use App\Models\Admin\Laptop;
use App\Models\Comment;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\FuncCall;

class RatingController extends Controller
{
    public function getAllComment($id){
        $comments = Comment::where('laptop_id', $id)->get();

        return view ('components.render-comment-laptop', compact('comments'));
    }
    public function getComment($id){
        return view ('comment', compact('id'));
    }

    public function rating($laptop_id){
        $comments = Comment::where('laptop_id', $laptop_id)->get();

        $rating = 0;
        $counter = 0;
        foreach ($comments as $comment) {
            $rating += (float) $comment->rating;
            $counter++;
        }
        
        if ($counter === 0) {
            $rating = 0;
        } else {
            $rating /= $counter;
        }

        $laptop = Laptop::findOrFail($laptop_id);
        $laptop->rating = $rating;
        $laptop->save();
    }

    public function saveRating(Request $request){
        // dd($request->all());
        $request->validate([
            // 'user_id' => 'required|Integer',
            'laptop_id' => 'required|Integer',
            'content' => 'required|string',
            'rating' => 'required|Integer',
        ]);
        
        $comment = new Comment([
            'customer_id' => auth()->id(),
            'laptop_id' => $request -> laptop_id,
            'rating' => $request -> rating,
            'content' => $request ->content
        ]);

        $comment->save();
        $this->rating($request->laptop_id);

        return response()->json(['success' => true, 'message' => 'Comment posted successfully!']);
    }
}