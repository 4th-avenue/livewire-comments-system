<?php

namespace App\Livewire;

use Livewire\Component;
use App\Livewire\Forms\ReplyForm;
use Illuminate\Support\Facades\Gate;
use App\Models\Comment as CommentModel;
use App\Livewire\Forms\UpdateCommentForm;

class Comment extends Component
{
    public CommentModel $comment;

    public $isReplying = false, $isEditing = false;

    public ReplyForm $form;

    public UpdateCommentForm $updateForm;

    public function storeReply()
    {
        if ($this->comment->isReply()) {
            return;
        }

        $this->form->storeReply($this->comment);

        $this->comment->load('replies.user', 'replies.replies');

        $this->isReplying = false;
    }

    public function updateComment()
    {
        Gate::authorize('update', $this->comment);

        $this->updateForm->updateComment($this->comment);

        $this->isEditing = false;
    }

    public function updatedIsEditing($value)
    {
        if ($value) {
            $this->updateForm->body = $this->comment->body;
        }
    }

    public function deleteComment()
    {
        Gate::authorize('delete', $this->comment);
        $this->comment->delete();
    }

    public function render()
    {
        return view('livewire.comment');
    }
}
