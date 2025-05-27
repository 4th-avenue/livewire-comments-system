<?php

namespace App\Livewire;

use App\Models\Comment;
use Livewire\Component;
use App\Livewire\Forms\ReplyForm;

class CommentItem extends Component
{
    public Comment $comment;

    public ReplyForm $replyForm;

    public function postReply()
    {
        $this->replyForm->storeReply($this->comment);
    }

    public function render()
    {
        return view('livewire.comment-item');
    }
}
