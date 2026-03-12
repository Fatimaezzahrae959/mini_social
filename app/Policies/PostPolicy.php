<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Post;

class PostPolicy
{
    // Modifier post
    public function update(User $user, Post $post)
    {
        return $user->id === $post->user_id;
    }

    // Supprimer post
    public function delete(User $user, Post $post)
    {
        return $user->id === $post->user_id;
    }
}