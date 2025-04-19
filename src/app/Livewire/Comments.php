<?php

namespace App\Livewire;

use App\Models\Comment;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use App\Livewire\Forms\CommentForm;
use Illuminate\Support\Facades\Gate;
use Illuminate\Database\Eloquent\Model;

class Comments extends Component
{
    use WithPagination;

    public Model $model;

    public CommentForm $form;

    public function postComment()
    {
        $this->form->storeComment($this->model);

        $this->gotoPage(1);
    }

    #[On('deleteComment')]
    public function deleteComment($comment)
    {
        $comment = Comment::find($comment);

        Gate::authorize('delete', $comment);

        $comment->delete();
    }

    public function render()
    {
        return view('livewire.comments', [
            'comments' => $this->model
                ->comments()
                ->with('user', 'replies.user', 'replies.replies')
                ->parent()
                ->latest()
                ->paginate(3),
        ]);
    }
}
