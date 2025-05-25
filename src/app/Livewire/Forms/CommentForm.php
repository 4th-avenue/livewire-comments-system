<?php

namespace App\Livewire\Forms;

use Livewire\Form;
use Livewire\Attributes\Validate;
use Illuminate\Database\Eloquent\Model;

class CommentForm extends Form
{
    #[Validate('required|string|min:3|max:500')]
    public string $body = '';

    public function storeComment(Model $model)
    {
        $this->validate();

        $model->comments()->create([
            'body' => $this->body,
            'user_id' => auth()->id(),
        ]);

        $this->reset('body');
    }
}
