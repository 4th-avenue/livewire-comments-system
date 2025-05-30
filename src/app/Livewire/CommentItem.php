<?php

namespace App\Livewire;

use App\Models\Comment;
use Livewire\Component;
use App\Livewire\Forms\ReplyForm;
use Illuminate\Support\Facades\Gate;

class CommentItem extends Component
{
    public Comment $comment;

    public ReplyForm $replyForm;

    public function postReply()
    {
        Gate::authorize('reply', $this->comment);

        $this->replyForm->storeReply($this->comment);
        $this->comment->load([
            'replies' => fn ($q) => $q->with('user:id,name', 'replies:id'),
        ]);
        $this->dispatch('replied', $this->comment->id);
    }

    public function render()
    {
        return view('livewire.comment-item');
    }
}
