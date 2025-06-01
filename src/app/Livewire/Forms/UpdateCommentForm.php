<?php

namespace App\Livewire\Forms;

use Livewire\Form;
use App\Models\Comment;
use Livewire\Attributes\Validate;

class UpdateCommentForm extends Form
{
    #[Validate('required|string|min:3|max:500')]
    public string $body = '';

    public function updateComment(Comment $comment)
    {
        $this->validate();

        $comment->update([
            'body' => $this->body,
        ]);

        // $this->reset('body');
    }
}
