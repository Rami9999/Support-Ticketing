<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Rule;

use Auth;

use App\Models\Post;

class PostComments extends Component
{
    use WithPagination;

    public Post $post;

    #[Rule('required|min:3|max:220')]
    public string $comment;

    #[Computed()]
    public function comments(){
        return $this?->post?->comments()->with('user')->latest()->paginate(5);
        
    }

    public function postComment()
    {
        if(auth()->guest())
        {
            return;
        }
        $this->validateOnly('comment');

        $this->post->comments()->create([
            'comment'=>$this->comment,
            'user_id' =>Auth::user()->id
        ]);

        $this->reset('comment');
    }

    public function render()
    {
        return view('livewire.post-comments');
    }
}
