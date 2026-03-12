<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Like;

class LikeController extends Controller
{
    public function like($id)
    {
        Like::firstOrCreate([
            'user_id' => session('user_id'),
            'post_id' => $id
        ]);

        return back();
    }
}