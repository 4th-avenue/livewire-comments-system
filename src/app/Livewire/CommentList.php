<?php

namespace App\Livewire;

use Livewire\Component;
use App\Livewire\Forms\CommentForm;
use Illuminate\Database\Eloquent\Model;

class CommentList extends Component
{
    public Model $model;
    public CommentForm $form;

    public function postComment()
    {
        $this->form->storeComment($this->model);
    }

    public function render()
    {
        return view('livewire.comment-list', [
            'comments' => $this->model
                ->comments()
                ->parent()
                ->with([
                    'user',
                    'replies' => function ($query) {
                        $query->oldest()->with('user:id,name,email', 'replies:id');
                    }
                ])
                ->latest()
                ->get(),
        ]);
    }
}
