<?php

namespace App\Livewire\Test;

use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class ViewComment extends Component
{

    #[On('refresh-comments')]
    public function render()
    {
        $comments = Comment::where('user_id', Auth::id())->get();
        return view('livewire.test.view-comment', [
            'comments' => $comments
        ]);
    }
}
