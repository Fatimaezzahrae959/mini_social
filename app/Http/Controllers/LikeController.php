<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Like;

class LikeController extends Controller
{
    public function like($id)
    {
        $user_id = session('user_id');

        $like = \App\Models\Like::where('post_id', $id)
            ->where('user_id', $user_id)
            ->first();

        if ($like) {
            // كان داير like → نحيدوه
            $like->delete();
        } else {
            // ما كانش داير like → نزيدوه
            \App\Models\Like::create([
                'post_id' => $id,
                'user_id' => $user_id
            ]);
        }

        return response()->noContent();
    }
}