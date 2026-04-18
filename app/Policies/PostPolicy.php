<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;

class PostPolicy
{
    /**
     * Determine whether the user can update the post.
     */
    public function update(User $user, Post $post): bool
    {
        // Admin can update any post
        if ($user->role === 'admin') {
            return true;
        }

        // Normal user can update only their own post
        return $user->id === $post->author_id;
    }

    /**
     * Determine whether the user can delete the post.
     */
    public function delete(User $user, Post $post): bool
    {
        // Admin can delete any post
        if ($user->role === 'admin') {
            return true;
        }

        // Normal user can delete only their own post
        return $user->id === $post->author_id;
    }
}
