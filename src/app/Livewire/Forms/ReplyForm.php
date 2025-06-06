<?php

namespace App\Livewire\Forms;

use Livewire\Form;
use App\Models\Comment;
use Livewire\Attributes\Validate;

class ReplyForm extends Form
{
    #[Validate('required|string|min:3|max:500')]
    public string $body = '';

    public function storeReply(Comment $comment)
    {
        $this->validate();

        $reply = $comment->replies()->make([
            'body' => $this->body,
            'user_id' => auth()->id(),
        ]);

        $reply->commentable()->associate($comment->commentable);

        $reply->save();

        $this->reset('body');
    }
}
