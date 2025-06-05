<?php

namespace App\Livewire;

use App\Models\Comment;
use Livewire\Component;
use App\Livewire\Forms\ReplyForm;
use Illuminate\Support\Facades\Gate;
use App\Livewire\Forms\UpdateCommentForm;

class CommentItem extends Component
{
    public Comment $comment;

    public ReplyForm $replyForm;
    public UpdateCommentForm $updateForm;

    public function mount()
    {
        $this->updateForm->body = $this->comment->body;
    }

    public function updateComment()
    {
        Gate::authorize('update', $this->comment);

        $this->updateForm->updateComment($this->comment);
        $this->dispatch('edited', $this->comment->id);
    }

    public function postReply()
    {
        Gate::authorize('reply', $this->comment);

        $this->replyForm->storeReply($this->comment);
        $this->comment->load([
            'replies' => fn ($q) => $q->with('user:id,name,email', 'replies:id'),
        ]);
        $this->dispatch('replied', $this->comment->id);
    }

    public function deleteComment()
    {
        Gate::authorize('delete', $this->comment);
        $this->comment->delete();
    }

    public function render()
    {
        return view('livewire.comment-item');
    }
}
